<?php

namespace App\Models;

use App\Models\Model;

class Assinantes extends Model{
	
	protected $table = 'assinantes';

	public function create(Array $parameters){
		$sql = "insert into {$this->table}(user,code,status,reference,plano_id,created_at,vencimento) values(?,?,?,?,?,?,?)";
		$insert = $this->connection->prepare($sql);
		foreach($parameters as $key=>$value){
			$insert->bindValue($key,$value);
		}	
		return $insert->execute();
	}

    public function assinantes($id){
        $sql = "select *, assinantes.created_at as createdat from {$this->table} inner join planos on assinantes.plano_id = planos.code_assinatura where assinantes.user = ?";
        $list = $this->connection->prepare($sql);
        $list->bindValue(1,$id);
        $list->execute();
        return $list->fetch();
    }

    public function atualizarAssinatura($status,$code){
        $sql ="update {$this->table} set status = ? where code = ?";
        $update = $this->connection->prepare($sql);
        $update->bindValue(1,$status);
        $update->bindValue(2,$code);
        return $update->execute();
    }

}