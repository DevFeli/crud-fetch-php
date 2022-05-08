<?php

session_start();

if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);//recebe os dados da fetch api


$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados

cadastrar();

function cadastrar(){

    global $conn, $dados;
    $queryCadastrar = "INSERT INTO adm (nome, email, senha) VALUES (:NOME, :EMAIL, :SENHA)";
    $cadUser = $conn->prepare($queryCadastrar);
    $cadUser->bindParam(":NOME", $dados['nomeadmin']);
    $cadUser->bindParam(":EMAIL", $dados['emailadmin']);
    $cadUser->bindParam(":SENHA", $dados['senhaadmin']);
    $cadUser->execute();

    if($cadUser->rowCount()){
        $resposta = ['erro' => false, 'msg' => "Adm cadastrado com sucesso!"];
    }else{
        $resposta = ['erro' => true, 'msg' => "Erro: Adm não cadastrado!"];
    };
    echo json_encode($resposta);
};



?>