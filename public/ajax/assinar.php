<?php

require '../../config.php';

use App\Classes\Environment\Environment;
use App\Classes\Environment\EnvironmentPagseguro;
use App\Classes\Pagseguro;
use App\Classes\User;
use App\Models\Assinantes;

$reference = 'Ass1234567890';

$dadosAderirPlano = [
	'plan' => $_POST['plano'],
	'reference' => $reference,
	'sender' => [
		'name' => 'Nome-cliente',
		'email' => 'email-cliente',
		'ip' => '127.0.0.1',
		'hash' => $_POST['hash'],
		'phone' => [
			'areaCode' => '16',
			'number' => '992467199'
		],
		'address' => [
			"street"=>"Av. Brigadeira Faria Lima",
			"number"=>"1384",
			"complement"=>"3 andar",
			"district"=>"Jd. Paulistano",
			"city"=>"São Paulo",
			"state"=>"SP",
			"country"=>"BRA",
			"postalCode"=>"14811260"
		],
		'documents' => array([
			"type"=>"CPF",
			"value"=>"00852564988"
		])
	],
	"paymentMethod" => [
		'type' => 'CREDITCARD',
		'creditCard'=>[
			'token' => $_POST['token'],
			'holder' => [
				'name' => 'Alexandre Cardoso',
				'birthDate' => '11/01/1982',
				"documents" => array([
					"type"=>"CPF",
					"value"=>"79385204033"
				]),
				"billingAddress"=>[
				    "street"=>"Av. Brigadeiro Faria Lima",
				    "number"=>"1384",
				    "complement"=>"3 andar",
				    "district"=>"Jd. Paulistano",
				    "city"=>"São Paulo",
				    "state"=>"SP",
				    "country"=>"BRA",
				    "postalCode"=>"14811260"
				],
				"phone" => [
					"areaCode"=>"16",
				    "number"=>"981484937"
				]
			]
		]
	]
];

$environment = new Environment(new EnvironmentPagseguro);

$url = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals?email=".$environment->getEmail()."&token=".$environment->getToken();

$assinantes = new Assinantes;
$assinanteEncontrado = $assinantes->find('user',User::user()->id);

if(!$assinanteEncontrado){
        $retorno = json_decode((new Pagseguro)->assinar($url,$dadosAderirPlano));
}else{

    if($assinanteEncontrado->status == 1 || $assinanteEncontrado->status == 2){
        echo json_encode('jaassinado');
        die();
    }

    if($assinanteEncontrado->status == 3){
        $assinantes->delete('user',(User::user()->id));
        $retorno = json_decode((new Pagseguro)->assinar($url,$dadosAderirPlano));
    }

}

if(isset($retorno->error)){
    echo json_encode($retorno);
}else{
    $assinantes->create([
        1=>(User::user()->id),
		2=>$retorno->code,
		3=>1,
		4=>$reference,
		5=>$_POST['plano'],
		6=>date('Y-m-d H:i:s'),
		7=>date('Y-m-d H:i:s', strtotime('+1month'))
	]);
	echo json_encode('assinou');
}