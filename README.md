## Pet Shop Scheduling


System for scheduling appointments for a Pet Shop / veterinary clinic, developed in plain PHP with MySQL. Designed to streamline daily operations and improve client service.

Functionalities

- Basic authentication (login/logout)
- Client CRUD
- Pet CRUD (each pet is linked to a client)
- Appointment CRUD (date, time, service type)
- Daily dashboard showing today's appointments
- Security: prepared statements, CSRF tokens, output escaping (htmlspecialchars)

Project Structure

```
index.php          # Home page (requires login)
login.php          # Login
logout.php         # Logout
clientes.php       # Client CRUD
pets.php           # Pet CRUD
agendamentos.php   # Appointment CRUD
dashboard.php      # View of today's appointments
db/
 ├─ conexao.php    # MySQL connection
 └─ criar_tabelas.sql # Database creation script
helpers/           # Authentication, CSRF and flash helpers
scripts/           # Utilities for setup and tests
```

Requirements

- PHP 7.4+ with `mysqli` extension enabled
- MySQL or MariaDB accessible

How to Run Locally

1. Configure your environment variables (DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or use default credentials (root without password).

2. Import the database using `db/criar_tabelas.sql` (or run the helper script):

```powershell
php scripts/create_db.php
# or
.\scripts\setup-dev.ps1
```

3. Start the built-in PHP server:

```powershell
php -S 127.0.0.1:8080
```

4. Open in your browser:

http://127.0.0.1:8080/login.php

Example credentials (created by the SQL script):

- User: `admin`
- Password: `admin123`

If login fails, reset the admin password:

```powershell
php scripts/reset_admin_password.php admin123
```

Quick Tests

Run the smoke test script which performs basic CRUD operations:

```powershell
php scripts/run_smoke_suite.php
```

Setup helpers are available in `scripts/setup-dev.ps1`.

Notes

- The frontend is intentionally simple and focused on demonstration.
- The project prioritizes solid backend practices, security and database integration.
- Do not commit real credentials; use `.env.example` as a reference.

If you want, I can:

- Add CI badges and screenshots to the README.
- Convert the project to use SQLite to avoid a MySQL dependency.

Thanks for using the project! If you want the README adjusted with more details (endpoints, table schemas or screenshots), tell me what to add and I will update it.
