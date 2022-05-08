<?php

session_start();


if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados

$querySelect = "SELECT * FROM usuarios";
$listar = $conn->prepare($querySelect);
$listar->execute();

if($listar->rowCount()){
    $resposta = $listar->fetchAll(PDO::FETCH_ASSOC);
}else{
    $resposta = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
};

echo  json_encode($resposta);

