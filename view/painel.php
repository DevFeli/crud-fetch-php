<?php

session_start();

if((!isset($_SESSION['nome'])) && (!isset($_SESSION['id']))){
    header("location: /crud/index.php?msg=0");
}
// $id = $_GET['id'];

// if($id !== $_SESSION['id']){
//     header("location: /crud/index.php?msg=0");
// }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel administrativo</title>
    <link rel="stylesheet" href="../assets/main.css">
</head>
<body>
    <aside class="nav-left">
        <section class="nav-bar">
            <div class="wellcome">
                <img class="img-logon" src="../img/img-01.png" alt="" srcset="">
                <div class="nome">
                    <h4>Bem vindo, <?php echo $_SESSION['nome'];?> !</h4>
                </div> 
            </div>
            <div class="menu">
                <ul>
                    <li id="cad"><a href="">Cadastrar cliente</a></li>
                    <li class="i-search">
                        <form class="form-pes" action="" method="POST">
                        <input type="hidden" name="pesquisar">
                        <input class="sub" type="submit" value="Pesquisar">
                        <input class="subpes" type="text" name="pesquisar" placeholder="nome/e-mail">
                            
                        </form>
                    </li>
                    <li class="listar"><a href="">Listar todos</a></li>
                    <li class="cadadm"><a href="">Cadastrar Adiministrador</a></li>
                    <li class="sair"><a href="">Sair</a></li>
                </ul>
            </div>
        </section>
    </aside>

    <main class="container">
            <!-- cadastrar admin -->
            <section class="conteudo-admin">
            <form name="cadastraradmin" id="cad-admin" class="form-admin" action="">
                <label for="nome">Nome</label>
                <input type="hidden" name="cadastraradmin">
                <input class="nomeadmin" type="text" id="nomeadmin" name="nomeadmin" required value="">
                <label for="email">E-mail</label>
                <input class="emailadmin" type="text" id="emailadmin" name="emailadmin" required placeholder="email@email" value="">
                <label for="tel">Telefone</label>
                <input class="senhaadmin" type="password" id="senhaadmin" name="senhaadmin" required value="">
                <input class="btn-admin" type="submit" value="Cadastrar">
            </form>
            <span class="closeadmin">X</span>
            <span class="msgadmin"></span>
        </section>
        <!-- fim cadastrar admin -->
        <!-- cadastrar -->
        <section class="conteudo">
            <form name="cadastrar" id="cad-user" class="form-conteudo" action="">
                <label for="nome">Nome</label>
                <input type="hidden" name="cadastrar">
                <input class="nomeCad" type="text" id="nome" name="nome" required value="">
                <label for="email">E-mail</label>
                <input class="emailCad" type="text" id="email" name="email" required placeholder="email@email" value="">
                <label for="tel">Telefone</label>
                <input class="telCad" type="number" id="tel" name="tel" required placeholder="ex: 011012345678" value="">
                <input class="btn" type="submit" value="Cadastrar">
            </form>
            <span class="close">X</span>
            <span class="msg"></span>
        </section>
        <!-- fim cadastrar -->
        <!-- Pesquisar um -->
        <section class="pesquisa1 on">
            <table class="tabela1">
                <thead>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>TELEFONE</th>
                    <th class="closePes"> X </th>
                </thead>
                <tbody class="tbody">
                    <td class="id"></td>
                    <td class="nome1"></td>
                    <td class="email"></td>
                    <td class="tel"></td>
                </tbody>
            </table>
        </section>
        <!--fim Pesquisar um -->
        <!-- Pesquisar all -->
        <section class="listar-all">
            <table class="tabela-listar">
                <thead>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>TELEFONE</th>
                    <th class="closelistar" colspan="2"> X </th>
                </thead>
                <tbody class="tbody-listar">

                </tbody>
            </table>
        </section>

        <!-- modal atualizar -->

        <section class="atualizar-modal">
            <form class="form-atualizar" action="" method="">
                <input class="id-atualizar" type="hidden" name="id" value="">
                <label for="nome">Nome</label>
                <input class="nomeatualiza" type="text" name="nome" id="nome" value="" required>
                <label for="email">E-mail</label>
                <input class="emailatualiza" type="email" name="email" id="email" value="" required>
                <label for="tel">Telefone</label>
                <input class="telatualiza" type="number" name="tel" id="tel" value="" required>
                <input class="btn btn-atualizar" type="submit" name="atualizar" value="Atualizar">
                <h1 class="msgat"></h1>
            </form>
        </section>

    </main>

    <ul class="squares"></ul>

    <script src="../assets/main.js"></script>
    <script src="../controller/operations.js"></script>
</body>
</html>



