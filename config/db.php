<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=postgresdb;dbname=yii2basic',
    'username' => 'yii2basic',
    'password' => 'secret',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            '__class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ],
];
