<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro na conexão" . mysqli_connect_error());
}
echo "Conexão realizada com sucesso.";
