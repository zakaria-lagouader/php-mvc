<?php

namespace App;

use App\Connection;

class SqlBuilder {

    private static $pdo;
    
    public static function __constructStatic() {
        static::$pdo = Connection::get();
    }

    public static function all($table_name)
    {
        $sql = "SELECT * FROM $table_name" ;
        $stmt = static::$pdo->query($sql);
        return $stmt->fetchAll();
    }
    public static function selectBy($table_name, $col_name, $col_value)
    {
        $sql = "SELECT * FROM $table_name WHERE $col_name = ?";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute([$col_value]);
        return $stmt->fetch();
    }

    public static function save($table_name, $data)
    {
        $columns = array_map(function($key){ return "$key = ? ";}, array_keys($data));
        $sql = "INSERT INTO $table_name SET " . join(",", $columns);
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount() > 0;
    }
    public static function update($table_name, $data)
    {
        $id = $data['id'];
        unset($data['id']);
        $columns = array_map(function($key){ return "$key = ? ";}, array_keys($data));
        $sql = "UPDATE $table_name SET " . join(",", $columns) . "WHERE id = $id";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount() > 0;
    }

    public static function delete($table_name, $id)
    {
        $sql = "DELETE FROM $table_name WHERE id = ?";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}

SqlBuilder::__constructStatic();