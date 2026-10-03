# Functional Test Cases

**Project:** COVID-19 Information & Awareness Portal
**Total test cases:** 56
**Status of every case:** *Not Executed* - these are the manual tests **you** perform on your XAMPP setup and then record in `tests/test-execution-report.md`.

Legend: Actual Result and Status stay **Not Executed** until you run the case. Change them to what you actually observe (Pass / Fail).

| Test Case ID | Module | Test Scenario | Preconditions | Test Steps | Test Data | Expected Result | Actual Result | Status |
|---|---|---|---|---|---|---|---|---|
| TC-FUN-001 | Homepage | Homepage loads with hero | Apache and PostgreSQL running | Open / | - | Hero heading, COVID illustration, two buttons, info cards and footer are displayed | Not Executed | Not Executed |
| TC-FUN-002 | Homepage | Hero buttons navigate | On homepage | Click 'Learn About COVID-19', go back, click 'Prevention Guidelines' | - | Opens about.php, then prevention.php | Not Executed | Not Executed |
| TC-FUN-003 | Homepage | Images have alt text and load | On homepage | Inspect each image (right-click > Inspect) and confirm it displays | - | All 6 images display; each <img> has a meaningful alt attribute | Not Executed | Not Executed |
| TC-FUN-004 | Homepage | Broken image fallback | Rename assets/images/covid-hero.svg temporarily | Reload homepage | - | Layout does not break; a dashed placeholder box is shown. Restore the file afterwards | Not Executed | Not Executed |
| TC-FUN-005 | Navigation | All nav links work (guest) | Logged out | Click Home, About, Symptoms, Prevention, Vaccination, Statistics, Community, Contact | - | Each page opens (HTTP 200) and the current link is highlighted | Not Executed | Not Executed |
| TC-FUN-006 | Navigation | Nav changes after login | Registered user exists | Log in and look at the nav bar | - | Dashboard and Logout appear; Login and Register are hidden | Not Executed | Not Executed |
| TC-FUN-007 | Navigation | Mobile menu | Browser width below 760 px (DevTools device mode) | Click the Menu button twice | - | Menu opens then closes; aria-expanded toggles | Not Executed | Not Executed |
| TC-FUN-008 | Content | About page | - | Open about.php | - | Explains what COVID-19 is, spread, awareness, safety; disclaimer visible | Not Executed | Not Executed |
| TC-FUN-009 | Content | Symptoms page and emergency section | - | Open symptoms.php; click 'Emergency guidance' card on homepage | - | Symptom cards shown; page scrolls to 'When to seek medical attention'; disclaimer shown | Not Executed | Not Executed |
| TC-FUN-010 | Content | Prevention page | - | Open prevention.php | - | 7 prevention cards and illustration displayed | Not Executed | Not Executed |
| TC-FUN-011 | Content | Vaccination FAQ | - | Open vaccination.php; click each FAQ question | - | Each answer expands and collapses; no unsupported claims | Not Executed | Not Executed |
| TC-FUN-012 | Content | Statistics labelled as sample | - | Open statistics.php | - | Case figures are labelled 'Sample / Demonstration Data'; portal activity counters shown separately | Not Executed | Not Executed |
| TC-FUN-013 | Registration | Valid registration | No account with this email | Open register.php; fill all fields; submit | Name: Rutvi Landge; Email: rutvi@example.com; Phone: 9876543210; Password: Rutvi@123 | Redirect to login.php with success message; row appears in users table | Not Executed | Not Executed |
| TC-FUN-014 | Registration | All fields empty | - | Submit empty form | - | Inline 'required' errors on all fields; no request reaches the server | Not Executed | Not Executed |
| TC-FUN-015 | Registration | Invalid name (digits) | - | Enter name 12345; leave field | Name: 12345 | Error 'Name must be 2-50 letters and spaces only.' | Not Executed | Not Executed |
| TC-FUN-016 | Registration | Invalid email | - | Enter email rutvi@; leave field | Email: rutvi@ | Error 'Enter a valid email address...' | Not Executed | Not Executed |
| TC-FUN-017 | Registration | Invalid phone | - | Enter 1234567890 | Phone: 1234567890 | Error about 10-digit Indian mobile number | Not Executed | Not Executed |
| TC-FUN-018 | Registration | Weak password | - | Enter password 'password' | Password: password | Error shown; strength meter shows weak | Not Executed | Not Executed |
| TC-FUN-019 | Registration | Password strength meter | - | Type Abc, then Abcdef1!, then Abcdefgh1234! | - | Bar grows and label changes from Weak to Strong | Not Executed | Not Executed |
| TC-FUN-020 | Registration | Confirm password mismatch | - | Enter different confirm password | Rutvi@123 / Rutvi@124 | Error 'Passwords do not match.' | Not Executed | Not Executed |
| TC-FUN-021 | Registration | Duplicate email | Account rutvi@example.com exists | Register again with same email (try RUTVI@Example.com too) | Same email | Error 'already registered'; no second row in users | Not Executed | Not Executed |
| TC-FUN-022 | Registration | Server-side validation (JS disabled) | Disable JavaScript in browser | Submit invalid data | Name: 12345 | Server returns same errors; form values (not password) kept | Not Executed | Not Executed |
| TC-FUN-023 | Registration | Password stored as hash | User registered | Open pgAdmin or query `users` with psql | - | password column starts with $2y$ and is not the plain text | Not Executed | Not Executed |
| TC-FUN-024 | Login | Valid login | User exists | Open login.php; enter credentials | rutvi@example.com / Rutvi@123 | Redirect to dashboard.php; welcome message shown | Not Executed | Not Executed |
| TC-FUN-025 | Login | Wrong password | User exists | Enter wrong password | rutvi@example.com / Wrong@123 | Error 'Invalid email or password.'; stays on login | Not Executed | Not Executed |
| TC-FUN-026 | Login | Unknown email | - | Enter unregistered email | nobody@example.com | Same generic error (does not reveal whether the email exists) | Not Executed | Not Executed |
| TC-FUN-027 | Login | Empty fields | - | Submit empty login form | - | Required errors displayed | Not Executed | Not Executed |
| TC-FUN-028 | Login | Logged-in user visits login page | Logged in | Open login.php | - | Redirected to dashboard.php | Not Executed | Not Executed |
| TC-FUN-029 | Logout | Logout ends session | Logged in | Click Logout; then press browser Back and open dashboard.php | - | Redirected to login with 'logged out' message; dashboard not accessible | Not Executed | Not Executed |
| TC-FUN-030 | Dashboard | Dashboard shows account details | Logged in | Open dashboard.php | - | Name, email, phone, member-since date displayed | Not Executed | Not Executed |
| TC-FUN-031 | Dashboard | Guest access blocked | Logged out | Open /dashboard.php directly | - | Redirect to login.php with message | Not Executed | Not Executed |
| TC-FUN-032 | Dashboard | Shows only own comments | Two users with comments | Log in as each user in turn | - | Each dashboard lists only that user's comments | Not Executed | Not Executed |
| TC-FUN-033 | Comments | Post valid comment | Logged in | Enter comment and submit | Comment: Wash your hands regularly. | Success message; comment appears on dashboard and comments.php; row in comments table with correct user_id | Not Executed | Not Executed |
| TC-FUN-034 | Comments | Comment too short | Logged in | Submit 'abc' | Comment: abc | Error 'at least 5 characters'; nothing stored | Not Executed | Not Executed |
| TC-FUN-035 | Comments | Comment boundary 500 / 501 | Logged in | Submit 500 chars then 501 chars (maxlength may stop typing; paste to test server) | 500 and 501 chars | 500 accepted; 501 rejected | Not Executed | Not Executed |
| TC-FUN-036 | Comments | Whitespace-only comment | Logged in | Submit 5 spaces | - | Rejected as required (trimmed to empty) | Not Executed | Not Executed |
| TC-FUN-037 | Comments | Guest cannot comment | Logged out | Open comments.php | - | Form hidden; prompt to log in or register | Not Executed | Not Executed |
| TC-FUN-038 | Comments | Character counter | Logged in | Type in comment box | - | Counter shows current length / 500 | Not Executed | Not Executed |
| TC-FUN-039 | Contact | Valid contact submission | - | Open contact.php; fill valid data; submit | Rutvi Landge / rutvi@example.com / 9876543210 / Please add more details on ventilation. | Success message; row in registrations table | Not Executed | Not Executed |
| TC-FUN-040 | Contact | Invalid phone and short message | - | Submit phone 1234567890 and message 'short' | - | Both errors displayed; nothing stored | Not Executed | Not Executed |
| TC-FUN-041 | Contact | Guest vs logged-in submission | - | Submit once logged out, once logged in | - | Guest row has user_id NULL; logged-in row has user's id | Not Executed | Not Executed |
| TC-FUN-042 | Contact | Message boundary 9 / 10 | - | Submit 9-char then 10-char message | - | 9 rejected, 10 accepted | Not Executed | Not Executed |
| TC-FUN-043 | Database | Data persists after restart | Data exists | Restart Apache and PostgreSQL; log in again | - | Users, comments and messages still present | Not Executed | Not Executed |
| TC-FUN-044 | Database | Foreign key: comment needs a user | pgAdmin or psql open | Run INSERT INTO comments (user_id, comment) VALUES (9999,'x') | - | PostgreSQL rejects it with a foreign key violation | Not Executed | Not Executed |
| TC-FUN-045 | Database | Unique email constraint | pgAdmin or psql open | Insert a second user with an existing email via SQL | - | Unique constraint violation | Not Executed | Not Executed |
| TC-FUN-046 | Database | Cascade delete | User with comments | Delete the user in pgAdmin or psql | - | The user's comments are deleted automatically | Not Executed | Not Executed |
| TC-FUN-047 | Authorization | Normal user blocked from admin pages | Logged in as normal user | Open /admin/users.php | - | Redirected to admin login; no data shown | Not Executed | Not Executed |
| TC-FUN-048 | Authorization | Guest blocked from admin pages | Logged out | Open admin/dashboard.php, users.php, comments.php, registrations.php | - | All redirect to admin login | Not Executed | Not Executed |
| TC-FUN-049 | Admin | Admin login | A registered account has been promoted to admin | Open admin/login.php; log in | Your admin account | Admin dashboard with counters | Not Executed | Not Executed |
| TC-FUN-050 | Admin | Normal user cannot use admin login | Normal user exists | Use normal credentials on admin/login.php | - | Error 'Invalid email or password.' | Not Executed | Not Executed |
| TC-FUN-051 | Admin | Admin views data | Logged in as admin | Open Users, Comments, Contact messages tabs | - | Tables list all records; text is escaped | Not Executed | Not Executed |
| TC-FUN-052 | Admin | Hide / show / delete comment | Logged in as admin; a comment exists | Click Hide, check comments.php, click Show, then Delete (confirm) | - | Hidden comment disappears from public page; Show restores; Delete removes the row | Not Executed | Not Executed |
| TC-FUN-053 | Error handling | Friendly error when DB is down | Stop PostgreSQL | Open statistics.php and try to log in | - | Friendly message 'Something went wrong...'; no PHP error text or stack trace | Not Executed | Not Executed |
| TC-FUN-054 | Session | CSRF token required | Logged in | In DevTools remove the hidden csrf_token field and submit a comment | - | Request rejected with 'session expired' message | Not Executed | Not Executed |
| TC-FUN-055 | Responsive UI | Layout at 1280 / 768 / 375 px | - | Resize browser or use device mode on home, register and dashboard | - | No horizontal page scroll; cards stack; images stay inside container; tables scroll inside their box | Not Executed | Not Executed |
| TC-FUN-056 | Accessibility | Keyboard use | - | Press Tab through the register form and menu | - | Visible focus outline on every control; skip-link appears first; labels linked to inputs | Not Executed | Not Executed |
