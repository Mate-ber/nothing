# Nothing
Sell Nothing certificates, NFTs and accept donations for Nothing.

## Setup
git clone <your-repo-url>

cd Nothing

cp .env.example .env

# Update APP_URL and DB settings
touch database/database.sqlite

composer install

php artisan key:generate

php artisan migrate --seed

php artisan serve
