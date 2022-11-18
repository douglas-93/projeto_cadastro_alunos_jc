<?php

session_start();

$fields = [
    'nome',
    'usuario',
    'senha',
    'confirma_senha'
];

$correct = true;

foreach ($fields as $field) {
    if (empty($_POST[$field])) {
        $_SESSION["${field}_err"] = "O campo " . ucwords(join(" ", explode("_", $field))) . " deve ser informado!";
        $correct = false;
    } else {
        $_SESSION[$field] = $_POST[$field];
    }
}
if (!$correct) {
    header('Location: http://localhost/cadastro/cadastro.php');
    die();
}

$name = $_POST['nome'];
$user = $_POST['usuario'];
$pass = $_POST['senha'];
$conf_pass = $_POST['confirma_senha'];

if ($pass == $conf_pass) {
    include_once './conexaoDB.php';

    $connection = new ConexaoDB();

    $user_exists = $connection->get_user($user);

    if ($user_exists != null) {
        $_SESSION['user_exists'] = 'Usuário já cadastrado! Tente outro ou recupere sua senha.';
        header('Location: http://localhost/cadastro/cadastro.php');
        die();
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $connection->insert_user($name, $user, $pass);
        $connection->__destruct();
    }
} else {
    $_SESSION['pass_mismatch'] = 'As senhas não conferem! Tente novamente.';
    header('Location: http://localhost/cadastro/cadastro.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso!</title>
    <link rel="stylesheet" href="./estilos/index.css">
</head>

<body class="login-bg">
    <div class="container container-c" style="height: 100vh;">
        <div class="success">
            <div>Cadastro realizado com sucesso!</div>
            <a class="link" href="http://localhost/cadastro/">Fazer Login</a>
        </div>
    </div>
</body>

</html>