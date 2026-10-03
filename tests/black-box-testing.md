# Black-Box Testing

## 1. What is black-box testing?
Black-box testing checks **what the software does** without looking at its code. The tester gives inputs through the user interface and compares the outputs with the requirement. Internal structure, PHP code and SQL are ignored.

## 2. Why it applies to this project
The SPPU requirement describes behaviour (register, log in, comment, submit a form, validate with regular expressions). Every one of these can be tested from the browser by a person who has never seen the source code.

## 3. Techniques used
* **Equivalence Partitioning (EP):** inputs are split into groups that the program should treat the same way (valid group, invalid groups). One test per group is enough.
* **Boundary Value Analysis (BVA):** bugs cluster at the edges, so we test the minimum, maximum and the values just outside them.

## 4. Registration form

| Field | Valid partition | Invalid partitions | Boundary values |
|---|---|---|---|
| Full name | 2-50 letters/spaces | empty, digits, symbols, >50 chars | 1 (invalid), 2 (valid), 50 (valid), 51 (invalid) |
| Email | `local@domain.tld` | empty, no @, no domain, spaces, TLD of 1 letter | TLD 1 letter (invalid) / 2 letters (valid) |
| Phone | 10 digits, first digit 6-9 | empty, letters, <10 or >10 digits, first digit 0-5 | 9 digits (invalid), 10 (valid), 11 (invalid); first digit 5 (invalid), 6 (valid) |
| Password | 8-64 chars with upper, lower, digit, special | empty, missing one class, too short, too long | 7 (invalid), 8 (valid), 64 (valid), 65 (invalid) |
| Confirm password | equals password | empty, different | - |

| ID | Technique | Input | Expected output |
|---|---|---|---|
| BB-REG-01 | EP valid | Rutvi Landge / rutvi@example.com / 9876543210 / Rutvi@123 / same | Account created, redirect to login |
| BB-REG-02 | EP invalid name | `12345` | Name error |
| BB-REG-03 | BVA | Name `A` | Name error |
| BB-REG-04 | BVA | Name `Al` | Accepted |
| BB-REG-05 | BVA | Name of 51 letters | Name error |
| BB-REG-06 | BVA | Phone `987654321` (9 digits) | Phone error |
| BB-REG-07 | BVA | Phone `6000000000` | Accepted |
| BB-REG-08 | BVA | Phone `5999999999` | Phone error |
| BB-REG-09 | BVA | Password `Abcde1!` (7) | Password error |
| BB-REG-10 | BVA | Password `Abcdef1!` (8) | Accepted |
| BB-REG-11 | EP invalid | Password without special char `Abcdefg12` | Password error |
| BB-REG-12 | EP invalid | Confirm password different | Mismatch error |
| BB-REG-13 | EP invalid | Email already registered | "already registered" error |

## 5. Login form

| ID | Technique | Input | Expected output |
|---|---|---|---|
| BB-LOG-01 | EP valid | Registered email + correct password | Dashboard |
| BB-LOG-02 | EP invalid | Registered email + wrong password | "Invalid email or password." |
| BB-LOG-03 | EP invalid | Unregistered email | Same generic message |
| BB-LOG-04 | EP invalid | Empty email / empty password | Required errors |
| BB-LOG-05 | EP invalid | Email in wrong format | Email format error |
| BB-LOG-06 | EP (case) | Registered email typed in capitals | Login succeeds (email stored in lower case) |

## 6. Comment form (length 5-500)

| ID | Technique | Input length | Expected output |
|---|---|---|---|
| BB-COM-01 | BVA | 4 characters | Error |
| BB-COM-02 | BVA | 5 characters | Accepted |
| BB-COM-03 | BVA | 500 characters | Accepted |
| BB-COM-04 | BVA | 501 characters | Error |
| BB-COM-05 | EP invalid | Empty / spaces only | Required error |
| BB-COM-06 | EP special | `<b>bold</b>` | Stored; displayed as visible text, not formatted |

## 7. Contact form (message length 10-500)

| ID | Technique | Input | Expected output |
|---|---|---|---|
| BB-CON-01 | EP valid | All fields valid | Success message, row stored |
| BB-CON-02 | BVA | Message of 9 characters | Error |
| BB-CON-03 | BVA | Message of 10 characters | Accepted |
| BB-CON-04 | BVA | Message of 500 / 501 characters | 500 accepted, 501 rejected |
| BB-CON-05 | EP invalid | Invalid phone | Phone error |
| BB-CON-06 | EP invalid | Invalid email | Email error |

These scenarios are also covered as numbered cases in `functional-test-cases.md`. Status: **Not Executed** until you run them.
