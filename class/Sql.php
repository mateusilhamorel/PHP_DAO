<?php

/********************************************************************
* Define classe Sql e seus métodos.                                 *
* Esta classe deverá ser  usada para manipulação do banco de dados. *
********************************************************************/

class Sql extends PDO{
    
    
    //Define a variável que será usada para conexão.
    private $conn;
    
    
    
    //Define método construtor ("método mágico")
    public function __construct(){
        //A variável conn recebe a conexão estabelecida pelo objeto PDO.
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }
    
    
    //Define metodos par definir os parametros
    private function setParams($statment, $parameters = array()){
        foreach($parameters as $key => $value){
            $this->setParam($statment, $key, $value);
        }
    }
    
    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }
    
    public function query($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }
    
    public function select($rawQuery, $params = array()):array{
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>