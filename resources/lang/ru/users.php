<?php

return [
    'index' => [
        'title' => 'Пользователи'
    ],

    'create' => [
        'title'                 => 'Добавление пользователя',
        'email'                 => 'E-Mail адрес',
        'password'              => 'Пароль',
        'password_confirmation' => 'Подтверждение пароля'
    ],

    'edit' => [
        'title' => 'Редактирование пользователя'
    ],


    'delete' => [
        'error' => 'Нельзя удалить самого себя'
    ],

    'table' => [
        'id'      => 'ID',
        'name'    => 'Имя',
        'email'   => 'Email',
        'action'  => 'Действие',
        'delete'  => 'Подтвердите удаление пользователя ":name"',
        'deleted' => 'Пользователь ":name" успешно удалён',
        ]
    ];
