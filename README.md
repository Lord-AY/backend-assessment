## Installation
Run the following commands
php artisan migrate --seed
php artisan cache:clear
php artisan config:clear

## Routes
/api/users -> Get all Users (GET)
/api/users/{id} -> Get User details (GET)
/api/login -> Login in user (POST - all seeded user password is password)
/api/wallets -> Get all wallets (GET)
/api/wallets/{id} -> Get wallet details (GET)
/api/transfer -> Transfer (POST - protected by auth)
/api/info -> Get info (GET)
