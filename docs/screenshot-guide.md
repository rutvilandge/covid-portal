# Screenshot Guide

Take each screenshot with the browser address bar visible. Save with the suggested filename in a folder named `screenshots/`.

## 1. Homepage
* **Should be visible:** Full homepage top to cards, browser address bar showing the configured project URL
* **Why it matters:** Proves the site runs at the selected local or hosted URL
* **Filename:** `01-homepage.png`

## 2. COVID hero section
* **Should be visible:** Hero heading, subtitle, two buttons, virus/mask/shield illustration
* **Why it matters:** Shows the required COVID visual
* **Filename:** `02-covid-hero.png`

## 3. About page
* **Should be visible:** about.php with illustration and text
* **Why it matters:** Content requirement
* **Filename:** `03-about.png`

## 4. Symptoms page
* **Should be visible:** Symptom cards and the 'When to seek medical attention' box with disclaimer
* **Why it matters:** Content and safety disclaimer
* **Filename:** `04-symptoms.png`

## 5. Prevention page
* **Should be visible:** Prevention cards with illustration
* **Why it matters:** Content requirement
* **Filename:** `05-prevention.png`

## 6. Vaccination page
* **Should be visible:** FAQ with one answer expanded
* **Why it matters:** Interactive content
* **Filename:** `06-vaccination.png`

## 7. Registration form
* **Should be visible:** Empty register.php form with strength meter
* **Why it matters:** Shows all required fields
* **Filename:** `07-register-form.png`

## 8. Validation error
* **Should be visible:** Registration with invalid name, email, phone and weak password; red inline errors visible
* **Why it matters:** Evidence of client-side regex validation
* **Filename:** `08-validation-errors.png`

## 9. Successful registration
* **Should be visible:** Login page with green 'Registration successful' message
* **Why it matters:** Evidence of registration flow
* **Filename:** `09-registration-success.png`

## 10. Login
* **Should be visible:** Login form, and a second shot of the 'Invalid email or password' error
* **Why it matters:** Authentication evidence
* **Filename:** `10-login.png`

## 11. Dashboard
* **Should be visible:** Dashboard with welcome name, account info and comment form
* **Why it matters:** Session and authenticated area
* **Filename:** `11-dashboard.png`

## 12. Comment form
* **Should be visible:** Comment box with the character counter filled in
* **Why it matters:** Comment feature
* **Filename:** `12-comment-form.png`

## 13. Submitted comment
* **Should be visible:** The posted comment on dashboard and on the community page
* **Why it matters:** Proves storage and retrieval
* **Filename:** `13-submitted-comment.png`

## 14. Contact form
* **Should be visible:** Filled contact form and the success message
* **Why it matters:** Registration/contact form requirement
* **Filename:** `14-contact-form.png`

## 15. Database in pgAdmin or psql
* **Should be visible:** Tables users, comments, registrations with rows; users table showing hashed passwords
* **Why it matters:** Proves PostgreSQL storage and hashing
* **Filename:** `15-postgresql-tables.png`

## 16. Admin dashboard
* **Should be visible:** Admin overview plus the users table
* **Why it matters:** Authorization and admin feature
* **Filename:** `16-admin.png`

## 17. Test cases
* **Should be visible:** functional-test-cases.md opened (or exported table) showing IDs, steps, expected results
* **Why it matters:** Testing documentation
* **Filename:** `17-functional-test-cases.png`

## 18. Regex test cases
* **Should be visible:** regex-test-cases.md and the regex-tester.html page with all rows Pass
* **Why it matters:** Core SPPU testing requirement
* **Filename:** `18-regex-tests.png`

## 19. Test report
* **Should be visible:** test-execution-report.md with YOUR actual results filled in
* **Why it matters:** Execution evidence
* **Filename:** `19-test-report.png`

## 20. Final result
* **Should be visible:** Terminal output of run_unit_tests.php showing 'Failed: 0', plus test-summary.md with your final counts
* **Why it matters:** Summary of outcome
* **Filename:** `20-final-result.png`

Tip: for the validation error and the security tests, also take a second screenshot showing the browser DevTools Network tab or the matching pgAdmin/psql row if your guide asks for deeper proof.
