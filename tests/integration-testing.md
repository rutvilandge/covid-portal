# Integration Testing

Integration testing checks that modules work **together**: Browser (HTML/JS) -> PHP -> PostgreSQL -> back to the browser.

| ID | Flow | Steps | Expected | Status |
|---|---|---|---|---|
| INT-01 | Register -> validate -> database | Submit valid registration | JS passes, PHP validates, `users` row inserted with hashed password, redirect to login | Pass (PostgreSQL local run, 2026-10-03) |
| INT-02 | Register with invalid data | Disable JS, submit invalid data | PHP rejects; nothing inserted; errors shown on the form | Not Executed |
| INT-03 | Login -> session -> dashboard | Log in with valid credentials | `$_SESSION` set, dashboard shows the user's name from the database | Pass (PostgreSQL local run, 2026-10-03) |
| INT-04 | Comment -> database -> dashboard/public page | Post a comment | Row in `comments` with correct `user_id`; text visible on dashboard and community page | Pass (dashboard verified, PostgreSQL local run 2026-10-03) |
| INT-05 | Contact -> database -> admin view | Submit contact form, log in as admin | Row visible on Admin > Contact messages | Not Executed |
| INT-06 | Admin moderation -> public page | Hide a comment as admin | Comment disappears from public page, still listed (as hidden) for admin and the author | Not Executed |
| INT-07 | Database -> statistics | Register a user, open statistics page | "Registered users" counter increases by 1 | Not Executed |
| INT-08 | Logout -> access control | Log out, open dashboard | Redirect to login | Pass (PostgreSQL local run, 2026-10-03) |
| INT-09 | Database failure handling | Stop PostgreSQL, open pages and submit forms | Friendly error shown; technical error logged to `php-error.log` | Not Executed |

The old builder checks (sections B and C of `test-execution-report.md`) were run against MySQL/MariaDB before conversion and are historical only. A fresh PostgreSQL local HTTP run repeated INT-01, INT-03, INT-04 (dashboard path), and INT-08; see section D. Other manual cases remain unexecuted.
