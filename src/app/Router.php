<?php

namespace App;

class Router {
    private static $GET_routes = [];
    private static $POST_routes = [];

    public static function get($route, $callback){
        //Add route and its function in the routes array
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            self::$GET_routes[$route] = $callback;
        }
    }
    public static function post($route, $callback){
        //Add route ans its function in the routes array
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            self::$POST_routes[$route] = $callback;
        }
    }
    public static function read()
    {
        //Get the route from the url
        $route = $_SERVER['REQUEST_URI'];
        //Check if the route exisits
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (array_key_exists($route, self::$GET_routes)) {
                //run the route function if the route exisits
                call_user_func(self::$GET_routes[$route]) ;
            }else {
                header('Location: /404');
            }
        }else if($_SERVER['REQUEST_METHOD'] == "POST"){
            if (array_key_exists($route, self::$POST_routes)) {
                $request = new Request($_POST);
                //run the route function if the route exisits
                call_user_func(self::$POST_routes[$route],$request) ;
            }else {
                header('Location: /404');
            }
        }
    }
    public static function defaults(){
        self::get('/404', function(){
            echo '<h1>404 Page not found</h1>';
        });
    }
}