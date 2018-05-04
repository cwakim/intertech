Install:
- composer update
- composer install
- mv .env.example .env
- fix the db connection, google project id, and the google api code in the .env
- php artisan db:migrate
- php artisan db:seed
