<?php

require '../config.php';

use App\Classes\Logado;
use App\Classes\User;
use App\Models\Assinantes;

if(!Logado::logado()){
    return header('Location:/');
}

$assinantes = new Assinantes;
$assinanteEncontardo = $assinantes->find('user',(User::user())->id);

if(!$assinanteEncontardo || $assinanteEncontardo->status == 3){
    return header('Location:/');
}

if($assinanteEncontardo->status == 1 || $assinanteEncontardo->status == 2){

    $agora = new DateTime('now');
    $vencimento = new DateTime($assinanteEncontardo->vencimento);

    if($agora > $vencimento){
        return header('Location:/');
    }

    return header('Location:/pages/premio.php');
}