<?php

class DB
{

    protected static $db_server = 'mysql';
    protected static $pdo;

    public static function initDb()
    {
        try {
            $host = Config::get('database.' . self::$db_server . '.host');
            $db_name = Config::get('database.' . self::$db_server . '.db_name');
            $user = Config::get('database.' . self::$db_server . '.user');
            $pass = Config::get('database.' . self::$db_server . '.pass');
            $port = Config::get('database.' . self::$db_server . '.port');

            $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";

            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $pdoErr) {
            Response::abort('500', $pdoErr->getMessage());
        }
    }

    public static function getDb()
    {
        return self::$pdo;
    }
}

