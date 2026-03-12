# Nothing
Laravel app where users can buy Nothing certificates/NFTs, start subscriptions, and donate to nothing general fund.

## Requirements
- PHP 8.2+
- Composer
- Node.js + npm
- SQLite

## Install
```bash
git clone https://github.com/Mate-ber/nothing.git
cd Nothing

composer install
npm install

cp .env.example .env
touch database/database.sqlite
```

Set `.env`:
```env
APP_URL=http://localhost
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

run:
```bash
php artisan key:generate
php artisan migrate --seed
```

## Run
```bash
php artisan serve
npm run dev
```

## Default Seeded Users
- Admin : `admin@nothing.test` / `password`
- Demo  : `demo@nothing.test` / `password`
