# Wallpaper

## Требования
- [PHP >= 7.4](http://php.net/)
- [MySQL = 5.7](https://www.mysql.com/)


##API

Для работы всех описанных в данной документации запросов необходимо передавать header ```token``` с предоставленным значением.
Заголовки: 
```
Content-Type:application/json
X-Requested-With:XMLHttpRequest
```

Список Категорий GET /categories
```
Response
list [ Category ]
```

Категория GET /categories/{id}
```
Response
Category
```

Список изображений GET /wallpapers
```
Request 
{
    nullable category_id
}
```

```
Response 
list [ Wallpaper ]
```

Изображение GET /wallpapers/id  

```
Response 
Wallpaper
```

Скачать изображение GET /wallpapers/download/id

##Wallpaper
```
{
    int 'id',
    array 'category'  => [
        int 'id',
        string 'name_ru',
        string 'name_en',
    ],
   string 'date',
   string 'device',
   int 'downloads',
   int 'size',
   string 'fullPath',
   string 'url'
}
```

##Category
```
{
    int 'id',
    string 'emoji'
    int 'items'
    int 'rating'
    array 'name'  => [
        string 'en',
        string 'ru',
    ],
    array 'background'  => [
        string 'fullPath',
        string 'url',
    ],
}
```

## Разворачивание проекта

1. Клонировать репозиторий <code>git clone </code>
2. Перейти в папку с проектом <code>cd weather</code>
3. Создать файл <code>.env</code>, скопировав <code>.env.example</code> командой <code>cp .env.example .env</code> либо через интерфейс.
4. Настроить параметры внутри <code>.env</code> для создания Базы данных:
    - <code>DB_DATABASE=example</code>
    - <code>DB_USERNAME=example</code>
    - <code>DB_PASSWORD=example</code>
    - Установить параметр <code>DB_HOST=db</code>
    - Установить свободный порт <code>DB_PORT</code> - по умолчанию <code>DB_PORT=3306</code>
5. Установить <code>APP_URL=https:\/\/localhost:8000</code>
6. Собрать образ приложения командой <code>docker-compose build app</code>
7. Запустить среду командой <code>docker-compose up -d</code>
    >Проверить состояние служб можно с помощью команды <code>docker-compose ps</code>
7. Установить зависимости Composer <code>docker-compose exec app composer install</code>
8. Сгенерировать ключ приложения<code>docker-compose exec php artisan key:generate</code>
9. Выполнить миграции <code>docker-compose exec php artisan migrate</code>
10. Запустить seeds <code>docker-compose exec php artisan db:seed</code>
11. Опубликовать файлы <code>docker-compose exec php artisan storage:link</code>
12. Проект доступен по адресу <code>https:\/\/localhost:8000</code>

## Вход
Для доступа к системе при запуске seeds генерируется тестовый пользователь.
>Логин:  <code>user@weather.ru</code>
>Пароль: <code>password</code>

## Погода
1. Обновляется по указанным часам в настройках.
2. Обновляется командой <code>docker-compose exec php artisan weather:get</code>
