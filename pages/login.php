<?php

require '../config.php';

use App\Classes\Login;

$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

if((new Login)->logar($email,md5($password))){
	header('Location:/');
}else{
	// redirecionar para outra pagina
}