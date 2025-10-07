<?php
require 'db/conexao.php';
require 'helpers/auth.php';
require 'helpers/flash.php';
require 'helpers/csrf.php';
require_login();

$petRows = $mysqli->query('SELECT id, nome FROM pets');

// Edit mode: ?edit=ID
$editing = null;
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    $stmt = $mysqli->prepare('SELECT * FROM agendamentos WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $eid);
    $stmt->execute();
    $editing = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) { set_flash('CSRF inválido','error'); header('Location: agendamentos.php'); exit; }
    if (isset($_POST['adicionar'])) {
        $pet_id=(int)$_POST['pet_id']; $data=trim($_POST['data']); $horario=trim($_POST['horario']); $tipo=trim($_POST['tipo_servico']);
        $stmt=$mysqli->prepare('INSERT INTO agendamentos (pet_id,data,horario,tipo_servico) VALUES (?,?,?,?)'); $stmt->bind_param('isss',$pet_id,$data,$horario,$tipo); $stmt->execute(); set_flash('Agendamento criado','success'); header('Location: agendamentos.php'); exit;
    }
    if (isset($_POST['editar'])) {
        $id = (int)$_POST['id']; $pet_id=(int)$_POST['pet_id']; $data=trim($_POST['data']); $horario=trim($_POST['horario']); $tipo=trim($_POST['tipo_servico']);
        $stmt = $mysqli->prepare('UPDATE agendamentos SET pet_id=?, data=?, horario=?, tipo_servico=? WHERE id=?');
        $stmt->bind_param('isssi', $pet_id, $data, $horario, $tipo, $id);
        $stmt->execute(); set_flash('Agendamento atualizado','success'); header('Location: agendamentos.php'); exit;
    }
    if (isset($_POST['excluir'])) { $id=(int)$_POST['excluir']; $stmt=$mysqli->prepare('DELETE FROM agendamentos WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); set_flash('Agendamento excluído','success'); header('Location: agendamentos.php'); exit; }
}
$rows = $mysqli->query('SELECT agendamentos.*, pets.nome as pet_nome FROM agendamentos JOIN pets ON agendamentos.pet_id = pets.id');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="utf-8"><title>Agendamentos</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<main>
<section class="card">
<h2>Agendamentos</h2>
<?= flash() ?>
<form method="post">
<?= csrf_field() ?>
<input type="hidden" name="id" value="<?= (int)($editing['id'] ?? 0) ?>">
<select name="pet_id" required>
<option value="">Selecione</option>
<?php
        $petRows->data_seek(0);
        while($pt=$petRows->fetch_assoc()): ?>
<option value="<?= (int)$pt['id'] ?>" <?= isset($editing['pet_id']) && $editing['pet_id'] == $pt['id'] ? 'selected' : '' ?>><?= htmlspecialchars($pt['nome']) ?></option>
<?php endwhile; ?>
</select>
<input type="date" name="data" required value="<?= htmlspecialchars($editing['data'] ?? '') ?>">
<input type="time" name="horario" required value="<?= htmlspecialchars($editing['horario'] ?? '') ?>">
<input name="tipo_servico" placeholder="Tipo de serviço" value="<?= htmlspecialchars($editing['tipo_servico'] ?? '') ?>">
<?php if ($editing): ?>
    <button name="editar">Salvar</button>
    <a href="agendamentos.php" style="margin-left:8px;">Cancelar</a>
<?php else: ?>
    <button name="adicionar">Adicionar</button>
<?php endif; ?>
</form>
<table>
<thead><tr><th>ID</th><th>Pet</th><th>Data</th><th>Horário</th><th>Serviço</th><th>Ações</th></tr></thead>
<tbody>
<?php while($a=$rows->fetch_assoc()): ?>
<tr>
<td><?= (int)$a['id'] ?></td>
<td><?= htmlspecialchars($a['pet_nome']) ?></td>
<td><?= htmlspecialchars($a['data']) ?></td>
<td><?= htmlspecialchars($a['horario']) ?></td>
<td><?= htmlspecialchars($a['tipo_servico']) ?></td>
<td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="excluir" value="<?= (int)$a['id'] ?>"><button>Excluir</button></form></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</section>
</main>
</body>
</html>