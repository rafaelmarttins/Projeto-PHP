<?php
$conn = new mysqli("localhost", "root", "", "mercado");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeLista = $_POST["nomelista"];

    // Verifica se a descrição já existe no banco de dados
    $sql = "SELECT * FROM listacompras WHERE NomeLista = '$nomeLista'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mensagem = "O nome da lista já existe. Por favor, insira um nome diferente.";
        header("Location: listacompras.php?mensagem=" . urlencode($mensagem));
        exit();
    } elseif (!preg_match('/^[a-zA-ZÀ-ú\s~]+$/', $nomeLista)) {
        $mensagem = "O nome da lista não deve conter caracteres especiais.";
        header("Location: listacompras.php?mensagem=" . urlencode($mensagem));
        exit();
    } else {
        // Insere os dados na tabela de listas de compras
        $sql = "INSERT INTO listacompras (NomeLista) VALUES ('$nomeLista')";
        if ($conn->query($sql) === TRUE) {
            $mensagem = "Lista criada com sucesso.";
            header("Location: listacompras.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = "Erro ao criar lista: " . $conn->error;
        }
    }
}

$conn->close();
