<?php

class Usuario {
 
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    
    public function getIdusuario(){
        return $this->idusuario;
    }
    
    public function getDeslogin(){
        return $this->deslogin;
    }
    
    public function getDessenha(){
        return $this->dessenha;
    }
    
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    
    public function setIdusuario($value){
        $this->idusuario = $value;
    }
    
    public function setDeslogin($lg){
        $this->deslogin = $lg;
    }
    
    public function setDessenha($pass){
        $this->dessenha = $pass;
    }
    
    public function setDtcadastro($dt){
        $this->dtcadastro = $dt;
    }
    
    
    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios where idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        if(count($results) > 0){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setdeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
    }
    
    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }
    
    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        ':SEARCH'=>"%".$login."%"
        ));
    }
    
    public function login($login, $pass){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$pass
        ));
        
        if(count($results) > 0){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setdeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        } else {
            throw new Exception("Login e/ou senha invalidos.");   
        }
    }
    
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }                            
                                 
    
}


?>