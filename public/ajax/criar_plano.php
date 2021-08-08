<?php

require "../../config.php";

use App\Classes\Environment\{Environment,EnvironmentPagseguro};
use App\Classes\Pagseguro;
use App\Models\Planos;

$environment = new Environment(new EnvironmentPagseguro);

$url = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request?email={$environment->getEmail()}&token={$environment->getToken()}";

$nomePlano = 'Plano Prata';
$valor = "350.00";

$dadosCriarPlano = [
	'preApprovalName'=> $nomePlano,
	'preApprovalCharge'=> 'AUTO',
	'preApprovalPeriod'=>'MONTHLY',
	'preApprovalAmountPerPayment'=>'350.00',
	// 'preApprovalMembershipFee'=>'150.00',
	// 'preApprovalTrialPeriodDuration'=>'28',
	// 'preApprovalExpirationValue'=>'10',
	'preApprovalExpirationUnit'=>'MONTHS', 
	'maxUses'=> '100'
];

$retorno = json_decode((new Pagseguro)->criarPlano($url,$dadosCriarPlano));

if(isset($retorno->code)){
    $plano = new Planos;
    $planoCriado = $plano->create($nomePlano,$retorno->code,
        date('Y-m-d H:i:s', strtotime($retorno->date)), $valor
    );
    if($planoCriado){
        echo json_encode('criado');
    }else{
        echo json_encode('erroPlano');
    }
}else{
    echo json_encode('erroCode');
}