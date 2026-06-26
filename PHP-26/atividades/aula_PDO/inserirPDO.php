<?php
function getConnection(){

    $host    = 'localhost';
    $db      = 'teste';
    $user    = 'root';
    $pass    = '';
    try{

        // Data Source Name
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            // 2. Cria a conexão PDO
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    }catch(PDOException $e){
        die("Deu problema na conexao");
    }
}

try {
 
    $pdo = getConnection();

    // 3. Prepara a query SQL com "placeholders" (:nome, :preco, :descricao)
    $sql = "INSERT INTO produto (nome, preco, descricao) 
    VALUES (:nome, :preco, :descricao)";
    $stmt = $pdo->prepare($sql);

extract($_POST); // Extrai as variáveis :nome, :preco, :descricao do array $_POST converte post para variáveis
$preco = str_replace(',', '.', $preco); // Substitui vírgula por ponto no preço

    //echo '<pre>'; 
    //var_dump($_POST); // Verifique os dados recebidos do formulário

    $stmt->execute($_POST);

    echo "Produto inserido com sucesso! ID: " . $pdo->lastInsertId();

} catch (\PDOException $e) {
    // Se algo der errado na conexão ou no insert, o erro será capturado aqui
    echo "Erro no banco de dados: " . $e->getMessage();
}