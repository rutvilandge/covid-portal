# Test Execution Report

**Project:** COVID-19 Information & Awareness Portal
**Tester:** ______________________ (write your name)
**Environment (yours):** Windows ___ / PHP ___ / PostgreSQL ___ / Browser ___

Statuses are honest: **NOT EXECUTED** means nobody has run the case yet. Do not change a status until you have really run the test.

---
## A. Manual test execution (your part)

Fill in the Date, Tester and Actual Result columns while testing, then change the status to Pass or Fail. Steps and test data are in `functional-test-cases.md`.

| Test Case ID | Module | Test Date | Tester | Actual Result | Expected Result (short) | Environment | Status |
|---|---|---|---|---|---|---|---|
| TC-FUN-001 | Homepage | | | | Hero heading, COVID illustration, two buttons, info cards and footer a... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-002 | Homepage | | | | Opens about.php, then prevention.php | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-003 | Homepage | | | | All 6 images display; each <img> has a meaningful alt attribute | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-004 | Homepage | | | | Layout does not break; a dashed placeholder box is shown. Restore the ... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-005 | Navigation | | | | Each page opens (HTTP 200) and the current link is highlighted | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-006 | Navigation | | | | Dashboard and Logout appear; Login and Register are hidden | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-007 | Navigation | | | | Menu opens then closes; aria-expanded toggles | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-008 | Content | | | | Explains what COVID-19 is, spread, awareness, safety; disclaimer visib... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-009 | Content | | | | Symptom cards shown; page scrolls to 'When to seek medical attention';... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-010 | Content | | | | 7 prevention cards and illustration displayed | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-011 | Content | | | | Each answer expands and collapses; no unsupported claims | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-012 | Content | | | | Case figures are labelled 'Sample / Demonstration Data'; portal activi... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-013 | Registration | | | | Redirect to login.php with success message; row appears in users table | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-014 | Registration | | | | Inline 'required' errors on all fields; no request reaches the server | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-015 | Registration | | | | Error 'Name must be 2-50 letters and spaces only.' | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-016 | Registration | | | | Error 'Enter a valid email address...' | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-017 | Registration | | | | Error about 10-digit Indian mobile number | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-018 | Registration | | | | Error shown; strength meter shows weak | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-019 | Registration | | | | Bar grows and label changes from Weak to Strong | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-020 | Registration | | | | Error 'Passwords do not match.' | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-021 | Registration | | | | Error 'already registered'; no second row in users | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-022 | Registration | | | | Server returns same errors; form values (not password) kept | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-023 | Registration | | | | password column starts with $2y$ and is not the plain text | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-024 | Login | | | | Redirect to dashboard.php; welcome message shown | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-025 | Login | | | | Error 'Invalid email or password.'; stays on login | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-026 | Login | | | | Same generic error (does not reveal whether the email exists) | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-027 | Login | | | | Required errors displayed | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-028 | Login | | | | Redirected to dashboard.php | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-029 | Logout | | | | Redirected to login with 'logged out' message; dashboard not accessibl... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-030 | Dashboard | | | | Name, email, phone, member-since date displayed | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-031 | Dashboard | | | | Redirect to login.php with message | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-032 | Dashboard | | | | Each dashboard lists only that user's comments | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-033 | Comments | | | | Success message; comment appears on dashboard and comments.php; row in... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-034 | Comments | | | | Error 'at least 5 characters'; nothing stored | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-035 | Comments | | | | 500 accepted; 501 rejected | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-036 | Comments | | | | Rejected as required (trimmed to empty) | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-037 | Comments | | | | Form hidden; prompt to log in or register | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-038 | Comments | | | | Counter shows current length / 500 | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-039 | Contact | | | | Success message; row in registrations table | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-040 | Contact | | | | Both errors displayed; nothing stored | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-041 | Contact | | | | Guest row has user_id NULL; logged-in row has user's id | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-042 | Contact | | | | 9 rejected, 10 accepted | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-043 | Database | | | | Users, comments and messages still present | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-044 | Database | | | | PostgreSQL rejects it (foreign key constraint fails) | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-045 | Database | | | | Duplicate entry error | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-046 | Database | | | | The user's comments are deleted automatically | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-047 | Authorization | | | | Redirected to admin login; no data shown | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-048 | Authorization | | | | All redirect to admin login | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-049 | Admin | | | | Admin dashboard with counters | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-050 | Admin | | | | Error 'Invalid email or password.' | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-051 | Admin | | | | Tables list all records; text is escaped | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-052 | Admin | | | | Hidden comment disappears from public page; Show restores; Delete remo... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-053 | Error handling | | | | Friendly message 'Something went wrong...'; no PHP error text or stack... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-054 | Session | | | | Request rejected with 'session expired' message | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-055 | Responsive UI | | | | No horizontal page scroll; cards stack; images stay inside container; ... | NOT EXECUTED | NOT EXECUTED |
| TC-FUN-056 | Accessibility | | | | Visible focus outline on every control; skip-link appears first; label... | NOT EXECUTED | NOT EXECUTED |

