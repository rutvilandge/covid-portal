# Vercel + PostgreSQL checklist

## Before deployment

- [ ] Create a reachable PostgreSQL database.
- [ ] Import `database/covid_portal.sql` into the target database.
- [ ] Set `DATABASE_URL` (or the individual `DB_*` variables) in Vercel Project Settings.
- [ ] Confirm no database password is present in source files or Git history.
- [ ] Authorize Vercel CLI and link this project.

## After deployment

- [ ] Check deployment build logs and runtime logs.
- [ ] Verify the live homepage and CSS, JavaScript, and images.
- [ ] Verify `/api/health` reports a database connection.
- [ ] Run registration, login, dashboard, comment/contact, and logout against a test account.
- [ ] Record the actual production URL and outcomes; do not mark a deployment live until the URL is checked.
