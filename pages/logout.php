<?php

require '../config.php';

use App\Classes\Login;

$login = new Login;
$login->logout();

header('Location:/');