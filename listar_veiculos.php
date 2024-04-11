<?php
session_start();
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Incluir o arquivo de configuração do banco de dados
include 'config.php';

// Obtém o nome do usuário da sessão
$nome_usuario = $_SESSION['usuario_nome'];

// Consulta SQL para selecionar todos os veículos e seus respectivos proprietários
$sql = "SELECT v.*, u.nome AS nome_proprietario FROM veiculos v
        INNER JOIN usuarios u ON v.id_usuario = u.id";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Veículos</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Lista de Veículos</h1>
    <p>Olá, <?php echo $nome_usuario; ?>! Aqui estão os veículos cadastrados:</p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Placa</th>
            <th>Proprietário</th>
        </tr>
        <?php
        // Verificar se há resultados na consulta
        if ($resultado->num_rows > 0) {
            // Loop através de cada linha de resultados
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["marca"] . "</td>";
                echo "<td>" . $row["modelo"] . "</td>";
                echo "<td>" . $row["ano"] . "</td>";
                echo "<td>" . $row["cor"] . "</td>";
                echo "<td>" . $row["placa"] . "</td>";
                echo "<td>" . $row["nome_proprietario"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum veículo cadastrado.</td></tr>";
        }
        ?>
    </table>

    <br>
    <button onclick="location.href='dashboard.php'" class="btn" style="width: 30%;">Voltar</button>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados após o uso
$conn->close();
?>
