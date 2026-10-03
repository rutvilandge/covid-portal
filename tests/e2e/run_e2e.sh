#!/bin/bash
# Optional automated end-to-end check (bash + curl + psql). Needs a freshly imported PostgreSQL database.
# Usage: PGHOST=... PGPORT=5432 PGDATABASE=covid_portal PGUSER=... PGPASSWORD=... BASE=https://your-domain.example ADMIN_EMAIL=... ADMIN_PASSWORD=... bash tests/e2e/run_e2e.sh
# Writes test rows into the database - run against a throwaway copy, re-import database/covid_portal.sql afterwards.
if [ -z "${BASE:-}" ] || [ -z "${ADMIN_EMAIL:-}" ] || [ -z "${ADMIN_PASSWORD:-}" ]; then echo "Set BASE, ADMIN_EMAIL, and ADMIN_PASSWORD before running this script."; exit 2; fi
if [ -z "${PGDATABASE:-}" ] || [ -z "${PGUSER:-}" ]; then echo "Set PGDATABASE and PGUSER (and PGHOST/PGPORT/PGPASSWORD as needed)."; exit 2; fi
sql(){ psql -X -qAt -v ON_ERROR_STOP=1 -c "$1"; }
B=${BASE%/}
BASE_PATH=$(printf '%s' "$B" | sed -E 's#https?://[^/]+##;s#/$##')
EXPECT="location: ${BASE_PATH}"
J=/tmp/jar_user.txt; A=/tmp/jar_admin.txt; rm -f $J $A
tok(){ curl -s -b $1 -c $1 "$B/$2" | grep -o 'name="csrf_token" value="[a-f0-9]*"' | head -1 | sed 's/.*value="//;s/"//'; }
code(){ curl -s -o /dev/null -w "%{http_code}" "$@"; }
loc(){ curl -s -o /dev/null -D - "$@" | grep -i '^location' | tr -d '\r' | tr 'A-Z' 'a-z'; }
chk(){ if [ "$2" = "$3" ]; then echo "PASS  $1"; else echo "FAIL  $1  (expected '$3' got '$2')"; fi; }

for p in index about symptoms prevention vaccination statistics contact login register comments; do chk "GET $p.php 200" "$(code $B/$p.php)" 200; done
for i in covid-hero covid-awareness covid-symptoms covid-prevention vaccination health-safety; do chk "image $i.svg 200" "$(code $B/assets/images/$i.svg)" 200; done
chk "dashboard as guest redirects to login" "$(loc $B/dashboard.php)" "$EXPECT/login.php"
chk "admin dashboard as guest redirects" "$(loc $B/admin/dashboard.php)" "$EXPECT/admin/login.php"
chk "admin users as guest redirects" "$(loc $B/admin/users.php)" "$EXPECT/admin/login.php"

T=$(tok $J register.php)
chk "register without CSRF is rejected" "$(loc -b $J -c $J -d 'full_name=Test+User&email=t@x.com&phone=9876543210&password=Test@1234&confirm_password=Test@1234' $B/actions/register_action.php)" "$EXPECT/register.php"
curl -s -b $J -c $J -d "csrf_token=$T&full_name=R2D2&email=bad&phone=123&password=weak&confirm_password=x" $B/actions/register_action.php -o /dev/null
H=$(curl -s -b $J -c $J $B/register.php)
for m in "Name must be 2-50 letters" "Enter a valid email" "10-digit Indian mobile" "Password needs 8-64" "Passwords do not match"; do chk "server-side error shown: $m" "$(echo "$H" | grep -c "$m")" 1; done
T=$(tok $J register.php)
chk "valid registration -> login page" "$(loc -b $J -c $J -d "csrf_token=$T&full_name=Test+User&email=Test@Example.com&phone=9876543210&password=Test@1234&confirm_password=Test@1234" $B/actions/register_action.php)" "$EXPECT/login.php"
T=$(tok $J register.php)
curl -s -b $J -c $J -d "csrf_token=$T&full_name=Other+User&email=test@example.com&phone=9876543211&password=Test@1234&confirm_password=Test@1234" $B/actions/register_action.php -o /dev/null
chk "duplicate email (case-insensitive) blocked" "$(curl -s -b $J -c $J $B/register.php | grep -c 'already registered')" 1
chk "stored password is a bcrypt hash" "$(sql "select left(password,4) from users where email='test@example.com'")" '$2y$'
chk "stored email lower-cased" "$(sql "select count(*) from users where email='test@example.com'")" 1

