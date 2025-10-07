<?php
require 'helpers/auth.php';
require 'db/conexao.php';
require 'helpers/flash.php';
require_login();
$user = current_user();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Agendamento PetShop - Início</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><h1>Agendamento PetShop</h1></header>
<main>
<section>
<h2>Bem Vindo, <?= htmlspecialchars($user['nome'] ?? 'Usuário') ?></h2>
<p><a href="clientes.php">Clientes</a> | <a href="pets.php">Pets</a> | <a href="agendamentos.php">Agendamentos</a> | <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a></p>
</section>
</main>
</body>
</html>