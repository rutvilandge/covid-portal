# Regular Expression Test Cases

**Project:** COVID-19 Information & Awareness Portal
**Requirement:** "Regular Expression testcases for testing purpose"

## 1. Regular expressions under test

The same patterns are used in PHP (`includes/validation.php`) and JavaScript (`assets/js/script.js`).

| Field | Pattern | Rule in words |
|---|---|---|
| Name | `^[A-Za-z ]{2,50}$` | 2-50 letters or spaces |
| Email | `^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$` | local part, `@`, domain labels, TLD of 2+ letters (also max 100 chars, checked in code) |
| Indian phone | `^[6-9][0-9]{9}$` | exactly 10 digits, first digit 6-9 |
| Password | `^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9\s]).{8,64}$` | 8-64 chars with lowercase, uppercase, digit and a non-space special character |

Notes: input is **trimmed** by the application before the regex runs (except passwords). Contact message (10-500) and comment (5-500) are length-checked rather than regex-checked.

## 2. How these cases were run

* **PHP (PCRE):** `php tests/unit/run_unit_tests.php` - run in the build environment (PHP 8.3 CLI).
* **JavaScript:** the same 39 cases were run against `assets/js/script.js` with Node.js, and are also available in your browser at `tests/regex-tester.html`.
* Both engines gave **identical results for all 39 cases**.
* Re-run on your own PHP environment (`php tests/unit/run_unit_tests.php` and the browser page) and note your own date and name before submission.

## 3. Test cases (39 total)

Categories: Valid, Invalid, Boundary, Special character, Empty, Whitespace.

| Test ID | Field | Input | Category | Expected Result | Actual Result | Status |
|---|---|---|---|---|---|---|
| TC-REG-001 | name | `Rutvi Landge` | Valid | Valid | Valid | Pass |
| TC-REG-002 | name | `12345` | Invalid | Invalid | Invalid | Pass |
| TC-REG-003 | email | `rutvi@gmail.com` | Valid | Valid | Valid | Pass |
| TC-REG-004 | email | `rutvi@` | Invalid | Invalid | Invalid | Pass |
| TC-REG-005 | phone | `9876543210` | Valid | Valid | Valid | Pass |
| TC-REG-006 | phone | `1234567890` | Invalid | Invalid | Invalid | Pass |
| TC-REG-007 | password | `Rutvi@123` | Valid | Valid | Valid | Pass |
| TC-REG-008 | password | `password` | Invalid | Invalid | Invalid | Pass |
| TC-REG-009 | name | `Al` | Boundary | Valid | Valid | Pass |
| TC-REG-010 | name | `A` | Boundary | Invalid | Invalid | Pass |
| TC-REG-011 | name | `AAAAAAAAAA... (50 chars)` | Boundary | Valid | Valid | Pass |
| TC-REG-012 | name | `AAAAAAAAAA... (51 chars)` | Boundary | Invalid | Invalid | Pass |
| TC-REG-013 | name | `Rutvi@Landge` | Special character | Invalid | Invalid | Pass |
| TC-REG-014 | name | `(empty)` | Empty | Invalid | Invalid | Pass |
| TC-REG-015 | name | `(3 spaces)` | Whitespace | Valid | Valid | Pass |
| TC-REG-016 | email | `(empty)` | Empty | Invalid | Invalid | Pass |
| TC-REG-017 | email | `rutvi.land... (37 chars)` | Valid | Valid | Valid | Pass |
| TC-REG-018 | email | `rutvi gmail.com` | Invalid | Invalid | Invalid | Pass |
| TC-REG-019 | email | `rutvi@gmail.c` | Boundary | Invalid | Invalid | Pass |
| TC-REG-020 | email | `rutvi@gmail.co` | Boundary | Valid | Valid | Pass |
| TC-REG-021 | email | `x' OR '1'='1` | Special character | Invalid | Invalid | Pass |
| TC-REG-022 | phone | `6000000000` | Boundary | Valid | Valid | Pass |
| TC-REG-023 | phone | `5999999999` | Boundary | Invalid | Invalid | Pass |
| TC-REG-024 | phone | `987654321` | Boundary | Invalid | Invalid | Pass |
| TC-REG-025 | phone | `98765432101` | Boundary | Invalid | Invalid | Pass |
| TC-REG-026 | phone | `98765 43210` | Whitespace | Invalid | Invalid | Pass |
| TC-REG-027 | phone | `98765abcde` | Special character | Invalid | Invalid | Pass |
| TC-REG-028 | phone | `(empty)` | Empty | Invalid | Invalid | Pass |
| TC-REG-029 | password | `Abcdef1!` | Boundary | Valid | Valid | Pass |
| TC-REG-030 | password | `Abcde1!` | Boundary | Invalid | Invalid | Pass |
| TC-REG-031 | password | `abcdefg1!` | Invalid | Invalid | Invalid | Pass |
| TC-REG-032 | password | `ABCDEFG1!` | Invalid | Invalid | Invalid | Pass |
| TC-REG-033 | password | `Abcdefgh!` | Invalid | Invalid | Invalid | Pass |
| TC-REG-034 | password | `Abcdefg12` | Invalid | Invalid | Invalid | Pass |
| TC-REG-035 | password | `Abc def12` | Whitespace | Invalid | Invalid | Pass |
| TC-REG-036 | password | `(empty)` | Empty | Invalid | Invalid | Pass |
| TC-REG-037 | password | `Aa1!xxxxxx... (64 chars)` | Boundary | Valid | Valid | Pass |
| TC-REG-038 | password | `Aa1!xxxxxx... (65 chars)` | Boundary | Invalid | Invalid | Pass |
| TC-REG-039 | password | `Abc def1!` | Whitespace | Valid | Valid | Pass |

## 4. Observations

* TC-REG-015: the name regex on its own accepts spaces-only text. The application trims input first, so the field becomes empty and the "required" check rejects it. (Confirmed by unit check `validate_name("")`.)
* TC-REG-035 / TC-REG-039: a space inside a password is allowed, but a space does **not** count as the required special character.
* While preparing these cases, one expectation was wrong in the first draft (a password containing both a space and `!` is valid). It was a mistake in the test, not in the application, and was corrected before the final run.
