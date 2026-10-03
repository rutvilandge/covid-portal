# Vercel + PostgreSQL deployment

The PHP app uses the Vercel community PHP runtime. PostgreSQL credentials must be configured as Vercel environment variables; never commit them to the repository.

## Database setup

1. Create a PostgreSQL database with a provider that permits connections from Vercel Functions.
2. Connect to that database and run `database/covid_portal.sql` with `psql` or the provider's SQL editor.
3. Copy the provider's PostgreSQL connection URL. Keep it private.

## Vercel settings

Set `DATABASE_URL` (or `POSTGRES_URL`) in the Vercel project's Development, Preview, and Production environments as needed. The app also accepts individual `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, and `DB_SSLMODE` variables. For a hosted database, use the provider-required TLS mode, commonly `require` or `verify-full`.

## Deploy and verify

1. Sign in with the Vercel CLI and link this project.
2. Deploy a preview, check build and runtime logs, then deploy production after the preview is healthy.
3. Visit `/api/health`; a successful response is JSON with `status: ok` and `database: connected`.
4. Test registration, login, dashboard, comment/contact submission, and logout against a disposable test account.

Vercel Functions have a read-only filesystem except for temporary scratch space. The app stores PHP sessions in PostgreSQL on Vercel so authentication survives separate function invocations. The schema includes `users`, `comments`, `registrations`, and the supporting `sessions` table.
