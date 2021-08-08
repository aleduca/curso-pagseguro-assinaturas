<?php

namespace App\Models;

use App\Models\Connection;

class Model{
    protected $connect;

    public function __construct(){
        $connect = new Connection;
        $this->connection = $connect->connect();
    }

    public function find($field,$value){
        $sql = "select * from {$this->table} where {$field} = ?";
        $list = $this->connection->prepare($sql);
        $list->bindValue(1,$value);
        $list->execute();
        return $list->fetch();
    }

    public function fetchAll(){
        $sql = "select * from {$this->table}";
        $fetch = $this->connection->prepare($sql);
        $fetch->execute();
        return $fetch->fetchAll();
    }

    public function delete($field,$value){
        $sql = "delete from {$this->table} where {$field} = ?";
        $delete = $this->connection->prepare($sql);
        $delete->bindValue(1,$value);
        $delete->execute();

        return $delete->rowCount() == 1 ? true : false;
    }

}