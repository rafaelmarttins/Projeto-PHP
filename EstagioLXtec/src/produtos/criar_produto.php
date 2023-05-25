<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
  die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $descricao = $_POST["descricao"];
  $quantidade = $_POST["quantidade"];

  // Verifica se a descrição já existe no banco de dados
  $sql = "SELECT * FROM produto WHERE Descricao = '$descricao'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $mensagem = "A descrição do produto já existe. Por favor, insira uma descrição diferente.";
    header("Location: produtos.php?mensagem=" . urlencode($mensagem));
    exit();
  } elseif (!preg_match('/^[a-zA-ZÀ-ú\s~]+$/', $descricao)) {
    $mensagem = "A descrição do produto não deve ter caracteres especiais.";
    header("Location: produtos.php?mensagem=" . urlencode($mensagem));
    exit();
  } else {
    // Insere os dados na tabela de produtos
    $sql = "INSERT INTO produto (Descricao, Quantidade) VALUES ('$descricao', '$quantidade')";
    if ($conn->query($sql) === TRUE) {
      $mensagem = "Produto criado com sucesso.";
      header("Location: produtos.php?mensagem=" . urlencode($mensagem));
      exit();
    } else {
      $mensagem = "Erro ao criar produto: " . $conn->error;
    }
  }
}

$conn->close();
