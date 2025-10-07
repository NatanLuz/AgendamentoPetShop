<?php
require 'db/conexao.php';
require 'helpers/auth.php';
require 'helpers/flash.php';
require 'helpers/csrf.php';
require_login();

$clienteRows = $mysqli->query('SELECT id, nome FROM clientes');

// Edit mode: ?edit=ID
$editing = null;
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    $stmt = $mysqli->prepare('SELECT * FROM pets WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $eid);
    $stmt->execute();
    $editing = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) { set_flash('CSRF inválido','error'); header('Location: pets.php'); exit; }
    if (isset($_POST['adicionar'])) {
        $cliente_id=(int)$_POST['cliente_id']; $nome=trim($_POST['nome']); $especie=trim($_POST['especie']); $idade=(int)$_POST['idade'];
        $stmt=$mysqli->prepare('INSERT INTO pets (cliente_id,nome,especie,idade) VALUES (?,?,?,?)'); $stmt->bind_param('issi',$cliente_id,$nome,$especie,$idade); $stmt->execute(); set_flash('Pet criado','success'); header('Location: pets.php'); exit;
    }
    if (isset($_POST['editar'])) {
        $id = (int)$_POST['id']; $cliente_id=(int)$_POST['cliente_id']; $nome=trim($_POST['nome']); $especie=trim($_POST['especie']); $idade=(int)$_POST['idade'];
        $stmt = $mysqli->prepare('UPDATE pets SET cliente_id=?, nome=?, especie=?, idade=? WHERE id=?');
        $stmt->bind_param('issii', $cliente_id, $nome, $especie, $idade, $id);
        $stmt->execute(); set_flash('Pet atualizado','success'); header('Location: pets.php'); exit;
    }
    if (isset($_POST['excluir'])) { $id=(int)$_POST['excluir']; $stmt=$mysqli->prepare('DELETE FROM pets WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); set_flash('Pet excluído','success'); header('Location: pets.php'); exit; }
}
$rows = $mysqli->query('SELECT pets.*, clientes.nome as cliente_nome FROM pets JOIN clientes ON pets.cliente_id = clientes.id');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="utf-8"><title>Pets</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<main>
<section class="card">
<h2>Pets</h2>
<?= flash() ?>
<form method="post">
<?= csrf_field() ?>
<input type="hidden" name="id" value="<?= (int)($editing['id'] ?? 0) ?>">
<select name="cliente_id" required>
<option value="">Selecione</option>
<?php
        // reset pointer of clienteRows
        $clienteRows->data_seek(0);
        while($cl=$clienteRows->fetch_assoc()): ?>
<option value="<?= (int)$cl['id'] ?>" <?= isset($editing['cliente_id']) && $editing['cliente_id'] == $cl['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cl['nome']) ?></option>
<?php endwhile; ?>
</select>
<input name="nome" placeholder="Nome do pet" required value="<?= htmlspecialchars($editing['nome'] ?? '') ?>">
<input name="especie" placeholder="Espécie" value="<?= htmlspecialchars($editing['especie'] ?? '') ?>">
<input name="idade" placeholder="Idade" type="number" value="<?= (int)($editing['idade'] ?? 0) ?>">
<?php if ($editing): ?>
    <button name="editar">Salvar</button>
    <a href="pets.php" style="margin-left:8px;">Cancelar</a>
<?php else: ?>
    <button name="adicionar">Adicionar</button>
<?php endif; ?>
</form>
<table>
<thead><tr><th>ID</th><th>Nome</th><th>Espécie</th><th>Cliente</th><th>Ações</th></tr></thead>
<tbody>
<?php while($p=$rows->fetch_assoc()): ?>
<tr>
<td><?= (int)$p['id'] ?></td>
<td><?= htmlspecialchars($p['nome']) ?></td>
<td><?= htmlspecialchars($p['especie']) ?></td>
<td><?= htmlspecialchars($p['cliente_nome']) ?></td>
<td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="excluir" value="<?= (int)$p['id'] ?>"><button>Excluir</button></form></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</section>
</main>
</body>
</html>