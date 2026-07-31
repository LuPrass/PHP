<?php
// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'teste';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro de conexao: " . $e->getMessage();
}