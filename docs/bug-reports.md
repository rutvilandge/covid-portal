# Bug Reports

## Real defects found while building and pre-testing

### BUG-001 - Fatal error when the PHP `mbstring` extension is missing
| Field | Value |
|---|---|
| Bug ID | BUG-001 |
| Title | `validate_text_length()` crashes with "Call to undefined function mb_strlen()" |
| Module | Validation (`includes/validation.php`), used by comments and contact form |
| Severity | Medium (page error on comment/contact submit, only on PHP builds without mbstring) |
| Priority | P2 |
| Environment | PHP 8.3.6 CLI on Ubuntu without `php-mbstring` installed |
| Steps to reproduce | 1. Run `php tests/unit/run_unit_tests.php` on PHP without mbstring. 2. The function checks for comment/message length run. |
| Expected result | Length validation returns `null` or an error message |
| Actual result | Uncaught Error: Call to undefined function mb_strlen() |
| Root cause | The code assumed the mbstring extension is always loaded |
| Fix | Added `text_length()` which uses `mb_strlen()` when available and a UTF-8 `preg_match_all` count otherwise |
| Retest | Unit suite re-run: 51/51 checks passed. Scripted HTTP checks also passed |
| Status | Closed (fixed and verified in the builder environment). Note: XAMPP enables mbstring by default, so you are unlikely to see this |

### Test defect TD-001 - wrong expected result (not an application bug)
TC-REG-035 originally expected the password `Abc def1!` to be **invalid**. The run reported FAIL. Analysis showed the password has an uppercase letter, lowercase letter, digit and `!`, so it is valid; the expectation was wrong. The case was corrected (TC-REG-035 now uses `Abc def12`, TC-REG-039 uses `Abc def1!`). No application change was needed.

### Scripted-check issues (not application bugs)
Two problems in the temporary test script were fixed during the pre-check: it compared the HTTP header name `Location` case-sensitively, and it counted matching lines instead of matches for the contact form. Neither was an application defect.

---
## Defects found in YOUR manual testing
Add them below using the template. If you find none, write "No defects found in executed tests" - do not invent bugs.

## Bug report template (blank)
| Field | Value |
|---|---|
| Bug ID | BUG-00X |
| Title | |
| Module | |
| Severity | Critical / High / Medium / Low |
| Priority | P1 / P2 / P3 |
| Environment | OS, XAMPP, PHP, browser |
| Steps to reproduce | |
| Expected result | |
| Actual result | |
| Screenshot | |
| Status | New / Assigned / Fixed / Retest / Closed |

## Sample bug report (HYPOTHETICAL EXAMPLE - this bug did NOT happen)
| Field | Value |
|---|---|
| Bug ID | SAMPLE-001 |
| Title | Phone number starting with 5 accepted on registration |
| Module | Registration / validation |
| Severity | Medium |
| Priority | P2 |
| Environment | Windows 11, XAMPP 8.2, Chrome |
| Steps to reproduce | 1. Open register.php 2. Enter phone 5123456789 3. Fill other fields correctly 4. Submit |
| Expected result | Error: phone must start with 6, 7, 8 or 9 |
| Actual result | Account created |
| Status | Example only |
