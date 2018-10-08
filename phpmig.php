<?php

use \Phpmig\Adapter;

$container = new \Pimple\Container();

$dbConfig = require 'application/database.php';

$container['db'] = function () use($dbConfig) {
    $dsn = sprintf("mysql:dbname=%s;host=%s", $dbConfig['database'], $dbConfig['hostname']);
    $dbh = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};

$container['phpmig.adapter'] = function ($c) {
    return new Adapter\PDO\Sql($c['db'], 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;