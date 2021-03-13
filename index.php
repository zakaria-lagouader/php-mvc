<?php

use Dotenv\Dotenv;

// load project files
require __DIR__ . '/vendor/autoload.php';

// load env variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// load routes
require __DIR__ . '/src/routes/web.php';











    
