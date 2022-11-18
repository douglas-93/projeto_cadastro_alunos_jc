<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./estilos/index.css">
</head>
<body class="mt container container-c login-bg" style="height: 100vh;">
    <form action="./valida_cadastro.php" method="post" class="mt container container-c form-box">
        <label class="mt label" for="nome">Nome Completo</label>
        <input class="mt input" type="text" name="nome" id="nome" value="<?php
        if(isset($_SESSION['nome'])) {
            echo $_SESSION['nome'];
            unset($_SESSION['nome']);
        }
        ?>">
        <?php
        if (isset($_SESSION['nome_err'])) {
            echo "<div class=\"mt error\">" . $_SESSION['nome_err'] . "</div>";
            unset($_SESSION['nome_err']);
        }
        ?>
        <label class="mt label" for="usuario">Usuário</label>
        <input class="mt input" type="text" name="usuario" id="usuario" value="<?php
        if(isset($_SESSION['usuario'])) {
            echo $_SESSION['usuario'];
            unset($_SESSION['usuario']);
        }
        ?>">
        <?php
        if (isset($_SESSION['usuario_err'])) {
            echo "<div class=\"mt error\">" . $_SESSION['usuario_err'] . "</div>";
            unset($_SESSION['usuario_err']);
        }
        if (isset($_SESSION['user_exists'])) {
            echo "<div class=\"mt error\">" . $_SESSION['user_exists'] . "</div>";
            unset($_SESSION['user_exists']);
        }
        ?>
        <label class="mt label" for="senha">Senha</label>
        <input class="mt input" type="password" name="senha" id="senha">
        <?php
        if (isset($_SESSION['senha_err'])) {
            echo "<div class=\"mt error\">" . $_SESSION['senha_err'] . "</div>";
            unset($_SESSION['senha_err']);
        }
        ?>
        <label class="mt label" for="confirma_senha">Confirma Senha</label>
        <input class="mt input" type="password" name="confirma_senha" id="confirma_senha">
        <?php
        if (isset($_SESSION['confirma_senha_err'])) {
            echo "<div class=\"mt error\">" . $_SESSION['confirma_senha_err'] . "</div>";
            unset($_SESSION['confirma_senha_err']);
        }
        
        if (isset($_SESSION['pass_mismatch'])) {
            echo "<div class=\"mt error\">" . $_SESSION['pass_mismatch'] . "</div>";
            unset($_SESSION['pass_mismatch']);
        }
        
        ?>
        <div class="mt-1">
            <button type="submit" class="btn btn-log">Cadastrar</button>
            <a href="./index.php" class="btn btn-log">Voltar</a>
        </div>
    </form>
</body>
</html>