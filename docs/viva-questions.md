# Viva Questions and Answers (46)

**Q1. What is HTML?**
HyperText Markup Language. It defines the structure of a web page using tags like headings, forms and images.

**Q2. What is CSS and how did you use it?**
Cascading Style Sheets control appearance. I used one stylesheet with CSS variables, flexbox/grid and media queries for the responsive layout.

**Q3. What is a media query?**
A CSS rule that applies styles only for certain screen sizes, for example `@media (max-width:760px)` collapses the menu.

**Q4. Why Vanilla JavaScript?**
The requirement asks for plain JavaScript, no frameworks. It handles validation, the mobile menu, password strength and counters.

**Q5. What is the DOM?**
The Document Object Model is the browser's tree of page elements that JavaScript can read and change.

**Q6. Why validate in both JavaScript and PHP?**
JavaScript gives instant feedback but can be disabled or bypassed. PHP validation is the real protection.

**Q7. What is PHP?**
A server-side scripting language. The server runs the PHP and sends only the HTML result to the browser.

**Q8. How does PHP connect to PostgreSQL here?**
Through PDO in `config/database.php`, with exceptions enabled and real prepared statements.

**Q9. What is PDO and why prefer it?**
PHP Data Objects, a database access layer. It supports prepared statements and many databases.

**Q10. What is a prepared statement?**
A query with placeholders (`?`). The SQL and the data are sent separately so data can never change the query structure.

**Q11. What is SQL injection?**
Attacker input that alters a SQL query, like `' OR '1'='1`. Prepared statements prevent it.

**Q12. What is XSS?**
Cross-site scripting: injecting script into a page that other users view. I prevent it with `htmlspecialchars()` on all output.

**Q13. What does htmlspecialchars() do?**
It converts characters like `<` and `>` into HTML entities so they show as text instead of running as code.

**Q14. What is CSRF?**
Cross-site request forgery: tricking a logged-in user's browser into sending an unwanted request. Each form carries a secret token that the server checks.

**Q15. What is a session?**
Server-side storage of data per visitor, linked by a cookie holding the session ID. I store the user id, name and role.

**Q16. What is session fixation and how do you avoid it?**
An attacker sets a known session ID before login. I call `session_regenerate_id(true)` on login.

**Q17. How is login done?**
Find the user by email with a prepared statement, check `password_verify()`, then start the session and redirect to the dashboard.

**Q18. Why hash passwords?**
If the database leaks, attackers should not see real passwords. Hashing is one-way.

**Q19. Which hash do you use?**
`password_hash()` with `PASSWORD_DEFAULT` (bcrypt today); it adds a random salt. Verification uses `password_verify()`.

**Q20. Why not MD5 or SHA1?**
They are fast and unsalted by default, so they are easy to brute-force. bcrypt is deliberately slow.

**Q21. Why the same error for wrong email and wrong password?**
To avoid account enumeration: an attacker cannot learn which emails are registered.

**Q22. What are primary and foreign keys here?**
`id` is the primary key in each table. `comments.user_id` is a foreign key to `users.id`.

**Q23. What happens when a user is deleted?**
Their comments are deleted (ON DELETE CASCADE). Contact messages stay with `user_id` set to NULL.

**Q24. What does UNIQUE on email do?**
PostgreSQL refuses a second account with the same email, even if PHP's check is bypassed.

**Q25. What is a regular expression?**
A pattern that describes a set of strings, used to check whether input has the right format.

**Q26. Explain the phone regex `^[6-9][0-9]{9}$`.**
Start, one digit 6-9, then exactly nine digits, then end. So 10 digits beginning with 6-9.

**Q27. Explain the name regex.**
`^[A-Za-z ]{2,50}$`: only letters and spaces, 2 to 50 characters.

**Q28. Explain the password regex.**
Four lookaheads require a lowercase, an uppercase, a digit and a special character; `.{8,64}` sets the length.

**Q29. What is a lookahead?**
`(?=...)` checks that something exists ahead without consuming characters; it lets one regex test several rules.

**Q30. What is black-box testing?**
Testing behaviour using inputs and outputs only, without looking at code.

**Q31. What is white-box testing?**
Testing using knowledge of the code, aiming to cover statements, branches and conditions.

**Q32. What is equivalence partitioning?**
Grouping inputs that behave the same way and testing one value per group.

**Q33. What is boundary value analysis?**
Testing at the edges of ranges, like name length 1, 2, 50 and 51.

**Q34. What is unit testing?**
Testing the smallest pieces, such as one validation function, in isolation. Mine run with `run_unit_tests.php`.

**Q35. What is integration testing?**
Testing that modules work together, e.g. form -> PHP -> PostgreSQL -> dashboard.

**Q36. What is functional testing?**
Checking that each feature does what the requirements say.

**Q37. What is a test case?**
A documented scenario with ID, steps, input data, expected result and actual result.

**Q38. What is the difference between severity and priority?**
Severity is the technical impact of the bug; priority is how urgently it should be fixed.

**Q39. What is a bug taxonomy?**
A classification of defects (functional, UI, validation, database, security...) for consistent reporting.

**Q40. What goes into a test plan?**
Scope, objectives, approach, environment, entry/exit criteria, roles, risks and deliverables.

**Q41. What are acceptance criteria?**
Conditions that must be met for the customer or examiner to accept the product.

**Q42. What is regression testing?**
Re-running tests after a change to make sure nothing that worked before broke. I re-ran the unit suite after fixing BUG-001.

**Q43. Did you find any bugs?**
One real one: the code needed the mbstring extension, which was missing in my test PHP. I added a fallback and retested. I also fixed one wrong expectation in a test case.

**Q44. Why did you not claim 100% coverage?**
Because I did not measure it with a coverage tool; claiming a number without measuring would be dishonest.

**Q45. What are the limitations of your project?**
No login throttling, no email verification or password reset, and sample statistics rather than live data.

**Q46. How would you improve it?**
Add rate limiting, HTTPS, email verification, a live data API, automated PHPUnit tests with coverage, and pagination for comments.
