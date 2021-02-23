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
    nullable orderBy - possible values: downloads, random, latest
}
```

```
Response 
list [ Wallpaper ]
```

Добавить изображение ``` POST /wallpapers ```
```
Request
{
    required                category_id,
    required                device - possible values: 0(phone), 1(tablet),
    nullable,string,max:255 caption_ru
    nullable,string,max:255 caption_en
    required                image
    required                video
}
```
```
Response
Wallpaper
```

Изображение ``` GET /wallpapers/id ```

```
Response 
Wallpaper
```

Скачать изображение ``` GET /wallpapers/download/id ```



Поиск изображений ``` GET /search/wallpapers ```
```
Request 
{
    required|string q
}
```

```
Response 
list [ Wallpaper ]
```

## Wallpaper
```
{
    int 'id',
    array 'category'  => [
        int 'id',
        string 'ru',
        string 'en',
    ],
   string 'date',
   string 'device',
   int 'downloads',
   array image => [
      int 'size',
      string 'fullPath',
      string 'url'
   ],
   ?array video => [
      int 'size',
      string 'fullPath',
      string 'url'
   ],

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

