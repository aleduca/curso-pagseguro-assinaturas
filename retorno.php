<?php

require 'config.php';

use App\Classes\Environment\Environment;
use App\Classes\Environment\EnvironmentPagseguro;
use App\Classes\Pagseguro;

// if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){

// }

$environment = new Environment(new EnvironmentPagseguro);

// $notificationCode = $_POST['notificationCode'];
$notificationCode = '13523ED052255225E58AA4078F9550E18274';

$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/{$notificationCode}?email={$environment->getEmail()}&token={$environment->getToken()}";

$pagseguro = new Pagseguro();
$retorno = $pagseguro->retorno($url);

dump($retorno);