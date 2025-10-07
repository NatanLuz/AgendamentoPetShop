<?php
 //Smoke Runner simples para fluxos CRUD básicos
require __DIR__ . '/../db/conexao.php';

function run($desc, $fn) {
    echo "--- $desc\n";
    try { $fn(); echo "OK\n"; } catch (Exception $e) { echo "ERROR: " . $e->getMessage() . "\n"; }
}

run('clientes CRUD', function() {
    global $mysqli;
    $nome = 'Smoke Cliente ' . time();
    $stmt = $mysqli->prepare('INSERT INTO clientes (nome) VALUES (?)'); $stmt->bind_param('s',$nome); $stmt->execute(); $id = $mysqli->insert_id;
    $stmt = $mysqli->prepare('SELECT nome FROM clientes WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); $res=$stmt->get_result()->fetch_assoc(); if ($res['nome'] !== $nome) throw new Exception('nome mismatch');
    $stmt = $mysqli->prepare('DELETE FROM clientes WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute();
});

run('pets CRUD', function() {
    global $mysqli;
    // create cliente
    $stmt=$mysqli->prepare('INSERT INTO clientes (nome) VALUES (?)'); $n='Client for pet '.time(); $stmt->bind_param('s',$n); $stmt->execute(); $cid=$mysqli->insert_id;
    $stmt=$mysqli->prepare('INSERT INTO pets (cliente_id,nome) VALUES (?,?)'); $p='SmokePet '.time(); $stmt->bind_param('is',$cid,$p); $stmt->execute(); $pid=$mysqli->insert_id;
    $stmt=$mysqli->prepare('DELETE FROM pets WHERE id=?'); $stmt->bind_param('i',$pid); $stmt->execute(); $stmt=$mysqli->prepare('DELETE FROM clientes WHERE id=?'); $stmt->bind_param('i',$cid); $stmt->execute();
});

run('agendamentos CRUD', function() {
    global $mysqli;
    $stmt=$mysqli->prepare('INSERT INTO clientes (nome) VALUES (?)'); $c='Client for appt '.time(); $stmt->bind_param('s',$c); $stmt->execute(); $cid=$mysqli->insert_id;
    $stmt=$mysqli->prepare('INSERT INTO pets (cliente_id,nome) VALUES (?,?)'); $p='Pet for appt '.time(); $stmt->bind_param('is',$cid,$p); $stmt->execute(); $pid=$mysqli->insert_id;
    $d=date('Y-m-d'); $t='10:30'; $stmt=$mysqli->prepare('INSERT INTO agendamentos (pet_id,data,horario,tipo_servico) VALUES (?,?,?,?)'); $tipo='Consulta'; $stmt->bind_param('isss',$pid,$d,$t,$tipo); $stmt->execute(); $aid=$mysqli->insert_id;
    $stmt=$mysqli->prepare('DELETE FROM agendamentos WHERE id=?'); $stmt->bind_param('i',$aid); $stmt->execute(); $stmt=$mysqli->prepare('DELETE FROM pets WHERE id=?'); $stmt->bind_param('i',$pid); $stmt->execute(); $stmt=$mysqli->prepare('DELETE FROM clientes WHERE id=?'); $stmt->bind_param('i',$cid); $stmt->execute();
});

echo "Smoke tests finished\n";
