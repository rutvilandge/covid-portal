# Acceptance Report

Acceptance is **pending** until you have executed the manual tests. Update the "Verified" column from your own results.

## 1. Requirement (from SPPU)
"Dynamic website of covid-19 information using HTML, CSS, JAVASCRIPT And PHP, PostgreSQL database used to store user account, comment, and registration form details. Regular Expression testcases for testing purpose."

## 2. Acceptance checklist
| # | Requirement | Where implemented / documented | Verified |
|---|---|---|---|
| F1 | Dynamic COVID-19 information website | index, about, symptoms, prevention, vaccination, statistics pages | Pending execution |
| F2 | HTML, CSS, JavaScript, PHP used | `assets/`, `*.php` | Pending execution |
| F3 | Responsive layout with COVID visuals and alt text | `assets/css/style.css`, `assets/images/` | Pending execution |
| V1 | Regex validation on name, email, phone, password | `includes/validation.php`, `assets/js/script.js` | Builder pre-check passed (39/39 cases); your run pending |
| V2 | Client and server-side validation | JS validation + PHP validators | Pending execution |
| D1 | PostgreSQL stores user accounts | `users` table | Pending execution |
| D2 | PostgreSQL stores comments | `comments` table | Pending execution |
| D3 | PostgreSQL stores registration/contact details | `registrations` table | Pending execution |
| D4 | SQL dump supplied | `database/covid_portal.sql` | Builder import succeeded; your import pending |
| A1 | Registration, login, logout, sessions | `register.php`, `login.php`, `logout.php`, `includes/auth.php` | Pending execution |
| A2 | Password hashing | `password_hash()` / `password_verify()` | Pending execution |
| A3 | Protected dashboard and admin pages | `require_login()`, `require_admin()` | Pending execution |
| T1 | Regex test cases (25+) | `tests/regex-test-cases.md` (39 cases) | Documented; executed by builder script, your run pending |
| T2 | Functional test cases (40+) | `tests/functional-test-cases.md` (56 cases) | Documented; execution pending |
| T3 | Black-box, white-box, unit, integration, DB, security docs | `tests/` | Documented; execution pending |
| T4 | Test plan, bug taxonomy, bug reports, summary | `docs/` | Documented |

## 3. Acceptance criteria
1. 100% of Critical and High functional cases pass.
2. All regex cases pass.
3. No open Critical/High defects.
4. Evidence (screenshots, execution report) is attached.

## 4. Final status
**Pending execution.** Fill in after your testing: Accepted / Accepted with conditions / Rejected, with date and signature.
