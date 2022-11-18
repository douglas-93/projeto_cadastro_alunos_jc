<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./estilos/index.css">
</head>

<body>
    <div class="container container-c login-bg" style="height: 100vh;">
        <?php
        if (isset($_SESSION['new_user'])) {
            echo "<div class=\"error\">" . $_SESSION['new_user'] . "</div>";
            unset($_SESSION['new_user']);
        }
        if (isset($_SESSION['invalid_pass'])) {
            echo "<div class=\"error\">" . $_SESSION['invalid_pass'] . "</div>";
            unset($_SESSION['invalid_pass']);
        }
        ?>
        <form action="./login.php" method="post" class="container container-c form-box">
            <label class="label mt" for="usuario">Usuário</label>
            <input class="input mt" type="text" name="usuario" id="usuario" value="<?php
            if (isset($_SESSION['usuario'])) {
                echo $_SESSION['usuario'];
                unset($_SESSION['usuario']);
            }
            ?>">
            <?php
            if (isset($_SESSION['usuario_err'])) {
                echo "<div class=\"mt error\">" . $_SESSION['usuario_err'] . "</div>";
                unset($_SESSION['usuario_err']);
            }
            ?>
            <label class="label mt" for="senha">Senha</label>
            <input class="input mt" type="password" name="senha" id="senha">
            <?php
            if (isset($_SESSION['senha_err'])) {
                echo "<div class=\"mt error\">" . $_SESSION['senha_err'] . "</div>";
                unset($_SESSION['senha_err']);
            }
            ?>
            <button type="submit" class="btn btn-log mt-1">Entrar</button>
            <a href="./cadastro.php" class="mt link">Ainda não tem usuário? Clique aqui</a>
        </form>
    </div>
</body>

</html>