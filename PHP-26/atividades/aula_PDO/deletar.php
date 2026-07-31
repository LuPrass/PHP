<?php
require_once 'conexao.php';

extract($_GET);
$id = $_GET['id'];

try {
    //Lembrem do sql Injection aqui 
    $sql = "DELETE FROM produto WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $sqlVars = [];
    $sqlVars[':id'] = $id; 

    $stmt->execute($sqlVars);

    $resultado = $stmt->fetchall();

    header("Location: form.php");
} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}