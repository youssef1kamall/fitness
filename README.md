# Fitpass HOPn - Membership Plan Management System

A Laravel-based fitness membership management system with admin panel.

## ✨ Features

### 🔐 Authentication & Authorization
- User registration and login
- Password reset functionality
- Email verification system
- Admin role management with middleware protection

### 📊 Membership Plan Management
- **Full CRUD Operations**
  - Create, view, edit, delete membership plans
  - Plan status toggle (active/inactive)
  - Soft delete with trash management
  - Restore deleted plans
- **Advanced Features**
  - JSON-based features storage
  - Price management with validation
  - Responsive admin interface

### 🎨 Frontend
- Modern UI with Tailwind CSS
- Responsive design
- Clean admin dashboard
- Mobile-friendly layout

## 🖥️ Backend

### Technology Stack
- **Framework**: Laravel 11
- **Database**: SQLite (configurable)
- **Authentication**: Laravel Breeze
- **Validation**: Form Request Validation
- **Testing**: PHPUnit

### Key Components
- **Models**: User, MembershipPlan
- **Controllers**: MembershipPlanController (Admin)
- **Middleware**: IsAdmin (Role-based access)
- **Migrations**: Users, Membership Plans tables
- **Seeders**: Admin user creation

## 🗄️ Database

### Users Table
- `id` (Primary Key)
- `name` (String)
- `email` (Unique String)
- `password` (Hashed String)
- `is_admin` (Boolean)
- `email_verified_at` (Timestamp)
- `remember_token` (String)
- `created_at`, `updated_at` (Timestamps)

### Membership Plans Table
- `id` (Primary Key)
- `name` (String)
- `price` (Float)
- `features` (JSON)
- `status` (Enum: active/inactive)
- `created_at`, `updated_at` (Timestamps)
- `deleted_at` (Soft Delete Timestamp)

## 👤 Admin Access

**Default Admin Credentials:**
- **Email**: admin@example.com
- **Password**: password

## 🚀 Quick Setup

1. Clone repository
2. Run `composer install && npm install`
3. Copy `.env.example` to `.env`
4. Run `php artisan key:generate`
5. Run `php artisan migrate && php artisan db:seed`
6. Run `npm run build`
7. Start with `php artisan serve`

## 🛣️ Main Routes

- `/admin/plans` - List all plans
- `/admin/plans/create` - Create new plan
- `/admin/plans/{id}/edit` - Edit plan
- `/admin/plans/trash` - View deleted plans

---

**Built with Laravel** 