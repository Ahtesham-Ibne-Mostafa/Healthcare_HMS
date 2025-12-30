<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

🚀 Quick Installation Method (Recommended)

1. Install Laravel Installer Globally
   bash
   composer global require laravel/installer
2. Create New Laravel Project
   bash
   laravel new healthcare-hms
3. Project Configuration Steps
   Follow these prompts:

Starter Kit Selection:

text
Which starter kit would you like to install? [None]:
[none ] None
[react ] React
[vue ] Vue
[livewire] Livewire

> livewire
> Authentication Provider:

text
Which authentication provider do you prefer? [Laravel's built-in authentication]:
[laravel] Laravel's built-in authentication
[workos ] WorkOS (Requires WorkOS account)
[none ] No authentication scaffolding

> laravel
> Laravel Volt (Optional):

text
Would you like to use Laravel Volt? (yes/no) [yes]:

> yes
> Testing Framework:

text
Which testing framework do you prefer? [Pest]:
[0] Pest
[1] PHPUnit

> 0
> Laravel Boost (AI Coding Assistant):

text
Do you want to install Laravel Boost to improve AI assisted coding? (yes/no) [yes]:

> yes
> Build Frontend Assets:

text
Would you like to run npm install and npm run build? (yes/no) [yes]:

> yes 4. Install Laravel Permission Package
> bash
> composer require spatie/laravel-permission
> php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
> php artisan migrate 5. Seed Database and Start Server
> bash
> php artisan db:seed
> php artisan serve
> 🔄 Alternative Installation Method

1. Create Laravel Project Directly
   bash
   composer create-project laravel/laravel healthcare-hms
   cd healthcare-hms
2. Environment Setup
   bash
   copy .env.example .env # Windows

# OR for Linux/Mac:

# cp .env.example .env

php artisan key:generate 3. Database Configuration
Edit .env file:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthcare_hms
DB_USERNAME=root
DB_PASSWORD= 4. Run Database Migrations
bash
php artisan migrate 5. Install Required Packages
bash
composer require laravel/fortify
composer require spatie/laravel-permission 6. Publish Configuration Files
bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" 7. Final Database Migration
bash
php artisan migrate
📝 Post-Installation Steps

1. Start Development Server
   bash
   php artisan serve
   Server will run at: http://localhost:8000

2. Verify Installation
   Visit http://localhost:8000 in your browser

You should see the Laravel welcome page

Register/Login functionality should work

3. Additional Configuration (Optional)
   bash

# Install frontend dependencies

npm install

# Build assets

npm run build

# Run tests

php artisan test

# Clear cache

php artisan optimize:clear
🗂️ Project Structure Highlights
text
healthcare-hms/
├── app/
│ ├── Http/
│ ├── Livewire/ # Livewire components
│ ├── Models/
│ └── Providers/
├── resources/
│ ├── views/
│ └── css/
├── database/
│ ├── migrations/
│ └── seeders/
└── config/
├── permission.php
└── fortify.php
🛠️ Troubleshooting
Common Issues & Solutions:
Composer Errors:

bash
composer clear-cache
composer install --no-scripts
Permission Issues:

bash
chmod -R 775 storage bootstrap/cache
Database Connection:

Ensure MySQL is running

Verify database credentials in .env

Create database manually if needed:

sql
CREATE DATABASE healthcare_hms;
Migration Errors:

bash
php artisan migrate:fresh
php artisan db:seed
