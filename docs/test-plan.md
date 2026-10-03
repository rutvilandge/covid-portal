# Test Plan - COVID-19 Information & Awareness Portal

## 1. Introduction
This plan describes how the portal (HTML, CSS, JavaScript, PHP, PostgreSQL) is tested for the SPPU Software Testing and Quality Assurance Mini Project 1.

## 2. Objectives
* Show that registration, login, comments and the contact form work as specified.
* Show that input is validated with regular expressions on both client (JavaScript) and server (PHP).
* Show that data is stored and retrieved correctly in PostgreSQL.
* Find and record defects, and check basic security behaviour.

## 3. Scope
Public pages, registration, login/logout, dashboard, comments, contact form, simple admin area, database, validation rules.

## 4. Features to be tested
Homepage and content pages; navigation; registration; login; logout; dashboard; comments; contact form; admin pages; regex validation; password hashing; sessions; responsive layout; basic accessibility.

## 5. Features not to be tested
Live COVID-19 data feeds (none exist), email sending (none), load/stress testing, penetration testing by third-party tools, cross-browser testing beyond the browsers listed, medical accuracy of content (reviewed against WHO guidance only at a general level).

## 6. Testing approach
Mostly manual black-box testing from the browser, supported by a small automated suite for the validation rules and a scripted HTTP check. White-box analysis is done on the login and registration logic.

## 7. Testing types
Functional, black-box (EP and BVA), white-box (path/branch analysis), unit (validation functions), integration (browser-PHP-PostgreSQL), regression (re-run unit tests after any change), database, validation/regex, authentication and authorization, security-oriented, usability/responsive checks.

## 8. Test environment
Windows 10/11, Apache 2.4, PHP 8.x with PDO_PGSQL, PostgreSQL, Chrome or Edge latest, optionally Firefox; screen widths 1280, 768 and 375 px.

## 9. Test tools
Browser DevTools, pgAdmin or `psql`, `tests/unit/run_unit_tests.php`, `tests/regex-tester.html`, optional `tests/e2e/run_e2e.sh`, spreadsheet or Markdown for records.

## 10. Entry criteria
Database imported; Apache and PostgreSQL running; application opens at its configured project URL; test documents ready.

## 11. Exit criteria
All planned test cases executed; no open Critical or High defects; every failed case has a bug report; summary and acceptance reports completed with real numbers.

## 12. Pass/Fail criteria
A case **passes** when the actual result matches the expected result. It **fails** when it differs. A case is **blocked** when something else prevents running it.

## 13. Roles and responsibilities
| Role | Responsibility |
|---|---|
| Developer/Tester (student) | Build, execute tests, log defects, fix and retest |
| Guide / examiner | Review the plan, evidence and reports |

## 14. Risks
Browser differences; XAMPP port conflicts (80/3306); different PHP versions; time pressure; wrong expectations in test cases (a real example is recorded in `bug-reports.md`).

## 15. Deliverables
Source code, SQL dump, this plan, test cases (functional, regex, black-box, white-box, unit, integration, database, security), execution report, bug taxonomy and reports, acceptance report, test summary, screenshots, demo script, viva questions.
