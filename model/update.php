<?php

session_start();



if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
};

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);//recebe os dados da fetch api




$conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");//conecta com o banco de dados

update();

function update(){

    global $conn, $dados;
    $queryUp = "UPDATE usuarios SET nome = :NOME, email = :EMAIL, tel = :TEL WHERE id = :ID";
    $cadUser = $conn->prepare($queryUp);
    $cadUser->bindParam(":ID", $dados['id']);
    $cadUser->bindParam(":NOME", $dados['nome']);
    $cadUser->bindParam(":EMAIL", $dados['email']);
    $cadUser->bindParam(":TEL", $dados['tel']);
    $cadUser->execute();

    if($cadUser->rowCount()){
        $resposta = ['erro' => false, 'msg' => "Usuário Alterado com sucesso!"];
    }else{
        $resposta = ['erro' => true, 'msg' => "Erro: Usuário não Alterado!"];
    };

    echo json_encode($resposta);
};



?>