Black-box (`black-box-testing.md`), integration (`integration-testing.md`), database (`database-testing.md`) and security (`security-testing.md`) cases are also **NOT EXECUTED** until you run them and record results.

---
## B. Automated pre-check performed by the builder (Claude)

This was run while building the project, **not on XAMPP**. It shows the code behaved as designed in that environment; repeat the tests on your own machine for your submission.

**Environment:** Ubuntu 24.04 sandbox, PHP 8.3.6 (built-in web server), MariaDB 10.11.14, Node.js for JavaScript checks, curl for HTTP requests. Date: 2026-10-03.

### B1. Regex and unit tests (`php tests/unit/run_unit_tests.php`)
* 39 regex cases + 12 function checks = **51 checks, 51 passed, 0 failed**.
* Same 39 regex cases against `assets/js/script.js` (Node.js): **0 mismatches** with the PHP results.
* One failure occurred during development: a test expectation for TC-REG-035 was wrong (a space plus `!` is a valid password). The test was corrected. No application change was needed for that.

### B2. Scripted end-to-end checks (`tests/e2e/run_e2e.sh`)
Result: **56 of 56 checks passed, 0 failed.**

| ID | Check | Result |
|---|---|---|
| AUTO-01 | GET index.php 200 | Pass |
| AUTO-02 | GET about.php 200 | Pass |
| AUTO-03 | GET symptoms.php 200 | Pass |
| AUTO-04 | GET prevention.php 200 | Pass |
| AUTO-05 | GET vaccination.php 200 | Pass |
| AUTO-06 | GET statistics.php 200 | Pass |
| AUTO-07 | GET contact.php 200 | Pass |
| AUTO-08 | GET login.php 200 | Pass |
| AUTO-09 | GET register.php 200 | Pass |
| AUTO-10 | GET comments.php 200 | Pass |
| AUTO-11 | image covid-hero.svg 200 | Pass |
| AUTO-12 | image covid-awareness.svg 200 | Pass |
| AUTO-13 | image covid-symptoms.svg 200 | Pass |
| AUTO-14 | image covid-prevention.svg 200 | Pass |
| AUTO-15 | image vaccination.svg 200 | Pass |
| AUTO-16 | image health-safety.svg 200 | Pass |
| AUTO-17 | dashboard as guest redirects to login | Pass |
| AUTO-18 | admin dashboard as guest redirects | Pass |
| AUTO-19 | admin users as guest redirects | Pass |
| AUTO-20 | register without CSRF is rejected | Pass |
| AUTO-21 | server-side error shown: Name must be 2-50 letters | Pass |
| AUTO-22 | server-side error shown: Enter a valid email | Pass |
| AUTO-23 | server-side error shown: 10-digit Indian mobile | Pass |
| AUTO-24 | server-side error shown: Password needs 8-64 | Pass |
| AUTO-25 | server-side error shown: Passwords do not match | Pass |
| AUTO-26 | valid registration -> login page | Pass |
| AUTO-27 | duplicate email (case-insensitive) blocked | Pass |
| AUTO-28 | stored password is a bcrypt hash | Pass |
| AUTO-29 | stored email lower-cased | Pass |
| AUTO-30 | wrong password -> generic error | Pass |
| AUTO-31 | unknown email -> same generic error | Pass |
| AUTO-32 | SQLi in login does not authenticate | Pass |
| AUTO-33 | valid login -> dashboard | Pass |
| AUTO-34 | dashboard greets user | Pass |
| AUTO-35 | normal user blocked from admin area | Pass |
| AUTO-36 | comment of 3 chars rejected | Pass |
| AUTO-37 | XSS payload is escaped in comments page | Pass |
| AUTO-38 | no raw <script>alert in comments page | Pass |
| AUTO-39 | comment stored with user_id FK | Pass |
| AUTO-40 | guest cannot POST comment | Pass |
| AUTO-41 | contact invalid phone + short message flagged (first run counted matching lines with grep -c and got 1 because the form renders on one line; re-checked with grep -o and both messages were present) | Pass |
| AUTO-42 | valid contact stored with user_id | Pass |
| AUTO-43 | guest contact stored with NULL user_id | Pass |
| AUTO-44 | statistics shows live user count | Pass |
| AUTO-45 | logout redirects to login | Pass |
| AUTO-46 | dashboard blocked after logout | Pass |
| AUTO-47 | normal user cannot use admin login | Pass |
| AUTO-48 | admin login -> admin dashboard | Pass |
| AUTO-49 | admin/dashboard.php 200 for admin | Pass |
| AUTO-50 | admin/users.php 200 for admin | Pass |
| AUTO-51 | admin/comments.php 200 for admin | Pass |
| AUTO-52 | admin/registrations.php 200 for admin | Pass |
| AUTO-53 | admin users page lists test user | Pass |
| AUTO-54 | admin can hide a comment | Pass |
| AUTO-55 | hidden comment not on public page | Pass |
| AUTO-56 | admin delete without valid CSRF refused | Pass |

