<?php
require_once 'conexao.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f9; }
        form { background: #fff; padding: 20px; width: 400px; border: 1px solid #ddd; border-radius: 5px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        button { background: #ffc107; color: #000; padding: 10px; border: none; cursor: pointer; border-radius: 4px; }
        a { text-decoration: none; color: #007bff; display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Editar Produto</h1>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        <label>Descrição:</label>
        <textarea name="descricao" rows="4" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
        <button type="submit">Atualizar Produto</button>
    </form>
    <p><a href="index.php">Voltar para a listagem</a></p>
</body>
</html>