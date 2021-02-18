## Installation

Run the following commands<br />
php artisan migrate --seed<br />
php artisan cache:clear<br />
php artisan config:clear<br />

## Routes

/api/users -> Get all Users (GET)<br />
/api/users/{id} -> Get User details (GET)<br />
/api/login -> Login in user (POST - all seeded user password is password)<br />
/api/wallets -> Get all wallets (GET)<br />
/api/wallets/{id} -> Get wallet details (GET)<br />
/api/transfer -> Transfer (POST - protected by auth)<br />
/api/info -> Get info (GET)<br />
/api/states -> Store state in database from Excel sheet (POST - Excel file)<br />
/api/states -> Get state and LGA (GET)
