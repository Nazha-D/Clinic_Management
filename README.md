# Clinic Management System API

A secure Laravel backend API for managing a multi-doctor clinic.  
Built for practice purposes to apply clean code principles and Laravel best practices.

## Tech Stack
- Laravel 12
- Laravel Sanctum (API Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- MySQL

## Project Status
This project is actively under development. See below for what's done and what's coming.

## ✅ Completed
- Database design and migrations (all tables)
- Roles & Permissions setup (Super Admin, Doctor, Receptionist, Accountant)
- Authentication (register, login, logout, reset password, update profile)
- Exception handling (centralized via bootstrap/app.php)
- Feature tests for authentication

## 🚧 In Progress / Coming Soon
- Doctor management endpoints
- Patient management endpoints
- Appointment booking and tracking
- Medical records and prescriptions
- Invoice and payment management
- Reports

## Roles & Permissions
| Role | Access |
|------|--------|
| Super Admin | Full access |
| Doctor | Appointments, Medical Records, Prescriptions |
| Receptionist | Patients, Appointments |
| Accountant | Invoices, Reports |

## Database Schema
![ERD](public/Clinic_ERD.png)

## Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```