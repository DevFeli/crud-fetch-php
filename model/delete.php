<?php

session_start();



if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

 //$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

$dados = $_GET['id'];

$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados


function delete(){
    global $conn, $dados;
    $querySelect = "DELETE FROM usuarios WHERE id = :ID"; 
                    
    $cadPes = $conn->prepare($querySelect);
    $cadPes->bindParam(":ID",$dados);
    $cadPes->execute();

    if($cadPes->rowCount()){
        $resposta = ['msg' => "Deletado com sucesso!"];
    }else{
        $resposta = ['msg' => "Erro: Usuário não deletado!"];
    };

    echo json_encode($resposta);
    
};

delete();