# COVID-19 Information & Awareness Portal

SPPU Software Testing and Quality Assurance - Mini Project 1.

> "Dynamic website of covid-19 information using HTML, CSS, JAVASCRIPT And PHP, PostgreSQL database used to store user account, comment, and registration form details. Regular Expression testcases for testing purpose."

## Description
A responsive healthcare-information website with COVID-19 awareness pages, user registration and login, comments, a contact form, a simple admin area, and a full set of testing documents (regex, functional, black-box, white-box, unit, integration, database, security).

## Features
* Pages: Home, About, Symptoms, Prevention, Vaccination, Statistics, Community comments, Contact
* Registration and login with PHP sessions, `password_hash()` / `password_verify()`
* Dashboard (account info, post comments, own comments and contact submissions)
* Contact/registration form stored in PostgreSQL
* PostgreSQL-backed PHP sessions on Vercel so login survives separate serverless requests
* Admin area: users, comments (hide/show/delete), contact messages
* Regex validation (name, email, Indian phone, password) in **both** JavaScript and PHP
* Password strength meter, character counters, mobile menu
* Security: prepared statements (PDO), output escaping, CSRF tokens, session ID regeneration, friendly error pages with server-side logging
* Statistics page: case figures are clearly labelled **sample data** (no live feed); portal counters come from the database

## Tech stack
HTML5, CSS3, vanilla JavaScript, PHP 8 (PDO), PostgreSQL, Apache. No frameworks.

## Project structure
```
covid-portal/
├── index.php about.php symptoms.php prevention.php vaccination.php statistics.php
├── contact.php login.php register.php dashboard.php comments.php logout.php
├── config/database.php          DB settings (local or hosted PostgreSQL)
├── includes/                    header, footer, auth, functions, validation (regex rules)
├── actions/                     register / login / comment / contact handlers
├── admin/                       login, dashboard, users, comments, registrations
├── assets/css, js, images       stylesheet, script, 6 SVG illustrations
├── database/covid_portal.sql    schema + demo admin
├── tests/                       all test documents, unit tests, regex-tester.html, e2e script
└── docs/                        test plan, bug taxonomy, bug reports, acceptance, summary,
                                 screenshot guide, demo script, viva questions
```

## Requirements
PHP 8.0 or newer with PDO PostgreSQL, PostgreSQL, and Apache with `.htaccess` support. A modern browser.

## Database and local setup
1. Create an empty PostgreSQL database and run `database/covid_portal.sql` against it using `psql` or another PostgreSQL administration tool.
2. Set PostgreSQL connection variables as environment variables: either `DATABASE_URL` / `POSTGRES_URL`, or `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` with optional `DB_PORT` / `DB_SSLMODE`. Do not commit database credentials.
3. Serve the project directory with Apache and open its URL. Links and asset paths are detected from the served directory, including when installed in a subfolder.
4. PostgreSQL connection failures are logged server-side; public pages show a generic error.

### Vercel deployment
The project uses the `vercel-php` community runtime (PHP 8.5) with a small front controller in `api/index.php`. Configure `DATABASE_URL` (or the separate `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_PORT`, `DB_SSLMODE` values) in Vercel Project Settings > Environment Variables. Import `database/covid_portal.sql` into the PostgreSQL database before enabling account features. `/api/health` reports whether Vercel can connect to the database.

## Admin account
The SQL import creates the `users`, `comments`, and `registrations` application tables plus a `sessions` table for durable serverless login sessions. It does not create a public default administrator. Register your own account, then promote that account to the `admin` role with a PostgreSQL `UPDATE users SET role = 'admin' WHERE email = 'you@example.com';` query.

## How authentication works
1. Registration validates input (JS then PHP), checks for an existing email, stores `password_hash()` output.
2. Login looks up the email with a prepared statement and checks `password_verify()`. Wrong email and wrong password give the same message.
3. On success the session ID is regenerated and `user_id`, `user_name`, `user_role` are stored in `$_SESSION`.
4. `require_login()` protects the dashboard; `require_admin()` protects `/admin/*`.
5. Logout clears the session and the cookie.

## Database schema
| Table | Columns |
|---|---|
| `users` | id (PK), full_name, email (UNIQUE), phone, password (hash), role (`user`/`admin`), created_at |
| `comments` | id (PK), user_id (FK -> users, ON DELETE CASCADE), comment, status (`visible`/`hidden`), created_at |
| `registrations` | id (PK), user_id (FK -> users, NULL for guests, ON DELETE SET NULL), name, email, phone, message, created_at |

## Testing documentation
| File | Content |
|---|---|
| `tests/regex-test-cases.md` | 39 regex cases (valid, invalid, boundary, special character, empty, whitespace) with real results |
| `tests/functional-test-cases.md` | 56 functional cases - **Not Executed**, for you to run |
| `tests/black-box-testing.md` | EP and BVA for registration, login, comment, contact |
| `tests/white-box-testing.md` | statement/branch/condition analysis of login and registration |
| `tests/unit-testing.md`, `tests/unit/` | testable units and an automated unit test script |
| `tests/integration-testing.md` | browser -> PHP -> PostgreSQL flows |
| `tests/database-testing.md` | 16 database tests |
| `tests/security-testing.md` | 20 security tests and known limitations |
| `tests/test-execution-report.md` | your manual results (blank) + builder's automated pre-check results |
| `docs/` | test plan, bug taxonomy, bug reports, acceptance report, test summary, screenshot guide, demo script, 46 viva questions |

## Regex testing
Rules live in `includes/validation.php` (PHP) and `assets/js/script.js` (JavaScript).
* Command line: `php tests/unit/run_unit_tests.php`
* Browser: open `tests/regex-tester.html` under the project URL (runs all 39 cases and lets you try your own input)

## Honesty note on test results
Only what was actually run is marked as run. The historical MySQL/MariaDB pre-check is recorded separately in `tests/test-execution-report.md`; PostgreSQL checks are listed in the later migration section. Other manual cases remain **Not Executed** until actually run.

## Security considerations
Prepared statements for user supplied values; `htmlspecialchars()` on output; CSRF tokens on POST forms; password hashes; session ID regeneration; generic login errors; raw PHP errors hidden and logged to `php-error.log` (blocked from the browser by `.htaccess`). Session cookies use `Secure` when served over HTTPS. Not implemented: login rate limiting, email verification, password reset.

## Screenshots
See `docs/screenshot-guide.md`. Put your screenshots in a `screenshots/` folder.

## Future improvements
Rate limiting, HTTPS and secure cookies, email verification and password reset, live data from an official API, PHPUnit tests with measured coverage, comment pagination and reporting, multi-language content.

## Disclaimer
This website is for educational and awareness purposes only and does not replace professional medical advice.
