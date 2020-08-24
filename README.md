## Счетчик посещения для стран

* Запуск:

`docker-compose up --build`

Сайт доступен по http://localhost

* Методы:

```
[POST] /counter/
Request: {
    "country_code": "ru"
}
Response: 201 Created, empty
422 Unprocessable entity, {
    "country_code":[
        "Invalid ISO3166-A2 country code."
    ]
}
```
```
[GET] /counter
Response: 200 OK, 
[{"code":"ru","count":18},{"code":"us","count":2}]
```

* Тесты:
vendor/bin/phpunit

Используется мини фреймворк Lumen.
Для подсчета используется метод Redis hIncrBy

Были мысли использовать для увеличения RPS ассинхронную модель с очередями.

Но по идее текущая простая схема должна удовлетворять при правильной настройке fpm nginx redis условиям задачи.

Еще более простая и быстрая реализация была бы возможно при использовании в угоду скорости vanilla.php

Еще были мысли в сторону хранилища счетчика в inMemory с помощью инструмента swoole и использования mutex и корутин, с ассинхронной записью в Redis.

Еще есть вариант с помощью swoole использовать пул коннекторов к Redis

