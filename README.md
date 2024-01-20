## Startup
- install dependencies: `composer install `
- create `.env` file: `cp .env.example .env`
- configure: `.env`
- generate key: `php artisan key:generate`
- migrate: `php artisan migrate`
- seed necessary data: `php artisan db:seed` (this will create the default user to authenticate with (for using all the api endpoints) and 50 record of books using factory)

user 
  -  username : user@demo.com
  -  password : password
