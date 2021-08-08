<?php

namespace App\Classes;

class Pagseguro {
	
	public function assinar($url,$dadosAderirPlano){
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array(
		    'Accept:application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
		    'Content-Type:application/json'
		  ));
		curl_setopt($curl, CURLOPT_POST,1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dadosAderirPlano));
		$retorno_transaction = curl_exec($curl);
		curl_close($curl);
		return $retorno_transaction;	
	}

	public function criarPlano($url,$dadosCriarPlano){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array(
		    'Accept:application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
		    'Content-type:application/x-www-form-urlencoded'
		    ));
		curl_setopt($curl, CURLOPT_POST,1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dadosCriarPlano));
		$retorno_transaction = curl_exec($curl);
		curl_close($curl);
		return $retorno_transaction;
	}

    public function cancelar($url){
       $curl = curl_init($url);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       $retorno_transaction = curl_exec($curl);
       curl_close($curl);
       return $retorno_transaction; 
    }

    public function suspenderAtivarAssinatura($url,$status){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array(
            'Accept:application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Content-Type:application/json'
            ));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['status' => $status]));
        $retorno_transaction = curl_exec($curl);
        curl_close($curl);
        return $retorno_transaction;
    }

    public function retorno($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $transaction_curl = trim(curl_exec($curl));
        curl_close($curl);
        $transaction = simplexml_load_string($transaction_curl);
        return $transaction;
    }

}