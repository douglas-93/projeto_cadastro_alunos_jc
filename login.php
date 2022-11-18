<?php

session_start();
include_once './conexaoDB.php';

$valid = true;

foreach (['usuario', 'senha'] as $field) {
    if (empty($_POST[$field])) {
        $_SESSION["${field}_err"] = "Favor informar o campo " . ucwords($field) . "!";
        $valid = false;
    } else {
        $_SESSION[$field] = $_POST[$field];
    }
}

if (!$valid) {
    header('Location: http://localhost/cadastro/index.php');
    die();
}

$connection = new ConexaoDB();

$user = $connection->get_user($_POST['usuario']);
$user_pass = $_POST['senha'];

if ($user == null) {
    $_SESSION['new_user'] = 'Usuário não encontrado, vamos realizar um <a class="link" href="./cadastro.php">cadastro</a>?';
    header('Location: http://localhost/cadastro/index.php');
    die();
} else {
    if (!password_verify($user_pass, $user['pass'])) {
        $_SESSION['invalid_pass'] = 'Usuário ou senha inválidos!';
        header('Location: http://localhost/cadastro/index.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <link rel="stylesheet" href="./estilos/index.css">
</head>

<body class="login-bg">
    <div class="container container-c" style="height: 100vh;">
        <div class="success">
            <?="Bem vindo " . $user['name']; ?>
        </div>
        <form action="./sair.php" method="post">
            <button type="submit" class="btn btn-log">Sair</button>
        </form>
    </div>
</body>

</html>