<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form   action="Cliente.php" 
            method="post" 
            enctype="multipart/form-data"
        >
        <label>
            Nome <input type="text" name=":nome_cliente">
        </label>
        <label>
            CPF: <input type="text" name=":cpf_cliente" >
        </label>
        <button>Salvar</button>
    </form>

    <table border>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
        </tr>
<?php

// 1. Configurações do Banco de Dados
$host = 'localhost';
$db   = 'sistema_reserva';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    $sql = "SELECT * FROM cliente ORDER BY id_cliente DESC";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultado = $stmt->fetchall();
} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}
    
foreach($resultado as $cliente):
?>
    <tr>
        <td>
            <?= $cliente['nome'] ?> 
        </td>
        <td>
            <?php echo $cliente['cpf']; ?>
        </td>
    </tr>
<?php
endforeach;
?>
</table>

</body>
</html>