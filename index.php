<?php
require_once ("config.php");
//aula 62
//  $sql = new Sql();
//  $user = $sql->select("SELECT * FROM tab_usuarios");
//  echo json_encode($user);

//aula 63
//busca um user
//    $root = new Usuario();
//    $root->loadById(1);
//    echo $root;

//aula 64
//não é necessario estanciar um usuario
//carrega uma lista
//  $lista = Usuario::getList();
//  echo json_encode($lista);

//carrega ums  lista buscando pelo login
//  $search = Usuario::search("MA");
//  echo json_encode($search);

//carrega um user utilizando o login e senha
    $user = new Usuario();
    $user->login("MARIA","1238");
    echo $user;
?>