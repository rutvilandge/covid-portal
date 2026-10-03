# Demo Script (about 6 minutes)

Before you start: the site is available at its configured project URL, the database is imported, pgAdmin or `psql` is ready, and one test account is ready (or register live).

**1. Introduce the project (30 s)**
"Good morning. My project is the COVID-19 Information and Awareness Portal. It is a dynamic website built with HTML, CSS, JavaScript, PHP and PostgreSQL."

**2. Objective (30 s)**
"The aim is to give reliable COVID-19 information, let users register and comment, and to test the application, especially with regular expression test cases, as the SPPU mini project asks."

**3. Homepage (30 s)**
"This is the homepage. The navigation bar, the COVID-19 hero illustration, quick information cards, and a footer with the disclaimer. It is responsive, so on a phone the menu collapses." (Narrow the window to show it.)

**4. COVID information (30 s)**
"Here are the Symptoms and Prevention pages. The statistics page labels case numbers as sample data, because this project does not use a live feed. The counters for users and comments come from the database."

**5. Registration (40 s)**
"Now I create an account. Fields are name, email, phone and password with confirmation."

**6. Validation (50 s)**
"If I type 12345 as the name, an error appears. A wrong email, a phone number starting with 1, and a weak password also fail. The strength meter updates as I type. These checks use regular expressions in JavaScript. The same rules are checked again in PHP, because JavaScript can be bypassed."  (Enter valid data and submit.)

**7. Login (30 s)**
"After registering I log in. A wrong password shows the same generic message as an unknown email, so attackers cannot discover which emails exist."

**8. Dashboard (20 s)**
"The dashboard is only for logged-in users. It shows my details, my comments and my contact submissions."

**9. Comment (30 s)**
"I post a comment. If I type a script tag, it is displayed as plain text, because all output is escaped." (Show the community page.)

**10. Database (30 s)**
"In PostgreSQL, the users table stores a hashed password, not the real one. The comments table links to the user through a foreign key."

**11. Regex testing (40 s)**
"I wrote 39 regex test cases covering valid, invalid, boundary, special character, empty and whitespace inputs. This page runs them live." (Open `regex-tester.html`; also show the terminal run of `run_unit_tests.php`.)

**12. Functional testing (20 s)**
"There are 56 functional test cases for pages, forms, sessions, admin and database behaviour. I recorded the results in the execution report."

**13. Black-box testing (20 s)**
"For black-box testing I used equivalence partitioning and boundary value analysis, for example name lengths 1, 2, 50 and 51."

**14. Security testing (20 s)**
"I tested SQL injection text, script injection, direct URL access to the dashboard and admin pages, and logout. The code uses prepared statements, escaping and CSRF tokens."

**15. Conclusion (20 s)**
"In summary, the portal meets the requirement, and the testing documents show how it was checked. Current limitations include no login throttling, email verification, or password reset. Thank you."
