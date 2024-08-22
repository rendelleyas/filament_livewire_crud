## About

This is a test project made by Filament and Livewire

## Access
For admin access, login at
```
 localhost:8000/admin/login
```

For user access, login at
```
 localhost:8000/login
```


## Development Setup

- Once done cloning, setup your .env
- For the backend side
```
cp .env.example .env

composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

```

- For the frontend side
```
npm install
npm run dev

```
