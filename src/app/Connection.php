<?php

namespace App;

use PDO;

class Connection {
    private static $host;
    private static $db  ;
    private static $user;
    private static $pass;
    private static $charset = 'utf8mb4';

    public static function staticConstructor()
    {
        static::$host = $_ENV['DB_HOST'];
        static::$db   = $_ENV['DB_NAME'];
        static::$user = $_ENV['DB_USER'];
        static::$pass = $_ENV['DB_PASSWORD'];
        static::$charset = 'utf8mb4';
    }

    public static function get()
    {
        $dsn = "mysql:host=" . static::$host . ";dbname=" . static::$db . ";charset=" . static::$charset;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
             return new PDO($dsn, static::$user, static::$pass, $options);
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

Connection::staticConstructor();