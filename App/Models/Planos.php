<?php

namespace App\Models;

class Planos extends Model{
    
    protected $table = 'planos';
    
    public function create($plano, $code, $createdat, $valor){
        $sql = "insert into {$this->table}(plano_assinatura, code_assinatura, created_at, valor) values(?,?,?,?)";
		$insert = $this->connection->prepare($sql);
		$insert->bindValue(1, $plano);
		$insert->bindValue(2, $code);
		$insert->bindValue(3, $createdat);
		$insert->bindValue(4, $valor);
		return $insert->execute();
    }

}