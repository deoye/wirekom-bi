<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'MANAJEMEN KEGIATAN',
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=right',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root123',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
    ),
);