T=$(tok $J login.php)
curl -s -b $J -c $J -d "csrf_token=$T&email=test@example.com&password=Wrong@1234" $B/actions/login_action.php -o /dev/null
chk "wrong password -> generic error" "$(curl -s -b $J -c $J $B/login.php | grep -c 'Invalid email or password')" 1
T=$(tok $J login.php)
curl -s -b $J -c $J -d "csrf_token=$T&email=nobody@example.com&password=Wrong@1234" $B/actions/login_action.php -o /dev/null
chk "unknown email -> same generic error" "$(curl -s -b $J -c $J $B/login.php | grep -c 'Invalid email or password')" 1
T=$(tok $J login.php)
chk "SQLi in login does not authenticate" "$(loc -b $J -c $J --data-urlencode "email=' OR '1'='1" --data-urlencode "csrf_token=$T" -d "password=x" $B/actions/login_action.php)" "$EXPECT/login.php"
T=$(tok $J login.php)
chk "valid login -> dashboard" "$(loc -b $J -c $J -d "csrf_token=$T&email=test@example.com&password=Test@1234" $B/actions/login_action.php)" "$EXPECT/dashboard.php"
chk "dashboard greets user" "$(curl -s -b $J -c $J $B/dashboard.php | grep -c 'Welcome, Test User')" 1
chk "normal user blocked from admin area" "$(loc -b $J $B/admin/users.php)" "$EXPECT/admin/login.php"

T=$(tok $J dashboard.php)
curl -s -b $J -c $J -d "csrf_token=$T&return=dashboard&comment=abc" $B/actions/comment_action.php -o /dev/null
chk "comment of 3 chars rejected" "$(curl -s -b $J -c $J $B/dashboard.php | grep -c 'at least 5 characters')" 1
T=$(tok $J dashboard.php)
curl -s -b $J -c $J --data-urlencode "comment=<script>alert('xss')</script> Stay safe & wash hands" -d "csrf_token=$T&return=dashboard" $B/actions/comment_action.php -o /dev/null
P=$(curl -s $B/comments.php)
chk "XSS payload is escaped in comments page" "$(echo "$P" | grep -c '&lt;script&gt;alert')" 1
chk "no raw <script>alert in comments page" "$(echo "$P" | grep -c "<script>alert")" 0
chk "comment stored with user_id FK" "$(sql "select count(*) from comments c join users u on u.id=c.user_id where u.email='test@example.com'")" 1
chk "guest cannot POST comment" "$(loc -d 'comment=hello+world&csrf_token=x' $B/actions/comment_action.php)" "$EXPECT/login.php"

T=$(tok $J contact.php)
curl -s -b $J -c $J -d "csrf_token=$T&name=Test+User&email=test@example.com&phone=1234567890&message=short" $B/actions/contact_action.php -o /dev/null
H=$(curl -s -b $J -c $J $B/contact.php); chk "contact invalid phone + short message flagged" "$(echo "$H" | grep -o -E '10-digit Indian|at least 10' | wc -l)" 2
T=$(tok $J contact.php)
curl -s -b $J -c $J -d "csrf_token=$T&name=Test+User&email=test@example.com&phone=9876543210&message=Please+add+more+info+on+ventilation" $B/actions/contact_action.php -o /dev/null
chk "valid contact stored with user_id" "$(sql "select count(*) from registrations where user_id is not null")" 1
T=$(tok /tmp/jar_guest.txt contact.php)
curl -s -b /tmp/jar_guest.txt -c /tmp/jar_guest.txt -d "csrf_token=$T&name=Guest+Person&email=g@x.com&phone=8888888888&message=Guest+message+for+testing" $B/actions/contact_action.php -o /dev/null
chk "guest contact stored with NULL user_id" "$(sql "select count(*) from registrations where user_id is null")" 1

chk "statistics shows live user count" "$(curl -s $B/statistics.php | grep -c 'Registered users')" 1
chk "logout redirects to login" "$(loc -b $J -c $J $B/logout.php)" "$EXPECT/login.php"
chk "dashboard blocked after logout" "$(loc -b $J $B/dashboard.php)" "$EXPECT/login.php"

T=$(tok $A admin/login.php)
curl -s -b $A -c $A -d "csrf_token=$T&admin=1&email=test@example.com&password=Test@1234" $B/actions/login_action.php -o /dev/null
chk "normal user cannot use admin login" "$(loc -b $A $B/admin/dashboard.php)" "$EXPECT/admin/login.php"
T=$(tok $A admin/login.php)
chk "admin login -> admin dashboard" "$(loc -b $A -c $A -d "csrf_token=$T&admin=1&email=$ADMIN_EMAIL&password=$ADMIN_PASSWORD" $B/actions/login_action.php)" "$EXPECT/admin/dashboard.php"
for p in dashboard users comments registrations; do chk "admin/$p.php 200 for admin" "$(code -b $A $B/admin/$p.php)" 200; done
chk "admin users page lists test user" "$(curl -s -b $A $B/admin/users.php | grep -c 'test@example.com')" 1
T=$(tok $A admin/comments.php); CID=$(sql "select id from comments limit 1")
curl -s -b $A -c $A -d "csrf_token=$T&id=$CID&do=hide" $B/admin/comments.php -o /dev/null
chk "admin can hide a comment" "$(sql "select status from comments where id=$CID")" hidden
chk "hidden comment not on public page" "$(curl -s $B/comments.php | grep -c 'Stay safe')" 0
curl -s -b $A -c $A -d "csrf_token=bad&id=$CID&do=delete" $B/admin/comments.php -o /dev/null
chk "admin delete without valid CSRF refused" "$(sql "select count(*) from comments where id=$CID")" 1
