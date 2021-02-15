# Wallpaper

## Требования
- [PHP >= 7.4](http://php.net/)
- [MySQL = 5.7](https://www.mysql.com/)


## API


Заголовки: 
```
Content-Type:application/json
X-Requested-With:XMLHttpRequest
```
Каждый запрос может принимать GET параметр ``` page={int} ``` для управления пагинацией страниц  

Список Категорий ``` GET /categories ```
```
Response
list [ Category ]
```

Категория ``` GET /categories/{id} ```
```
Response
Category
```

Список изображений ``` GET /wallpapers ```
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

Изображение ``` GET /wallpapers/id ```

```
Response 
Wallpaper
```

Скачать изображение ``` GET /wallpapers/download/id ```

## Wallpaper
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

## Category
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

