<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para buscar os produtos no banco de dados
$sql = "SELECT CodigoProduto, Descricao, Quantidade FROM produto ORDER BY Descricao";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $produtos = array();
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    echo json_encode($produtos);
} else {
    echo "[]";
}

$conn->close();
