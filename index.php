<?php
include('app/conexao/MySQL.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail:";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha:";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM conta WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // verifica se o usuário logado é o admin do sistema
            if ($usuario['email'] == "admin@admin" && $usuario['senha'] == "admin") {
                header("Location: admin.php");
            } else {
                header("Location: tela_principal.php");
            }
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gurjão Fit Login/Cadastro</title>
    <link rel="stylesheet" href="app/css/cadastro_login.css">
    <script src="https://kit.fontawesome.com/125197b41b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="app/img/logo.ico.ico">
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-1">Que bom te ver de novo!</h2>
                <p class="description description-1">Entre com sua conta</p>
                <button id="signin" class="btn btn-1">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-2">Crie uma conta</h2>
                <p class="description description-2">Preencha com seus dados pessoais:</p>

                <!-- <form class="form" action="./montar_perfil.html" method="get"> -->
                <form class="form" action="app/controller/ContaController.php" method="POST">
                    <label class="label-input">
                        <i class="fa-regular fa-user icon-modify" style="color: #ff6b00;"></i>
                        <input type="text" name="nome" value="" autofocus require placeholder="Nome" />
                    </label>

                    <label class="label-input">
                        <i class="fa-regular fa-user icon-modify" style="color: #ff6b00;"></i>
                        <input type="text" name="sobrenome" value="" require placeholder="Sobrenome" />
                    </label>

                    <label class="label-input">
                        <i class="fa fa-phone icon-modify" style="color: #ff6b00;"></i>
                        <input type="number" name="telefone" value="" require placeholder="Telefone" />
                    </label>

                    <label class="label-input">
                        <i class="fa fa-envelope icon-modify" style="color: #ff6b00;"></i>
                        <input type="email" name="email" value="" require placeholder="Email" />
                    </label>

                    <label class="label-input">
                        <i class="fa-solid fa-lock fa-sm icon-modify" style="color: #ff6b00;"></i>
                        <input type="password" name="senha" value="" require placeholder="Senha" />
                    </label>

                    <button class="btn btn-2" type="submit" name="cadastrar">Cadastrar</button>
                </form>
            </div><!-- Fim da segunda coluna -->
        </div><!-- Fim do primeiro conteúdo -->

        <div class="content second-content">
            <div class="first-column">
                <!-- Cadastro -->
                <h2 class="title title-1">Não tem uma conta?</h2>
                <p class="description description-1">Faça seu cadastro agora!</p>
                <button id="signup" class="btn btn-1">Cadastrar</button>
            </div>
            <div class="second-column">
                <!-- Login -->
                <h2 class="title title-2">Login</h2>
                <p class="description description-2">Insira seus dados de login:</p>
                <form class="form" action="" method="POST">
                    <label class="label-input">
                        <i class="far fa-envelope icon-modify" style="color: #ff6b00;"></i>
                        <input type="email" placeholder="Email" name="email">
                    </label>
                    <label class="label-input">
                        <i class="fa-solid fa-lock fa-sm icon-modify" style="color: #ff6b00;"></i>
                        <input type="password" placeholder="Senha" name="senha">
                    </label>
                    <button class="btn btn-2">Entrar</button>
                </form>
            </div><!-- Fim da segunda coluna -->
        </div><!-- Fim do segundo conteúdo -->

    </div><!-- Fim da container -->

    <script src="app/js/cadastro_login.js"></script>
</body>

</html>