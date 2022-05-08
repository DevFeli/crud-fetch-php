<?php

session_start();



if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

 //$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

$dados = $_GET['id'];

$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados


function pesquisar(){
    global $conn, $dados;
    $querySelect = "SELECT * FROM usuarios WHERE (id = :ID) LIMIT 1"; 
                    
    $cadPes = $conn->prepare($querySelect);
    $cadPes->bindParam(":ID",$dados);
    $cadPes->execute();

    if($cadPes->rowCount()){
        $user = $cadPes->fetch(PDO::FETCH_ASSOC);
        $resposta = [$user];
    }else{
        $user = ['msg' => "Erro: Usuário não encontrado!"];
    };

    echo json_encode($user);
    
};

// echo json_encode($dados);

pesquisar();