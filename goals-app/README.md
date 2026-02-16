# Goals Tracker Application

A Laravel-based goal tracking application with role-based access control using Spatie Laravel Permission.

## Features

- **Goal Management**: Create, read, update, and delete goals
- **Category System**: Organize goals by categories
- **Role-Based Access Control**: Admin and Author roles with granular permissions
- **Responsive UI**: Built with Alpine.js and Tailwind CSS
- **Real-time Filtering**: Filter goals by category, status, and search terms

## Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Alpine.js, Tailwind CSS, Preline UI
- **Authentication**: Laravel UI
- **Authorization**: Spatie Laravel Permission
- **Icons**: Lucide Icons
- **Database**: MySQL/MariaDB

## Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd goals-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Update `.env` with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=goals_app
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## Role-Based Permission System

This application uses **Spatie Laravel Permission** for authorization. The package provides flexible role and permission management.

### Roles

| Role   | Description                                    |
|--------|------------------------------------------------|
| Admin  | Full access to edit and delete all goals       |
| Author | Can create, edit, and delete all goals         |

### Permissions

| Permission     | Description                      | Admin | Author |
|----------------|----------------------------------|-------|--------|
| access-admin   | Access the admin dashboard       | ✓     | ✓      |
| create-goal    | Create new goals                 | ✗     | ✓      |
| edit-goal      | Edit existing goals              | ✓     | ✓      |
| delete-goal    | Delete goals                     | ✓     | ✓      |

### Default User Accounts

After running the seeders, you can log in with:

**Admin Account**
- Email: `admin@test.com`
- Password: `password`

**Author Account**
- Email: `author@test.com`
- Password: `password`

## Usage

### Checking Permissions in Code

**In Controllers:**
```php
// Check permission
$this->authorize('edit-goal');

// Check role
if ($user->hasRole('admin')) {
    // Admin-specific logic
}

// Check permission
if ($user->can('create-goal')) {
    // Create goal logic
}
```

**In Blade Templates:**
```blade
@can('create-goal')
    <button>Create Goal</button>
@endcan

@role('admin')
    <p>You are an admin!</p>
@endrole

@hasanyrole('admin|author')
    <p>You have access!</p>
@endhasanyrole
```

**In Routes:**
```php
Route::middleware(['auth', 'permission:access-admin'])->group(function () {
    // Protected routes
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin-only routes
});
```

### Assigning Roles to Users

```php
$user = User::find(1);

// Assign role
$user->assignRole('author');

// Remove role
$user->removeRole('author');

// Sync roles (replaces all roles)
$user->syncRoles(['admin', 'author']);

// Give permission directly
$user->givePermissionTo('edit-goal');
```

### Creating New Roles and Permissions

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Create a permission
Permission::create(['name' => 'publish-goal']);

// Create a role
$role = Role::create(['name' => 'moderator']);

// Give permission to role
$role->givePermissionTo('publish-goal');

// Assign role to user
$user->assignRole('moderator');
```

## Project Structure

```
goals-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php    # Admin dashboard & CRUD
│   │       └── GoalController.php     # Public goal views
│   ├── Models/
│   │   ├── User.php                   # User model with HasRoles trait
│   │   ├── Goal.php                   # Goal model
│   │   └── Category.php               # Category model
│   ├── Services/
│   │   ├── GoalService.php            # Goal business logic
│   │   └── CategoryService.php        # Category business logic
│   └── Providers/
│       └── AppServiceProvider.php     # Service provider (no Gates needed)
├── database/
│   ├── migrations/
│   │   └── create_permission_tables.php    # Spatie's permission tables
│   └── seeders/
│       ├── RoleAndPermissionSeeder.php     # Roles & permissions
│       ├── UserSeeder.php                  # Default users
│       ├── CategorySeeder.php              # Sample categories
│       └── GoalSeeder.php                  # Sample goals
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── baseComponent.js       # Base Alpine component
│   │   │   └── goalManager.js         # Goal management component
│   │   └── app.js                     # Main JS entry point
│   └── views/
│       ├── admin/
│       │   └── index.blade.php        # Admin dashboard
│       └── components/
│           ├── admin/                 # Admin UI components
│           ├── public/                # Public UI components
│           └── ui/                    # Shared UI components
└── routes/
    └── web.php                        # Application routes
```

## Development

### Running Tests

```bash
php artisan test
```

###  Building for Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Clearing Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear Spatie permission cache
php artisan permission:cache-reset
```

## Spatie Permission Documentation

For more information on using Spatie Laravel Permission, visit:
- [Official Documentation](https://spatie.be/docs/laravel-permission)
- [GitHub Repository](https://github.com/spatie/laravel-permission)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
