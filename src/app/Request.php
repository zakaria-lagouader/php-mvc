<?php

namespace App;

class Request {

    private $data = [];

    public function __construct($data) {
        $this->data = $data;
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

    public function toArray()
    {
        return $this->data;
    }
    public function validate($roules = [])
    {
        $errors = [];
        foreach ($roules as $key => $val) {
            if (array_key_exists($key, $this->data)) {
                foreach (explode("|",$val) as $roule) {
                    if ($roule == 'required') {
                        if (empty($this->data[$key])) {
                            $errors[$key][] = "$key is required";
                        }
                        // need to create a String class
                    }if (substr_compare($roule, "max:", 0, strlen("max:")) === 0) {
                        $num = (int)explode('max:', $roule)[1];
                        if (strlen($this->data[$key]) > $num) {
                            $errors[$key][] = "$key lenght is more than $num chars";
                        }
                    }if (substr_compare($roule, "min:", 0, strlen("min:")) === 0) {
                        $num = (int)explode('min:', $roule)[1];
                        if (strlen($this->data[$key]) < $num) {
                            $errors[$key][] = "$key lenght is less than $num chars";
                        }
                    }
                }
            }
        }
        if (count($errors) > 0) {
            var_dump($errors);
            die();
        }
    }
}