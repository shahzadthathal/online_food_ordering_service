git clone https://github.com/shahzadthathal/online_food_ordering_service.git

```
cd online_food_ordering_service

composer install

php artisan migrate

php artisan db:seed

php artisan serve

```

Admin Panel:
```
http://127.0.0.1:8000/
Email: admin@example.com
Pass: password
```

API's:
```
http://127.0.0.1:8000/api/menu
http://127.0.0.1:8000/api/menu/item
http://127.0.0.1:8000/api/menu/item/category
```