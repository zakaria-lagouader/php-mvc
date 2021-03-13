<?php

namespace App;

use App\SqlBuilder;

class Model {

    private $data = [];
    protected static $table = "";

    public static function find($id){
        $result = SqlBuilder::selectBy(static::$table, 'id', $id);
        return static::create($result);
    }

    public static function all()
    {
        $result = SqlBuilder::all(static::$table);
        $models = [];
        foreach ($result as $data) {
            $models[] = static::create($data);
        }
        return $models;
    }

    public static function create($result)
    {
        $model = new static();
        $model->data = $result;
        return $model;
    }

    public function save(){
        if (array_key_exists('id', $this->data)) {
            return SqlBuilder::update(static::$table, $this->data);
        }else {
            return SqlBuilder::save(static::$table, $this->data);
        }
    }
    public function delete(){
        if (array_key_exists('id', $this->data)) {
            return SqlBuilder::delete(static::$table, $this->data['id']);
        }else {
            return false;
        }
    }

    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }
    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $key .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
}
