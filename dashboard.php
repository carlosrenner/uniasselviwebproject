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

// Função para deletar um veículo específico
function deletarVeiculo($conn, $id_veiculo) {
    // Obtém o ID do usuário da sessão
    $id_usuario = $_SESSION['usuario_id'];

    // Prepara e executa a declaração de exclusão
    $sql = "DELETE FROM veiculos WHERE id = ? AND id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_veiculo, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

// Se o botão de deletar veículo for clicado
if (isset($_POST['deletar_veiculo'])) {
    $id_veiculo = $_POST['id_veiculo'];
    deletarVeiculo($conn, $id_veiculo);
}

// Consulta SQL para selecionar todos os veículos do usuário logado
$sql = "SELECT * FROM veiculos WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $nome_usuario; ?>!</h1>
	
        <button onclick="location.href='listar_veiculos.php'" class="btn" style="float: left;width: 33%;margin-right: 0.5%;background-color: #00CED1;">Listar Veículos</button>
	<button onclick="location.href='cadastro_veiculo.php'" class="btn" style="float: center;width: 33%;margin-right: 0.5%;">Cadastar Veículo</button>
        <button onclick="location.href='logout.php'" class="btn btn-logout" style="float: right;width: 33%;">Logout</button>
        
        <h2>Seus Veículos</h2>
        <?php if ($resultado->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Placa</th>
                    <th>Ações</th>
                </tr>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["marca"]; ?></td>
                        <td><?php echo $row["modelo"]; ?></td>
                        <td><?php echo $row["ano"]; ?></td>
                        <td><?php echo $row["cor"]; ?></td>
                        <td><?php echo $row["placa"]; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_veiculo" value="<?php echo $row["id"]; ?>">
                                <button type="submit" name="deletar_veiculo" class="btn btn-delete">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Nenhum veículo cadastrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados após o uso
$stmt->close();
$conn->close();
?>
