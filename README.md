# IT0049 TSA2 Tasks for Today

A CodeIgniter 4 application extending the TSA1 Tasks for Today system. It keeps the original light gray, white, and blue visual style while adding validated task creation and editing, session-based authentication, and soft deletion through task archiving.

## Features

- Public Welcome, Task List, Profile, and About pages.
- Login and logout with a hashed demo password and a regenerated session ID.
- Authenticated users can create and edit tasks; title and task date are required.
- Authenticated users can archive tasks. Archived rows remain in MySQL and are hidden from public task pages.
- CodeIgniter migrations, seeder, and an importable MySQL export are included.

## Requirements

- PHP 8.2 or newer with `intl`, `mbstring`, and `mysqli` enabled.
- Composer.
- MySQL or MariaDB (XAMPP is suitable for local development).

## Setup with migrations and seeder

1. Start Apache and MySQL in XAMPP.
2. Open this project folder in VS Code and open **Terminal → New Terminal**.
3. Install dependencies:

   ```powershell
   composer install
   ```

4. Copy `.env.example` to `.env`. In PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   The example settings use database `tasks_today_db`, user `root`, no password, and port `3306`. Change them if your MySQL settings differ.
5. In phpMyAdmin, create a database named `tasks_today_db`.
6. From the project root, create the tables and seed the sample records:

   ```powershell
   php spark migrate
   php spark db:seed TasksTodaySeeder
   ```

7. Start the development server:

   ```powershell
   php spark serve --port 8080
   ```

8. Open `http://localhost:8080/` for the public Welcome page or `http://localhost:8080/login` to sign in.

## Alternative database setup with SQL export

Instead of the migration and seeder steps, select `tasks_today_db` in phpMyAdmin and import `sql/tasks_today_tsa2.sql`. The export creates the tables and sample records, including the demo account's bcrypt hash. Do not import the SQL export into a database that already has these tables unless you first remove the old tables.

## Demo account

- Username: `johneinstein`
- Password: `TasksDemo2026!`

The password is stored as a `password_hash()` value. The login controller verifies it with `password_verify()`.

## Access checks

- While signed out, `/`, `/tasks`, `/profile`, and `/about` should load.
- While signed out, `/tasks/new` and task edit URLs should redirect to `/login`.
- After signing in, create a task, edit it, then archive it. Confirm it disappears from the public Welcome and Task List pages while its database row still has `is_archived = 1`.
- Use **Sign out**, then test a protected URL again.

## Public demo with Cloudflare Quick Tunnel

Keep the application server running in one VS Code terminal. In a second PowerShell terminal, run `cloudflared tunnel --url http://localhost:8080`. Set `app.baseURL` in `.env` to the printed HTTPS `trycloudflare.com` URL with a trailing slash, then restart the PHP server. Quick Tunnel addresses are temporary, and the app and tunnel must remain running for the link to work.

## GitHub submission

Create an empty public repository named `IT0049-TSA2-Sison` under `johneinstein23`. From a terminal in this project folder, run:

```powershell
git init -b main
git add .
git commit -m "Build TSA2 Tasks for Today CRUD and authentication"
git remote add origin https://github.com/johneinstein23/IT0049-TSA2-Sison.git
git push -u origin main
```

`.env` and `vendor/` are excluded by `.gitignore`. Commit `.env.example`, migrations, seeder, and SQL export. Never commit database passwords or private credentials.
