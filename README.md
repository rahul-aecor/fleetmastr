## 1.Execute the following command.
$ docker-compose build

$ docker-compose up -d

$ docker-compose exec app composer create-project --prefer-dist laravel/laravel .

$ docker-compose exec app php artisan key:generate

$ docker-compose exec app php artisan storage:link

$ docker-compose exec app chmod -R 777 storage bootstrap/cache

$ docker-compose exec app php artisan migrate
