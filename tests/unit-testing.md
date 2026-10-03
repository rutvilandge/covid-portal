# Unit Testing

## 1. Testable units
All in `includes/validation.php` (pure functions, no database needed):

| Unit | Input -> Output |
|---|---|
| `validate_name()` | string -> error message or `null` |
| `validate_email()` | string -> error message or `null` |
| `validate_phone()` | string -> error message or `null` |
| `validate_password()` | string -> error message or `null` |
| `validate_confirm()` | two strings -> error message or `null` |
| `validate_text_length()` | string, min, max, label -> error message or `null` |
| `password_hash()` / `password_verify()` | round trip check |

The same regexes exist in JavaScript (`PortalValidators.RX` in `assets/js/script.js`).

## 2. Automated unit tests (included)
```
php tests/unit/run_unit_tests.php
```
(or `php tests/unit/run_unit_tests.php` on Linux/macOS). The script
* runs all **39 regex cases** from `tests/unit/regex_cases.php`,
* runs **12 function-level checks** (length boundaries, confirm password, hashing),
* prints PASS/FAIL per case and exits with code 1 if anything fails,
* with `--markdown` writes `tests/unit/regex_results.md`.

Builder run result (PHP 8.3 CLI): 51 checks, 51 passed, 0 failed. Re-run it on your machine and use your own output as evidence.

## 3. JavaScript unit tests
Open `tests/regex-tester.html` under the configured project URL. It runs the same 39 cases against the JavaScript regexes and shows Pass/Fail for each, and lets you type your own input.

## 4. Manual unit-test procedure (if automation is not allowed)
1. Open `regex-tester.html` and type each value from `regex-test-cases.md` into the "Try your own input" box.
2. Compare the Valid/Invalid result with the Expected column.
3. Record any difference as a defect in `docs/bug-reports.md`.
