<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=yii2basic',
    'username' => 'root',
    'password' => 'secret',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            '__class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ],
];
