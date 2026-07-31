<?php
require_once 'conexao.php';

if ( isSet($_GET['id'])){
    $id = $_GET['id'];

    $acao = "atualizar.php?id=$id";
    $nomeBotao = "Atualizar produto";
    
    $sql = "SELECT * FROM produto WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([":id" => $id]);

    $resultado = $stmt->fetchall();

    $produto = $resultado[0];
   

}else{
    $acao = 'produto.php';
    $nomeBotao = 'Cadastrar produto';
    $produto  = ['nome'=> '', 'preco' => ''];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form   action="<?= $acao ?>" 
            method="post" 
            enctype="multipart/form-data"
        >
        <label>
            Nome <input type="text" name=":nome_prod" value="<?= $produto['nome']?>">
        </label>
        <label>
            Preço: <input type="text" name=":preco_prod" value="<?= $produto['preco']?>" >
        </label>
        <button>
            <?= $nomeBotao ?>
        </button>
    </form>

    <table border>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        <tr>
<?php



try {

    $sql = "SELECT * FROM produto ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultado = $stmt->fetchall();
} catch (PDOException $e) {
    // Caso dê algum erro na conexão ou na query
    echo "Erro: " . $e->getMessage();
}
    
foreach($resultado as $produto):
?>
    <tr>
        <td>
            <?= $produto['nome'] ?>
        </td>
        <td>
            <?php echo $produto['preco']; ?>
        </td>
        <td>
            <a href="deletar.php?id=<?= $produto['id']?>"> [x] </a>
            <a href="form.php?id=<?= $produto['id']?>"> editar </a>
        </td>
    </tr>
<?php
endforeach;
?>
</table>

</body>
</html>