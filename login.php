<?php
require 'db/conexao.php';
require 'helpers/auth.php';
require 'helpers/flash.php';
require 'helpers/csrf.php';

// login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if (!verify_csrf($_POST['_csrf'] ?? '')) {
        set_flash('Token CSRF inválido', 'error');
        header('Location: login.php'); exit;
    }
    $stmt = $mysqli->prepare('SELECT id, nome, username, senha FROM usuarios WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    if ($res && password_verify($senha, $res['senha'])) {
        login_user(['id' => $res['id'], 'nome' => $res['nome'], 'username' => $res['username']]);
        header('Location: index.php'); exit;
    } else {
        set_flash('Usuário ou senha inválidos', 'error');
        header('Location: login.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Login - PetShop</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
<section class="card">
<h2>Login</h2>
<?= flash() ?>
<form method="post">
<?= csrf_field() ?>
<input name="username" placeholder="Usuário" required>
<input type="password" name="senha" placeholder="Senha" required>
<button type="submit">Entrar</button>
</form>
</section>
</main>
</body>
</html>