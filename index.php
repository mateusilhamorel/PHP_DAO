<?php

require_once("config.php");

//Traz apenas um usuario
//usuario = new Usuario();
//usuario->loadById(2);
//echo $usuario;

//Carrega lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login.
//$search = Usuario::search("ka");
//echo json_encode($search);

//Carrega usuario usando login e senha
$usuario = new Usuario();
$usuario->login("jose", "dendritos");
echo $usuario;

?>