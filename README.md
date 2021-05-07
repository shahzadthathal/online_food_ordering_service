1. Setup
```
git clone https://github.com/shahzadthathal/online_food_ordering_service.git

cd online_food_ordering_service

composer install

Update database credentials in .env file

php artisan migrate

php artisan db:seed

php artisan serve

```
2. Admin Panel

```
http://127.0.0.1:8000/
Email: admin@example.com
Pass: password
```

3. API's

Postman.json file is attached in doc folder.

```
http://127.0.0.1:8000/api/menu
http://127.0.0.1:8000/api/menu/item
http://127.0.0.1:8000/api/menu/item/category
```

4. Run Tests

Open a new terminal and run this command to check if web and api's endpoints are working.

```
php artisan test
```