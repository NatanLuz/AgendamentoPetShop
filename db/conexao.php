<?php
// Conexão simples usando variáveis de ambiente ou defaults
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: 3306;
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_DATABASE') ?: 'petshop_db';

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);
if ($mysqli->connect_errno) {
    die('Erro de conexão MySQL: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
?>
