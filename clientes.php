<?php
require 'db/conexao.php';
require 'helpers/auth.php';
require 'helpers/flash.php';
require 'helpers/csrf.php';
require_login();

// Edit mode: ?edit=ID
$editing = null;
if (isset($_GET['edit'])) {
        $eid = (int)$_GET['edit'];
        $stmt = $mysqli->prepare('SELECT * FROM clientes WHERE id = ? LIMIT 1');
        $stmt->bind_param('i', $eid);
        $stmt->execute();
        $editing = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) { set_flash('CSRF inválido','error'); header('Location: clientes.php'); exit; }
    if (isset($_POST['adicionar'])) {
        $nome = trim($_POST['nome']); $telefone = trim($_POST['telefone']); $email = trim($_POST['email']);
        $stmt = $mysqli->prepare('INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nome, $telefone, $email); $stmt->execute(); set_flash('Cliente criado','success'); header('Location: clientes.php'); exit;
    }
    if (isset($_POST['editar'])) {
                $id = (int)$_POST['id']; $nome = trim($_POST['nome']); $telefone = trim($_POST['telefone']); $email = trim($_POST['email']);
                $stmt = $mysqli->prepare('UPDATE clientes SET nome=?, telefone=?, email=? WHERE id=?'); $stmt->bind_param('sssi',$nome,$telefone,$email,$id); $stmt->execute(); set_flash('Cliente atualizado','success'); header('Location: clientes.php'); exit;
    }
    if (isset($_POST['excluir'])) { $id=(int)$_POST['excluir']; $stmt=$mysqli->prepare('DELETE FROM clientes WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); set_flash('Cliente excluído','success'); header('Location: clientes.php'); exit; }
}
$rows = $mysqli->query('SELECT * FROM clientes');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="utf-8"><title>Clientes</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<main>
<section class="card">
<h2>Clientes</h2>
<?= flash() ?>
<form method="post">
<?= csrf_field() ?>
<input type="hidden" name="id" id="id" value="<?= (int)($editing['id'] ?? 0) ?>">
<input name="nome" placeholder="Nome" required value="<?= htmlspecialchars($editing['nome'] ?? '') ?>">
<input name="telefone" placeholder="Telefone" value="<?= htmlspecialchars($editing['telefone'] ?? '') ?>">
<input name="email" placeholder="Email" value="<?= htmlspecialchars($editing['email'] ?? '') ?>">
<?php if ($editing): ?>
    <button name="editar">Salvar alterações</button>
    <a href="clientes.php" style="margin-left:8px;">Cancelar</a>
<?php else: ?>
    <button name="adicionar">Adicionar</button>
<?php endif; ?>
</form>
<table>
<thead><tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Ações</th></tr></thead>
<tbody>
<?php while($c=$rows->fetch_assoc()): ?>
<tr>
<td><?= (int)$c['id'] ?></td>
<td><?= htmlspecialchars($c['nome']) ?></td>
<td><?= htmlspecialchars($c['telefone']) ?></td>
<td><?= htmlspecialchars($c['email']) ?></td>
<td>
<form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="excluir" value="<?= (int)$c['id'] ?>"><button>Excluir</button></form>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</section>
</main>
</body>
</html>