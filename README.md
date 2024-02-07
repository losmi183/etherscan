PHP: 8.0.30.
Laravel: 9.52.16
DB: MariaDB 10.4.21 (Or MySql 8)

----------------------------------------------------------
Instalation instruction
- After git clone create .env from .env.example
- composer install
- create new database

- php artisan migrate --seed  (for first time)
- php artisan migrate:fresh --seed (to migrate fresh)

- fetch transaction data from api.etherscan.io to database with command: php artisan etherscan:fetch

- php artisan serve 
- open browser on provided address - http://127.0.0.1:8000/

------------------------------------------------------------------------

