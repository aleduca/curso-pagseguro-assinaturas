<?php

require '../../config.php';

use App\Classes\Environment\Environment;
use App\Classes\Environment\EnvironmentPagseguro;
use App\Classes\Pagseguro;
use App\Models\Assinantes;

$environment = new Environment(new EnvironmentPagseguro);
$codigo = filter_input(INPUT_POST,'id_assinatura',FILTER_SANITIZE_STRING);
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/cancel/{$codigo}?email=".$environment->getEmail()."&token=".$environment->getToken();

$retorno = simplexml_load_string((new Pagseguro)->cancelar($url));

if(isset($retorno->error)){
    echo json_encode([
        'error' => true,
        'errors' => $retorno->error
    ]);
}else{
    $assinantes = new Assinantes;
    $atualizado = $assinantes->atualizarAssinatura(3,$codigo);

    if($atualizado){
        echo json_encode([
            'error' => false,
            'status' => $retorno->status
        ]);
    }else{
        echo json_encode([
            'error' => true,
            'errors' => 'erro'
        ]);
    }
}