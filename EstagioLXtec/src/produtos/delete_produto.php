<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui os registros dependentes da tabela "itemlista"
    $sqlDeleteItemLista = "DELETE FROM itemlista WHERE codigoproduto = '$id'";
    if ($conn->query($sqlDeleteItemLista) === TRUE) {
        // Exclui o produto da tabela "produto"
        $sqlDeleteProduto = "DELETE FROM produto WHERE CodigoProduto = '$id'";
        if ($conn->query($sqlDeleteProduto) === TRUE) {
            $mensagem = "Produto excluído com sucesso.";
            header("Location: produtos.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = "Erro ao excluir produto: " . $conn->error;
        }
    } else {
        $mensagem = "Erro ao excluir os registros dependentes: " . $conn->error;
    }
} else {
    $mensagem = "ID do produto não fornecido.";
    header("Location: produtos.php?mensagem=" . urlencode($mensagem));
    exit();
}

$conn->close();