### B3. Defects found during the pre-check
See `docs/bug-reports.md` (BUG-001).

### B4. Not covered by the pre-check
Visual layout and responsiveness, mobile menu, keyboard use, browser compatibility, phpMyAdmin-based database tests (DB-04 to DB-12), session-fixation check, `.htaccess` log protection, and everything that needs a human eye. These remain **NOT EXECUTED**.

---
## C. Pre-migration local MySQL integration verification (2026-10-03)

**Environment:** Windows, PHP 8.0.30, XAMPP MariaDB 10.4.32, PHP built-in server. The schema was imported into a new isolated temporary database; no existing database was changed. The HTTP flow used CSRF tokens and a cookie-backed PHP session.

| Check | Result | Notes |
|---|---|---|
| Import `database/covid_portal.sql` | PASS | Created `users`, `comments`, and `registrations`; both foreign keys were present. Deleting a test user cascaded comments and set contact `user_id` to NULL. |
| Register -> hashed user row | PASS | User row created; password stored as bcrypt (`$2y$`). |
| Login -> session -> dashboard | PASS | Redirected to dashboard; name, email, and account data loaded from MySQL. |
| Post comment -> dashboard | PASS | Comment was stored under the signed-in user's ID and displayed on the dashboard. |
| Submit contact form -> dashboard | PASS | Registration row was stored under the signed-in user's ID and displayed on the dashboard. |
| Logout -> guest access control | PASS | Logout confirmation displayed; a later dashboard request redirected to login. |
| PHP regex/unit checks | PASS | 39 regex cases and 12 function checks; 51 passed, 0 failed. |

This run found and fixed a logout-session issue: the app destroyed the session and then tried to reuse it for the logout flash message. Logout now destroys the authenticated session and starts a new anonymous session with a fresh ID. This MariaDB run documents the pre-migration implementation; PostgreSQL results are recorded below.

---
## D. PostgreSQL migration verification (2026-10-03)

**Environment:** Windows, PHP 8.0.30 with PDO_PGSQL, PostgreSQL 13.23, PHP built-in server. A disposable PostgreSQL cluster and database were created in the system temp directory; no existing database was changed.

| Check | Result | Notes |
|---|---|---|
| Import converted `database/covid_portal.sql` | PASS | Created all three tables, identity primary keys, case-insensitive unique email index, checks, indexes, and foreign keys. Delete test confirmed comment cascade and contact `user_id` set to NULL. |
| PDO connection from individual `DB_*` variables | PASS | Application queries ran through PDO_PGSQL. |
| PDO connection from `DATABASE_URL` | PASS | URL parsing and TLS mode selection worked. |
| Register and duplicate email | PASS | Registration stored a bcrypt hash; case-insensitive duplicate was rejected. |
| Login -> session -> dashboard | PASS | Dashboard displayed database-backed user information. |
| Comment and contact history | PASS | Both records persisted and appeared on the user's dashboard. |
| Statistics and `/api/health.php` | PASS | Database queries succeeded; health returned `status: ok`, `database: connected`. |
| Logout and protected dashboard | PASS | Logout confirmation displayed; the next dashboard request redirected to login. |
| PHP regex/unit checks | PASS | 39 regex cases + 12 function checks; 51 passed, 0 failed. |

These checks use a local disposable PostgreSQL instance. Production verification is recorded below.

---
## E. Vercel production verification (2026-10-03)

**Environment:** Vercel PHP runtime 8.5.2, Neon PostgreSQL, Vercel CLI 62.1.0. The Neon database was provisioned through the Vercel integration and received the converted schema, including the supporting durable-session table. The production deployment was built successfully and is aliased at `https://covid-portal-alpha.vercel.app`.

| Check | Result | Notes |
|---|---|---|
| Vercel production build | PASS | Deployment reached `READY`; `vercel-php@0.9.0` built the PHP functions. |
| Homepage | PASS | HTTP 200; title `Home | COVID-19 INFO`. |
| PostgreSQL health endpoint | PASS | `/api/health` returned HTTP 200 and `database: connected`. |
| Portal activity statistics | PASS | `/statistics.php` returned HTTP 200, showed live activity data, and no database error. COVID case figures remain explicitly labelled demonstration data. |
| Register -> login -> dashboard | PASS | Live account registered and password authentication redirected to a dashboard showing that account's data; session rows were written to PostgreSQL. |
| Comment and contact form submissions | PASS | Both live submissions appeared on the authenticated user's dashboard. |
| Logout -> protected dashboard | PASS | After logout, dashboard access redirected to login. |
| Smoke-test data cleanup | PASS | Temporary test account was deleted after verification; linked comments cascade through the foreign key. |

The first production health check exposed Neon endpoint routing incompatibility with the bundled libpq version. The PDO configuration now supplies the Neon endpoint ID in PostgreSQL startup options for Neon hosts. Production sessions use PostgreSQL instead of the function's temporary filesystem. The final health check and authenticated flow passed after these fixes. Credentials remain in Vercel environment variables and the ignored local `.env.local` file.
