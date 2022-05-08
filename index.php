<?php
    if ((isset($_GET['msg'])) && ($_GET['msg'] === '0')) {
        $msg = "Usuário ou senha inválidos!";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Sistema de cadastro</title>
</head>

<body>
    <div class="container">
        <img class="img-logon" src="./img/img-01.png" alt="" srcset="">
        <form action="./controller/autentication.php" method="POST">
            <label for="email">Usuário</label>
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
            <input class="btn" type="submit" value="Logar">
        </form>
        <span class="f-msg"> <?php if(isset($msg)) {echo $msg;}?> </span>
    </div>

    <ul class="squares"></ul>

    <script src="./assets/main.js"></script>
</body>
</html>