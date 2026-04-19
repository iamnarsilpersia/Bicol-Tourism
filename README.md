# Bicol Tourism Management System

A Laravel-based web application for managing tourism in the Bicol region of the Philippines.

## Features

### Admin Features
- **Tourist Spots Management**: Add, edit, and delete tourist destinations in Bicol
- **Tour Packages**: Create tour packages with multiple tourist spots per day
- **Reservations**: View and manage all bookings
- **Tour Guides**: Manage tour guide profiles and availability
- **Hotels**: Add and manage hotel listings
- **Shops**: Manage shops and souvenir stores
- **Interactive Map**: View all locations on a map with nearby places finder
- **Appointments**: View and manage user appointments

### User Features
- **Browse Tourist Spots**: View all available destinations
- **Book Tour Packages**: Reserve tour packages per day
- **Book Tour Guides**: Hire professional tour guides
- **Appointments**: Schedule appointments for inquiries
- **Nearby Places**: Find hotels, shops, and souvenirs near a location
- **Interactive Map**: View tourist spots on a map

## Installation

1. Install Laravel dependencies:
```bash
composer install
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Configure your database in `.env`:
```
DB_DATABASE=bicol_tourism
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations:
```bash
php artisan migrate
```

6. Seed the database with initial data:
```bash
php artisan db:seed
```

7. Create storage link:
```bash
php artisan storage:link
```

8. Start the development server:
```bash
php artisan serve
```

## Default Login Credentials

### Admin Account
- Email: admin@bicoltourism.com
- Password: password

### User Account
- Email: user@bicoltourism.com
- Password: password

## Routes Overview

### Public Routes
- `/` - Welcome page
- `/login` - User login
- `/register` - User registration

### Admin Routes (requires admin role)
- `/admin/dashboard` - Admin dashboard
- `/admin/tourist-spots` - Manage tourist spots
- `/admin/tour-packages` - Manage tour packages
- `/admin/reservations` - View reservations
- `/admin/tour-guides` - Manage tour guides
- `/admin/hotels` - Manage hotels
- `/admin/shops` - Manage shops
- `/admin/map` - Interactive map

### User Routes (requires user role)
- `/user/dashboard` - User dashboard
- `/user/tourist-spots` - Browse tourist spots
- `/user/tour-packages` - Browse and book packages
- `/user/tour-guides` - Browse and book tour guides
- `/user/appointments` - Manage appointments
- `/user/nearby-places` - Find nearby establishments
- `/user/map` - View map

## Technology Stack

- Laravel 10+
- PHP 8.1+
- MySQL
- Tailwind CSS
- Leaflet.js (for maps)
- Laravel Sanctum (API authentication)

## Bicol Region Coordinates

The system is configured for the Bicol Region, Philippines:
- Center: 13.6217, 123.9248
- Provinces: Albay, Camarines Sur, Catanduanes, Masbate, Sorsogon

## License

MIT License
