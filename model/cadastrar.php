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
    $queryCadastrar = "INSERT INTO usuarios (nome, email, tel) VALUES (:NOME, :EMAIL, :TEL)";
    $cadUser = $conn->prepare($queryCadastrar);
    $cadUser->bindParam(":NOME", $dados['nome']);
    $cadUser->bindParam(":EMAIL", $dados['email']);
    $cadUser->bindParam(":TEL", $dados['tel']);
    $cadUser->execute();

    if($cadUser->rowCount()){
        $resposta = ['erro' => false, 'msg' => "Usuário cadastrado com sucesso!"];
    }else{
        $resposta = ['erro' => true, 'msg' => "Erro: Usuário não cadastrado!"];
    };
    echo json_encode($resposta);
};



?>