<?php
// scripts/reset_admin_password.php
// Usage: php scripts/reset_admin_password.php novaSenha
if ($argc < 2) {
    echo "Uso: php scripts/reset_admin_password.php <novaSenha>\n";
    exit(1);
}
$nova = $argv[1];
require __DIR__ . '/../db/conexao.php';
$hash = password_hash($nova, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare('UPDATE usuarios SET senha = ? WHERE username = ?');
$user = 'admin';
$stmt->bind_param('ss', $hash, $user);
if ($stmt->execute()) {
    echo "Senha do usuário 'admin' atualizada com sucesso.\n";
    exit(0);
} else {
    echo "Falha ao atualizar senha: " . $stmt->error . "\n";
    exit(1);
}
