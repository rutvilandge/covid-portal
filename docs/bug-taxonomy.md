# Bug Taxonomy

A bug taxonomy is a classification of defects so they can be reported, counted and compared consistently.

| Category | Meaning | Simple example in this project |
|---|---|---|
| Functional bug | Feature does not do what the requirement says | Comment is accepted but never appears on the community page |
| UI bug | Visual or layout problem | Hero image overflows its container on a phone |
| Validation bug | Wrong input accepted or valid input rejected | Phone number starting with 5 is accepted |
| Database bug | Data stored, read or related incorrectly | Comment saved against the wrong `user_id` |
| Security bug | Weakness that can be abused | Comment text with `<script>` runs in the browser (XSS) |
| Authentication bug | Problem proving who the user is | Login succeeds with a wrong password |
| Authorization bug | Problem with what a user may do | Normal user opens `admin/users.php` |
| Compatibility bug | Works in one browser/device but not another | Mobile menu does not open in Firefox |
| Performance bug | Too slow or resource heavy | Community page takes seconds to load with many comments |
| Usability bug | Hard or confusing to use | Error message does not say which field is wrong |

## Severity and priority
* **Severity** = how bad the effect is on the system. *Critical* (data loss, security breach, system unusable), *High* (major feature broken), *Medium* (feature partly broken, workaround exists), *Low* (cosmetic).
* **Priority** = how soon it should be fixed. *P1* immediately, *P2* before release, *P3* when time allows.
* They are different: a typo in the site name on the homepage is Low severity but may be High priority; a rare crash in an unused page may be High severity but Low priority.

## Bug life cycle
New -> Assigned -> In progress -> Fixed -> Retest -> Closed (or Reopened if the retest fails; Rejected / Duplicate / Deferred where applicable).
