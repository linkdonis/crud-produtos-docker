<?php

require_once 'conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Busca o produto pelo ID
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

// Atualiza o produto quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    if ($nome === '' || $preco === '' || $quantidade === '') {

        $erro = 'Preencha todos os campos.';

    } else {

        $stmt = $pdo->prepare(
            "UPDATE produtos
             SET nome = :nome,
                 preco = :preco,
                 quantidade = :quantidade
             WHERE id = :id"
        );

        $stmt->execute([
            ':nome' => $nome,
            ':preco' => $preco,
            ':quantidade' => $quantidade,
            ':id' => $id
        ]);

        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Produto</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .botoes {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        button,
        a {
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        button {
            background-color: #0d6efd;
            color: white;
        }

        .voltar {
            background-color: #6c757d;
            color: white;
        }

        .erro {
            padding: 10px;
            background-color: #f8d7da;
            color: #842029;
            border-radius: 5px;
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Editar Produto</h1>

        <?php if (isset($erro)): ?>

            <div class="erro">
                <?= htmlspecialchars($erro) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label for="nome">
                Nome do produto
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="<?= htmlspecialchars($produto['nome']) ?>"
                required
            >

            <label for="preco">
                Preço
            </label>

            <input
                type="number"
                id="preco"
                name="preco"
                step="0.01"
                min="0"
                value="<?= htmlspecialchars($produto['preco']) ?>"
                required
            >

            <label for="quantidade">
                Quantidade
            </label>

            <input
                type="number"
                id="quantidade"
                name="quantidade"
                min="0"
                value="<?= htmlspecialchars($produto['quantidade']) ?>"
                required
            >

            <div class="botoes">

                <button type="submit">
                    Salvar alterações
                </button>

                <a href="index.php" class="voltar">
                    Voltar
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>