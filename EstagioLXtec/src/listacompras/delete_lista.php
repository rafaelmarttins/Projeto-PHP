<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui os registros dependentes da tabela "itemlista"
    $sqlDeleteItemLista = "DELETE FROM itemlista WHERE codigolista = '$id'";
    if ($conn->query($sqlDeleteItemLista) === TRUE) {
        // Exclui a lista da tabela "listacompras"
        $sqlDeleteLista = "DELETE FROM listacompras WHERE CodigoLista = '$id'";
        if ($conn->query($sqlDeleteLista) === TRUE) {
            $mensagem = "Lista excluída com sucesso.";
            header("Location: listacompras.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = "Erro ao excluir lista: " . $conn->error;
        }
    } else {
        $mensagem = "Erro ao excluir os registros dependentes: " . $conn->error;
    }
} else {
    $mensagem = "ID da lista não fornecido.";
    header("Location: listacompras.php?mensagem=" . urlencode($mensagem));
    exit();
}

$conn->close();