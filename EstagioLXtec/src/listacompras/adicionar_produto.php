<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercado";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $produtos = $_POST['produtos'];

    $sql = "INSERT INTO itemlista (codigolista, codigoproduto, quantidade) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Erro na preparação da consulta: " . $conn->error;
        $conn->close();
        exit;
    }

    foreach ($produtos as $produto) {
        $codigolista = $produto['codigolista'];
        $codigoproduto = $produto['codigoproduto'];
        $quantidade = $produto['quantidade'];

        $stmt->bind_param("iii", $codigolista, $codigoproduto, $quantidade);

        if (!$stmt->execute()) {
            echo "Erro ao adicionar o produto: " . $stmt->error;
            $stmt->close();
            $conn->close();
            exit;
        }
    }

    $stmt->close();
    $conn->close();
}
