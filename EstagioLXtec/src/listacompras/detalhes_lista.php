<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $listaId = $_GET['id'];

    // Consulta os produtos da lista com base no ID da lista
    $sql = "SELECT p.Descricao FROM produto p INNER JOIN itemlista il ON p.CodigoProduto = il.CodigoProduto WHERE il.CodigoLista = '$listaId'";
    $result = $conn->query($sql);

    $produtos = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }
    echo json_encode($produtos);
} else {
    echo "ID da lista não fornecido.";
}

$conn->close();
