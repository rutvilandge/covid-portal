# Database Testing

Database: `covid_portal` (PostgreSQL). Tables: `users`, `comments`, `registrations`. Run the SQL in `psql` or pgAdmin. All statuses are **Not Executed** until you run them.

| ID | Area | Action (SQL or UI) | Expected result | Actual | Status |
|---|---|---|---|---|---|
| DB-01 | Insert | Register a user through the UI | One new row in `users`; `created_at` auto-filled; `role` = `user` | Not Executed | Not Executed |
| DB-02 | Select | `SELECT id, full_name, email, role FROM users;` | Admin row plus registered users | Not Executed | Not Executed |
| DB-03 | Password storage | `SELECT password FROM users;` | Values start with `$2y$`, 60 characters; never the plain password | Not Executed | Not Executed |
| DB-04 | Duplicate email | `INSERT INTO users (full_name,email,phone,password) VALUES ('A B','duplicate@example.test','9876543210','x');` | Unique violation (SQLSTATE 23505) | Not Executed | Not Executed |
| DB-05 | NOT NULL | `INSERT INTO users (full_name,email,phone) VALUES ('A B','n@x.com','9876543210');` | NOT NULL violation (SQLSTATE 23502) | Not Executed | Not Executed |
| DB-06 | Invalid data length | Insert a name longer than 50 chars | Value-too-long error (SQLSTATE 22001) | Not Executed | Not Executed |
| DB-07 | Foreign key (comments) | `INSERT INTO comments (user_id,comment) VALUES (9999,'test');` | Foreign key violation (SQLSTATE 23503) | Not Executed | Not Executed |
| DB-08 | User-specific comments | `SELECT c.comment FROM comments c WHERE c.user_id = <id>;` after two users post | Only that user's comments are returned | Not Executed | Not Executed |
| DB-09 | Join | `SELECT u.full_name, c.comment FROM comments c JOIN users u ON u.id=c.user_id;` | Each comment paired with its author | Not Executed | Not Executed |
| DB-10 | Update (moderation) | Hide a comment from Admin > Comments, then `SELECT status FROM comments WHERE id=<id>;` | `hidden` | Not Executed | Not Executed |
| DB-11 | Delete cascade | Delete a user that has comments | The user's comments are removed (ON DELETE CASCADE) | Not Executed | Not Executed |
| DB-12 | Delete set null | Delete a user that has contact submissions | Rows remain, `user_id` becomes NULL (ON DELETE SET NULL) | Not Executed | Not Executed |
| DB-13 | Guest submission | Submit contact form while logged out | `registrations.user_id` is NULL | Not Executed | Not Executed |
| DB-14 | Persistence | Restart XAMPP, run `SELECT COUNT(*) FROM users;` | Same count as before restart | Not Executed | Not Executed |
| DB-15 | SQL injection text stored safely | Post comment `'); DROP TABLE users;--` | Stored as plain text; tables unaffected | Not Executed | Not Executed |
| DB-16 | Character set | Post a comment with Hindi/emoji text | Stored and displayed correctly (UTF8 database encoding) | Not Executed | Not Executed |
