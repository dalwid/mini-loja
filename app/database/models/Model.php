<?php

namespace app\database\models;

use app\database\Transaction;
use PDO;
use PDOException;

abstract class Model
{
    protected static string $table;
    protected array $attributes = [];

    public function __set(string $property, string $value)
    {
        $this->attributes[$property] = $value;
    }

    public function __get(string $property)
    {
        return $this->attributes[$property];
    }

    public static function all(string $fields = '*')
    {
        try {
            Transaction::open();

            $conn = Transaction::getConnection();
            $tableName = static::$table;

            $query = $conn->prepare("select {$fields} from {$tableName}");
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, static::class);

            Transaction::close();
            
        } catch (PDOException $e) {
            Transaction::rollback();
        }
        
    }

    public static function where(string $field, string $value, string $fields = '*')
    {
        try {
            Transaction::open();

            $conn = Transaction::getConnection();
            $tableName = static::$table;

            $query = $conn->prepare("select {$fields} from {$tableName} where {$field} = :{$field}");
            $query->execute([$field => $value]);

            return $query->fetchObject(static::class);

            Transaction::close();
            
        } catch (PDOException $e) {
            Transaction::rollback();
        }
    }
}