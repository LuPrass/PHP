<?php
// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'sistema_reserva';
$user = 'root';
$pass = '';

try {
    // 2. Conexão com o Banco de Dados
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    

    // 4. Preparar a query SQL (com placeholders ':' para segurança)
    $sql = "INSERT INTO cliente (nome, cpf) 
                VALUES (:nome, :cpf)";
    $stmt = $pdo->prepare($sql);

    //Etapa de barreira de dados
    //Que os jogos comecem

    $nome = $_POST[':nome_cliente'];
    $cpf = $_POST[':cpf_cliente'];

    //
    $cpf = str_replace(',', '.', $cpf);

    if (!is_numeric($cpf)){
        die("Você é um usuário do mal");
    }
 //conferir se o cpf já existe no banco de dados
    $sql = "SELECT * FROM cliente WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cpf' => $cpf]);
    $cliente_existente = $stmt->fetch();

    if ($cliente_existente) {
        die("CPF já cadastrado!");
    }

    // 5. Executar passando os dados reais
    $stmt->execute(
        [
            ':nome' => $nome,
            ':cpf' => $cpf
        ]
    );

    header('location: form_R.php');
    // echo "Dados inseridos com sucesso! com o ID: ". 
    //         $pdo->lastInsertID();

} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}