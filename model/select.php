<?php

session_start();

if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);//recebe os dados da fetch api


$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados


function pesquisar(){
    global $conn, $dados;
    $querySelect = "SELECT * FROM usuarios WHERE (nome = :NOME) or (email = :EMAIL) LIMIT 1"; 
                    
    // or (email = :EMAIL)";
    $cadPes = $conn->prepare($querySelect);
    $cadPes->bindParam(":NOME",$dados['pesquisar']);
    $cadPes->bindParam(":EMAIL",$dados['pesquisar']);
    $cadPes->execute();

    if($cadPes->rowCount()){
        $user = $cadPes->fetch(PDO::FETCH_ASSOC);
        $resposta = ['erro' => false, 'dados' => $user];
    }else{
        $resposta = ['erro' => true, 'msg' => "Erro: Usuário não encontrado!"];
    };

    echo json_encode($resposta);
    
}

pesquisar();