# Security Testing

These are test procedures. Nothing here claims the application is "secure"; it states what was designed in and how to check it. Status stays **Not Executed** until you run the case. The "Builder pre-check" column records the historical pre-migration run (PHP 8.3 + MariaDB); the PostgreSQL migration checks are recorded separately in the execution report.

| ID | Area | Procedure | Expected | Builder pre-check | Status |
|---|---|---|---|---|---|
| SEC-01 | SQL injection (login) | Email `' OR '1'='1`, any password | Rejected; no login | Observed: no login, redirected back | Not Executed |
| SEC-02 | SQL injection (login, valid-looking) | Email `admin@example.test' --` | Rejected (email regex fails; prepared statement anyway) | Not run | Not Executed |
| SEC-03 | SQL injection (comment) | Comment `'); DROP TABLE users;--` | Stored as text; `users` table still exists | Not run | Not Executed |
| SEC-04 | SQL injection (contact) | Name field `Robert'); DROP TABLE registrations;--` | Rejected by name regex | Not run | Not Executed |
| SEC-05 | Stored XSS (comment) | Comment `<script>alert('xss')</script>` | No alert; text shown literally on dashboard, community page and admin page | Observed: output escaped as `&lt;script&gt;` on community page | Not Executed |
| SEC-06 | XSS (contact message) | Message `<img src=x onerror=alert(1)>` | Displayed as text in admin view | Not run | Not Executed |
| SEC-07 | XSS (registration name) | Name `<b>x</b>` | Rejected by regex | Not run | Not Executed |
| SEC-08 | Password hashing | Check `users.password` in pgAdmin or psql | bcrypt hash (`$2y$...`) | Observed: `$2y$` | Not Executed |
| SEC-09 | Unauthorized dashboard access | Logged out, open `/dashboard.php` | Redirect to login | Observed | Not Executed |
| SEC-10 | Unauthorized admin access (guest) | Open each `/admin/*.php` page | Redirect to admin login | Observed | Not Executed |
| SEC-11 | Unauthorized admin access (user) | Log in as normal user, open `/admin/users.php` | Redirect to admin login | Observed | Not Executed |
| SEC-12 | Session logout | Log out, press Back, reload dashboard | Login required again | Observed | Not Executed |
| SEC-13 | Session fixation | Note session cookie before login, compare after login | Session ID changes (`session_regenerate_id`) | Not run | Not Executed |
| SEC-14 | Input validation | Submit forms with JS disabled | Server-side errors identical to client-side | Observed for registration and contact | Not Executed |
| SEC-15 | Direct URL access to actions | Open `/actions/comment_action.php` in the browser (GET) | Redirect; nothing stored | Observed (guest POST redirected to login) | Not Executed |
| SEC-16 | Duplicate email | Register twice, second time with different letter case | Rejected | Observed | Not Executed |
| SEC-17 | CSRF | Remove hidden `csrf_token` and submit any form | Request refused with a message | Observed (registration, admin delete) | Not Executed |
| SEC-18 | Account enumeration | Login with unknown email vs known email + wrong password | Same message for both | Observed | Not Executed |
| SEC-19 | Error disclosure | Stop PostgreSQL, open pages | No stack trace or path shown to user | Observed: friendly message, error logged | Not Executed |
| SEC-20 | Log file exposure | Open `/php-error.log` in browser | Access denied (requires Apache `.htaccess` support) | Not run (PHP dev server ignores .htaccess) | Not Executed |

## Known limitations (not defects found by testing, but honest scope notes)
* No login rate limiting / lockout: repeated password guesses are not blocked.
* Session cookies are marked `Secure` when the server reports an HTTPS request; confirm this in the target hosting environment.
* No email verification or password reset.
* No default admin account is seeded. Promote a trusted registered account as described in the deployment guide.
