<?php
// scripts/create_db.php
// Attempt to create the database and import schema from db/criar_tabelas.sql
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = (int)(getenv('DB_PORT') ?: 3306);
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$sqlFile = __DIR__ . '/../db/criar_tabelas.sql';

echo "Connecting to MySQL at $host:$port as $user...\n";
$mysqli = @new mysqli($host, $user, $pass, null, $port);
if ($mysqli->connect_errno) {
    echo "Connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}

if (!file_exists($sqlFile)) {
    echo "SQL file not found: $sqlFile\n";
    exit(1);
}

$sql = file_get_contents($sqlFile);
if ($sql === false) {
    echo "Failed to read SQL file: $sqlFile\n";
    exit(1);
}

echo "Importing SQL from $sqlFile ...\n";
if ($mysqli->multi_query($sql)) {
    do {
        if ($res = $mysqli->store_result()) {
            $res->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
    echo "Import finished successfully.\n";
    exit(0);
} else {
    echo "Import failed: " . $mysqli->error . "\n";
    exit(1);
}
