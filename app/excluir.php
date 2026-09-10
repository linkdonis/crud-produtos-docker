<?php

require_once 'conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
$stmt->execute([
    ':id' => $id
]);

header('Location: index.php');
exit;