<?php

use App\Router;
use Controllers\HomeController;

// for default routes like 404 and 419 ....
Router::defaults();

Router::get('/', [HomeController::class, 'index']);
Router::post('/', [HomeController::class, 'create']);
Router::get('/test', [HomeController::class, 'test']);



//Read the route from the browser and then exec its function
Router::read();