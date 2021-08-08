<?php

require '../../config.php';

use App\Classes\Environment\Environment;
use App\Classes\Environment\EnvironmentPagseguro;
use App\Classes\Pagseguro;
use App\Models\Assinantes;

$environment = new Environment(new EnvironmentPagseguro);
$codigo = filter_input(INPUT_POST,'id_assinatura',FILTER_SANITIZE_STRING);
$url = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/{$codigo}/status?email=".$environment->getEmail()."&token=".$environment->getToken();

$retorno = json_decode((new Pagseguro)->suspenderAtivarAssinatura($url, $_POST['status']));

if(isset($retorno->error)){
    echo json_encode($retorno);
}else{

    $status = ($_POST['status'] == 'SUSPENDED') ? 2 : 1;

    $assinantes = new Assinantes;
    $assinantes->atualizarAssinatura($status,$codigo);

    echo json_encode([
        'status' => 'ok'
    ]);

}
