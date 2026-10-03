# Test Summary

Numbers below are real counts of documented cases. "Executed" for your manual tests is **Pending** until you run them. Do not type numbers you have not produced.

## Documented test cases
| Document | Cases |
|---|---|
| Functional (`tests/functional-test-cases.md`) | 56 |
| Regex (`tests/regex-test-cases.md`) | 39 |
| Black-box scenarios (`tests/black-box-testing.md`) | 31 |
| Integration (`tests/integration-testing.md`) | 9 |
| Database (`tests/database-testing.md`) | 16 |
| Security (`tests/security-testing.md`) | 20 |
| **Total documented** | **171** |

## Your manual execution (fill in)
| Measure | Value |
|---|---|
| Total test cases | 171 |
| Executed | Pending |
| Passed | Pending |
| Failed | Pending |
| Blocked | Pending |
| Not Executed | Pending |
| Defects discovered | Pending (BUG-001 was found during the builder pre-check) |
| Defects fixed | Pending |

## Builder pre-check (automated, not on XAMPP)
| Measure | Value |
|---|---|
| Regex cases run (PHP) | 39, all passed |
| Regex cases run (JavaScript, Node) | 39, results identical to PHP |
| Function-level unit checks | 12, all passed |
| Scripted HTTP end-to-end checks | 56, all passed (after fixing two script issues) |
| Application defects found | 1 (BUG-001, fixed and retested) |
| Test-case defects found | 1 (TD-001, corrected) |
| Code coverage | Not measured |

## Final observations (edit after testing)
* Strengths: validation is done on both client and server; prepared statements and output escaping are used throughout.
* Limitations: no login throttling, no HTTPS, no email verification (see `tests/security-testing.md`).
