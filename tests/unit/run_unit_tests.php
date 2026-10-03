<?php
/**
 * Command-line unit tests for the validation rules.
 *   Run:  php tests/unit/run_unit_tests.php (or php.exe tests\unit\run_unit_tests.php on Windows)
 * No database needed. Exit code 1 if any test fails.
 */
require_once __DIR__ . '/../../includes/validation.php';

$rx = ['name' => RX_NAME, 'email' => RX_EMAIL, 'phone' => RX_PHONE, 'password' => RX_PASSWORD];
$cases = require __DIR__ . '/regex_cases.php';
$pass = $fail = 0;
$md = "| Test ID | Field | Input | Expected | Actual | Status |\n|---|---|---|---|---|---|\n";
foreach ($cases as [$id, $field, $input, $expected, $cat, $note]) {
    $actual = (bool)preg_match($rx[$field], $input);
    $ok = $actual === $expected;
    $ok ? $pass++ : $fail++;
    $shown = strlen($input) > 24 ? substr($input, 0, 10) . '...(' . strlen($input) . ' chars)' : $input;
    $shown = $shown === '' ? '(empty)' : ($shown === '   ' ? '(3 spaces)' : $shown);
    printf("%-11s %-9s %-4s %s\n", $id, $field, $ok ? 'PASS' : 'FAIL', $note);
    $md .= '| ' . implode(' | ', [$id, $field, '`' . str_replace('|', '\|', $shown) . '`', $expected ? 'Valid' : 'Invalid', $actual ? 'Valid' : 'Invalid', $ok ? 'Pass' : 'FAIL']) . " |\n";
}

// Validator-function tests (message vs null) and trimmed-whitespace behaviour
$fn = [
  ['validate_name("   ")', validate_name('') !== null],
  ['validate_name("Rutvi Landge")', validate_name('Rutvi Landge') === null],
  ['validate_confirm mismatch', validate_confirm('Abc@1234', 'Abc@12345') !== null],
  ['validate_confirm match', validate_confirm('Abc@1234', 'Abc@1234') === null],
  ['comment length 4 rejected', validate_text_length('abcd', COMMENT_MIN, COMMENT_MAX, 'Comment') !== null],
  ['comment length 5 accepted', validate_text_length('abcde', COMMENT_MIN, COMMENT_MAX, 'Comment') === null],
  ['comment length 500 accepted', validate_text_length(str_repeat('a', 500), COMMENT_MIN, COMMENT_MAX, 'Comment') === null],
  ['comment length 501 rejected', validate_text_length(str_repeat('a', 501), COMMENT_MIN, COMMENT_MAX, 'Comment') !== null],
  ['message length 9 rejected', validate_text_length(str_repeat('a', 9), MESSAGE_MIN, MESSAGE_MAX, 'Message') !== null],
  ['message length 10 accepted', validate_text_length(str_repeat('a', 10), MESSAGE_MIN, MESSAGE_MAX, 'Message') === null],
  ['password_hash/verify round trip', password_verify('Rutvi@123', password_hash('Rutvi@123', PASSWORD_DEFAULT))],
  ['password_verify rejects wrong pw', !password_verify('wrong', password_hash('Rutvi@123', PASSWORD_DEFAULT))],
];
foreach ($fn as [$label, $ok]) { $ok ? $pass++ : $fail++; printf("%-11s %-9s %-4s %s\n", 'UNIT', 'function', $ok ? 'PASS' : 'FAIL', $label); }

echo "\nRegex cases: " . count($cases) . " | Function checks: " . count($fn) . " | Passed: $pass | Failed: $fail\n";
if (in_array('--markdown', $argv ?? [], true)) file_put_contents(__DIR__ . '/regex_results.md', $md);
exit($fail ? 1 : 0);
