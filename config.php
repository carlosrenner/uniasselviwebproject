<!-- config.php -->
<?php
$servername = "localhost";
$username = "root";
$password = ""; // Lembre-se de alterar isso se tiver configurado uma senha para o MySQL
$dbname = "meusite";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
