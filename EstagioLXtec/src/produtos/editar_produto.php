<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];

        $conn = new mysqli("localhost", "root", "", "mercado");

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Atualizar os dados do produto no banco de dados
        $sql = "UPDATE produto SET Descricao = '$descricao', Quantidade = '$quantidade' WHERE CodigoProduto = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: produtos.php?mensagem=Produto atualizado com sucesso");
            exit();
        } else {
            header("Location: produtos.php?mensagem=Erro ao atualizar o produto: " . $conn->error);
            exit();
        }

        $conn->close();
    } else {
        header("Location: produtos.php?mensagem=ID do produto não fornecido");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
