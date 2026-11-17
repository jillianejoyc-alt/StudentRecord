# StudentRecord Management System

A Laravel application dedicated to maintaining student profiles and academic records. The application database contains only the `students` table; it does not use user accounts, cache, session, or job tables.

## Features

- Dashboard totals for students, male and female students, and distinct courses, plus recently added students.
- Add, view, edit, and delete student records.
- Search by student number, first/middle/last name, or course.
- Validated forms, unique student numbers, CSRF protection, and success/error feedback.
- Responsive purple and navy Bootstrap interface.
- MySQL/MariaDB for local development and PostgreSQL or MySQL for deployment.

## Local Setup

1. Install PHP 8.2+, Composer, and MySQL/MariaDB. To use SQLite instead, set `DB_CONNECTION=sqlite` and `DB_DATABASE=database/database.sqlite`.
2. Install dependencies and configure the app:

   ```sh
   composer install
   copy .env.example .env
   php artisan key:generate
   ```

3. Create an empty local database named `student_record_db` and configure `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`.
4. Create the tables and launch the app on port 8002:

   ```sh
   php artisan migrate
   php artisan serve --host=127.0.0.1 --port=8002
   ```

   Open [http://127.0.0.1:8002](http://127.0.0.1:8002).

The only application migration creates the `students` table. `database.sql` is an optional MySQL/MariaDB schema for manual setup; use either the SQL file or Laravel migrations, not both on the same database. Sessions and cache are stored in files, and queues run synchronously, so no additional database tables are required.

## Tests

```sh
php artisan test
```

The feature tests use an in-memory SQLite database and cover CRUD, search, validation, uniqueness, and dashboard metrics.

## GitHub

Create an empty GitHub repository named `StudentRecord`, then push the project:

```sh
git init
git add .
git commit -m "Initial StudentRecord System"
git branch -M main
git remote add origin YOUR_GITHUB_REPOSITORY_URL
git push -u origin main
```

For future updates:

```sh
git add .
git commit -m "Update StudentRecord"
git push
```

Never commit `.env`, database passwords, API keys, or other secrets.

## Render Deployment

1. Push the repository to GitHub and create a Render **Web Service** from it using the **Docker** runtime. The root `Dockerfile` installs both PostgreSQL and MySQL PDO drivers, configures Apache to serve Laravel's `public` directory, and runs migrations when the container starts.
2. Configure the service environment in Render:

   | Variable | Value |
   | --- | --- |
   | `APP_ENV` | `production` |
   | `APP_DEBUG` | `false` |
   | `APP_KEY` | A generated Laravel key (`php artisan key:generate --show`) |
   | `APP_URL` | The deployed Render service URL |
   | `DB_CONNECTION` | `pgsql` when using Render PostgreSQL |
   | `DATABASE_URL` | The Render PostgreSQL internal connection string |

   Keep secrets in Render's environment settings. For an external MySQL database, set `DB_CONNECTION=mysql` and configure `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` instead.
3. Deploy and check the service logs for a successful migration. The container entrypoint uses Render's assigned `PORT`; port 8002 is for local development only.

## Project Structure

- `app/Http/Controllers/StudentController.php` - dashboard queries and student CRUD actions.
- `app/Models/Student.php` - student record model.
- `database/migrations/` - the student-only Laravel schema migration.
- `database.sql` - optional standalone MySQL/MariaDB schema.
- `resources/views/students/` - student list, form, and details templates.
- `resources/views/` - dashboard and shared layout templates.
- `public/assets/` - custom CSS and JavaScript.
- `Dockerfile`, `docker-entrypoint.sh` - Render-compatible runtime.
"# StudentRecord" 
"# StudentRecord" 
"# StudentRecord" 
