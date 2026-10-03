# White-Box Testing

## 1. What is white-box testing?
White-box (structural) testing uses knowledge of the **source code**. The tester designs inputs so that specific statements, branches and conditions are executed.

## 2. Coverage ideas
* **Statement coverage:** every line runs at least once.
* **Branch (decision) coverage:** every `if` is made both true and false at least once.
* **Condition coverage:** each part of a compound condition (`A || B || C`) is made true and false.

## 3. Unit under test: login decision (`actions/login_action.php`)
```php
if (!$user || !password_verify($pw, $user['password']) || ($adminLogin && $user['role'] !== 'admin')) {
    // fail: generic error
}
// else: login_user() + redirect
```
Conditions: **C1** `!$user` (no such email), **C2** `!password_verify(...)` (wrong password), **C3** `$adminLogin && role !== 'admin'` (admin form used by a non-admin).

| Path | C1 | C2 | C3 | Test input | Result |
|---|---|---|---|---|---|
| P1 | T | (skipped) | (skipped) | unknown email | fail |
| P2 | F | T | (skipped) | right email, wrong password | fail |
| P3 | F | F | T | normal user on admin login form | fail |
| P4 | F | F | F | right credentials | success |

Four tests give **100% branch coverage** and make every condition both true and false of this statement.

## 4. Unit under test: registration (`actions/register_action.php`)
Decision points: request method is POST? CSRF valid? any validation error? email already exists? insert throws PDOException (duplicate / other)?

| Path | Input | Expected |
|---|---|---|
| R1 | GET request | redirect to register page |
| R2 | POST without valid CSRF | "session expired" message |
| R3 | POST with invalid fields | errors saved, redirect back |
| R4 | POST with existing email | duplicate error |
| R5 | POST valid data | row inserted, redirect to login |
| R6 | DB unavailable (stop PostgreSQL) | friendly generic error, error written to `php-error.log` |

## 5. Unit under test: `validate_text_length($v, $min, $max, $label)`
Branches: empty -> "required"; shorter than min; longer than max; otherwise `null`.
Inputs: `''`, `abcd` (min 5), `abcde`, 500 chars, 501 chars. These five are automated in `tests/unit/run_unit_tests.php`.

## 6. Coverage measurement
No coverage percentage is reported here because it was **not measured with a coverage tool** (such as Xdebug + PHPUnit). The path tables above show which paths are covered by design. If you want a measured figure, install Xdebug and PHPUnit and record the real output.
