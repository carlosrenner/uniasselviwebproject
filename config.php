<!-- config.php -->
<?php
$servername = "localhost";
$username = "root";
$password = ""; // Lembre-se de alterar isso se tiver configurado uma senha para o MySQL
$dbname = "meusite";

// Cria a conex�o
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conex�o
if ($conn->connect_error) {
    die("Conex�o falhou: " . $conn->connect_error);
}
?>
