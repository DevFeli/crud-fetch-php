<?php

function autenticar (){

    $user = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = new PDO("mysql:dbname=sistema;host=localhost", "root", "root");

    $stmt = $conn->prepare("SELECT * FROM adm where email = :EMAIL AND senha = :SENHA");
    $stmt->bindParam(":EMAIL", $user);
    $stmt->bindParam(":SENHA", $senha);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($results)){
        foreach($results as $result){
            if(($user === $result['email']) && ($senha === $result['senha'])){
                
                session_start();
                $_SESSION['nome'] = $result['nome'];
                $id = session_id();
                $_SESSION['id'] = $id;
                
                header("location: /crud/view/painel.php");

            }else{
                echo "Usuário não encontrados";
            }
        } 
    }else{
        header("location: /crud/index.php?msg=0");
    }

};

autenticar();

?>