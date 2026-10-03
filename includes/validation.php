<?php
/**
 * Validation rules. These regular expressions are MIRRORED in assets/js/script.js.
 * Keep both in sync - they are the subject of the regex test cases (tests/regex-test-cases.md).
 */
const RX_NAME     = '/^[A-Za-z ]{2,50}$/';
const RX_EMAIL    = '/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$/';
const RX_PHONE    = '/^[6-9][0-9]{9}$/';
const RX_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9\s]).{8,64}$/';

const COMMENT_MIN = 5;
const COMMENT_MAX = 500;
const MESSAGE_MIN = 10;
const MESSAGE_MAX = 500;
const EMAIL_MAX   = 100;

/** Character count (UTF-8 safe); falls back if the mbstring extension is missing. */
function text_length(string $v): int
{
    return function_exists('mb_strlen') ? mb_strlen($v, 'UTF-8') : (int)preg_match_all('/./us', $v);
}

// Each validator returns an error message string, or null when the value is valid.

function validate_name(string $v): ?string
{
    if ($v === '') return 'Full name is required.';
    if (!preg_match(RX_NAME, $v)) return 'Name must be 2-50 letters and spaces only.';
    return null;
}

function validate_email(string $v): ?string
{
    if ($v === '') return 'Email is required.';
    if (strlen($v) > EMAIL_MAX || !preg_match(RX_EMAIL, $v)) return 'Enter a valid email address, for example name@example.com.';
    return null;
}

function validate_phone(string $v): ?string
{
    if ($v === '') return 'Phone number is required.';
    if (!preg_match(RX_PHONE, $v)) return 'Enter a 10-digit Indian mobile number starting with 6, 7, 8 or 9.';
    return null;
}

function validate_password(string $v): ?string
{
    if ($v === '') return 'Password is required.';
    if (!preg_match(RX_PASSWORD, $v)) return 'Password needs 8-64 characters with an uppercase letter, a lowercase letter, a digit and a special character.';
    return null;
}

function validate_confirm(string $pw, string $confirm): ?string
{
    if ($confirm === '') return 'Please confirm your password.';
    if ($pw !== $confirm) return 'Passwords do not match.';
    return null;
}

function validate_text_length(string $v, int $min, int $max, string $label): ?string
{
    $len = text_length($v);
    if ($v === '') return "$label is required.";
    if ($len < $min) return "$label must be at least $min characters.";
    if ($len > $max) return "$label must be at most $max characters.";
    return null;
}
