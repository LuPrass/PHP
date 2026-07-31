<?php
// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'teste';
$user = 'root';
$pass = '';

try {
    // 2. Conexão com o Banco de Dados
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    

    // 4. Preparar a query SQL (com placeholders ':' para segurança)
    $sql = "INSERT INTO produto (nome, preco) 
                VALUES (:nome, :preco)";
    $stmt = $pdo->prepare($sql);

    //Etapa de barreira de dados
    //Que os jogos comecem 😈

    $nome = $_POST[':nome_prod'];
    $preco = $_POST[':preco_prod'];

    //
    $preco = str_replace(',', '.', $preco);

    if (!is_numeric($preco)){
        die("Você é um usuário do mal 😈");
    }

    // 5. Executar passando os dados reais
    $stmt->execute(
        [
            ':nome' => $nome,
            ':preco' => $preco
        ]
    );

    header('location: form.php');
    // echo "Dados inseridos com sucesso! com o ID: ". 
    //         $pdo->lastInsertID();

} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}