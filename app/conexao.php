<?php
$host = 'db';
$db   = 'crud_produtos';
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela produtos automaticamente se ela não existir
    $pdo->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        descricao TEXT NOT NULL,
        data_cadastro DATETIME NOT NULL
    )");

} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>