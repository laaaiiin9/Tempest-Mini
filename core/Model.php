<?php

class Model
{
    protected static $table;
    protected static $query;
    protected static $bindings = [];

    protected static function db()
    {
        return DB::getDb();
    }

    public static function where($column, $value)
    {
        $instance = new static;

        $allowedColumns = static::$fillable ?? [];

        if (!in_array($column, $allowedColumns)) {
            throw new Exception("Invalid column name.");
        }

        $sql = "SELECT * FROM " . static::$table . " WHERE `$column` = :value";

        $instance::$query = static::db()->prepare($sql);
        $instance::$bindings = ['value' => $value];

        return $instance;
    }

    public static function all()
    {
        $sql = "SELECT * FROM " . static::$table;

        $query = static::db()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function first()
    {
        $this::$query->execute($this::$bindings);
        return $this::$query->fetch();
    }

    public function get()
    {
        $this::$query->execute($this::$bindings);
        return $this::$query->fetchAll();
    }
}
