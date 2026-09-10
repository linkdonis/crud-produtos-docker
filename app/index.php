<?php
require_once 'conexao.php';

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Produtos</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background-color: #f4f6f8; color: #333; }
        .container { width: 90%; max-width: 1000px; margin: 50px auto; }
        h1 { margin-bottom: 10px; }
        .topo { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .botao { display: inline-block; padding: 10px 16px; border-radius: 6px; text-decoration: none; color: white; background-color: #198754; }
        .botao:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); }
        th, td { padding: 14px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #212529; color: white; }
        .editar { color: #0d6efd; text-decoration: none; margin-right: 10px; }
        .excluir { color: #dc3545; text-decoration: none; }
        .vazio { text-align: center; padding: 30px; }
    </style>
</head>
<body>

<div class="container">
    <div class="topo">
        <div>
            <h1>Produtos</h1>
            <p>CRUD de produtos com PHP, MySQL e Docker</p>
        </div>
        <a href="criar.php" class="botao">+ Novo produto</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($produtos) > 0): ?>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($produto['data_cadastro'])) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $produto['id'] ?>" class="editar">Editar</a>
                        <a href="excluir.php?id=<?= $produto['id'] ?>" class="excluir" onclick="return confirm('Deseja realmente excluir este produto?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="vazio">Nenhum produto cadastrado.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>