# Тестовое задание 🐳

С описанием задания можно ознакомиться [тут](https://github.com/khikmatov/docker-laravel/blob/main/Migrate_data.docx).

Файл [random.csv](https://github.com/khikmatov/docker-laravel/blob/main/backend/random.csv)

Перед запуском импорта необходимо выполнить установку проекта. Как это сделить описано в [README.md](https://github.com/khikmatov/docker-laravel/blob/main/README.md)

Запустить импорт можно выполив команду:
```bash
$ docker-compose exec app php artisan customer:import ./random.csv
```

Просмотреть все записи можно через tinker:
```bash
$ docker-compose exec app php artisan tinker
```
В появившемся терминале ввести:
```php
App\Models\Customer::all();
```
