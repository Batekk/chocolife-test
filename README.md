# Chocolife TT

Накатываем проект

В папке проекта компилируем:
```
composer dump-autoload
```

Подключаем БД по пути:
```
configs/database.php
```

Запускаем проект:
```
composer serve
```
Если порт занят, изменить в  `composer.json`

REST\
`http://localhost:8801/random` - Рандомная запись [GET]\
`http://localhost:8801/list` - Все записи [GET]\
`http://localhost:8801/links` - Все записи с сылкой и названием [GET]\
`http://localhost:8801/sale/{id}` - Выбор скидки по ключу записи [GET]\
`http://localhost:8801/sale` - Удалить [DELETE]
