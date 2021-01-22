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
`http://localhost:8801/random` - Рандомная [GET]\
`http://localhost:8801/list` - Все скидоки [GET]\
`http://localhost:8801/links` - Все ссылки с названием [GET]\
`http://localhost:8801/sale/{id}` - Выбрать скидку по ID [GET]\
`http://localhost:8801/sale` - Удалить [DELETE]
