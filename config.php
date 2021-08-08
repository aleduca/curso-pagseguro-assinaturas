<?php

ini_set('display_errors',1);

session_start();

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/App/functions/functions.php';

use Dotenv\Dotenv;

$dotEnv = new Dotenv(__DIR__);
$dotEnv->load();