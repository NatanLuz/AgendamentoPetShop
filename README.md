Pet Shop Scheduling System
A comprehensive appointment scheduling system for pet shops and veterinary clinics built with plain PHP and MySQL. This system streamlines daily operations and enhances client service management.

https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white

https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white

https://img.shields.io/badge/Project-Stable-brightgreen?style=for-the-badge

##  Features

Secure Authentication System - Login/logout with session management

Complete Client Management - CRUD operations for client records

Pet Management - Track pets with client associations

Appointment Scheduling - Book, view, and manage appointments with service types

Daily Dashboard - Overview of today's appointments at a glance

Security First - Prepared statements, CSRF protection, and output escaping

Project Structure
````
pet-shop-scheduling/
├── index.php              # Home dashboard (requires login)
├── login.php              # User authentication
├── logout.php             # Session termination
├── clientes.php           # Client management
├── pets.php               # Pet management
├── agendamentos.php       # Appointment scheduling
├── dashboard.php          # Today's appointments view
├── db/
│   ├── conexao.php        # Database connection handler
│   └── criar_tabelas.sql  # Database schema
├── helpers/
│   ├── auth.php           # Authentication utilities
│   ├── csrf.php           # CSRF protection
│   └── flash.php          # Flash message system
└── scripts/
    ├── create_db.php      # Database setup utility
    ├── reset_admin_password.php
    ├── run_smoke_suite.php
    └── setup-dev.ps1

``

``````

Quick Start

Prerequisites
PHP 7.4+ with mysqli extension

MySQL/MariaDB database

XAMPP, WAMP, or similar environment

Installation
Clone or download the project to your web server directory

cd htdocs/
git clone <repository-url> pet-shop


Set up the database

# Method 1: Using PHP script
php scripts/create_db.php

# Method 2: Manual SQL import
mysql -u root -p < db/criar_tabelas.sql

Configure database connection (if needed)

Edit db/conexao.php with your database credentials

Default expects: host=localhost, user=root, password='', database=pet_shop

Start development server

php -S localhost:8080

Access the application

http://localhost:8080/login.php

Default Login Credentials
Username: admin

Password: admin123

 Database Schema
The system uses 4 main tables:

usuarios - User accounts for system access

clientes - Client information (name, email, phone, address)

pets - Pet records linked to clients (name, species, breed, birth date)

agendamentos - Appointments with date, time, service type, and pet association

Core Functionalities
Client Management
Add new clients with contact information

View and search existing clients

Update client details

Remove client records

Pet Management
Register pets under client accounts

Track species, breed, and age

Maintain pet medical history context

Appointment System
Schedule appointments with specific date/time

Categorize by service type (consultation, grooming, vaccination, etc.)

Prevent scheduling conflicts

View daily schedule on dashboard

Security Features
Password hashing using password_hash()

Prepared statements to prevent SQL injection

CSRF tokens for form protection

Output escaping with htmlspecialchars()

Session-based authentication

Testing
Run the smoke test suite to verify functionality:

php scripts/run_smoke_suite.php

Reset admin password if needed:

php scripts/reset_admin_password.php newpassword

Development
For Windows development environment setup:

🔒 Security Notes
Change default admin password after first login

Use environment variables for production database credentials

Ensure proper file permissions on production servers

Regular updates recommended for PHP and MySQL components

License
MIT License - feel free to use for personal and commercial projects.


    
