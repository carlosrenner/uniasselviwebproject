<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Incluir o arquivo de configuração do banco de dados
include 'config.php';

// Variáveis para armazenar mensagens de erro ou sucesso
$mensagem_erro = $mensagem_sucesso = '';

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário de cadastro de veículo aqui
    $marca = htmlspecialchars($_POST['marca']);
    $modelo = htmlspecialchars($_POST['modelo']);
    $ano = $_POST['ano'];
    $cor = htmlspecialchars($_POST['cor']);
    $placa = strtoupper($_POST['placa']); // Converter a placa para maiúsculas
    $id_usuario = $_SESSION['usuario_id'];

    // Inserir os dados do veículo no banco de dados
    $sql = "INSERT INTO veiculos (marca, modelo, ano, cor, placa, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $marca, $modelo, $ano, $cor, $placa, $id_usuario);

    if ($stmt->execute()) {
        $mensagem_sucesso = "Veículo cadastrado com sucesso!";
    } else {
        $mensagem_erro = "Erro ao cadastrar veículo: " . $conn->error;
    }

    $stmt->close();
}
// Fechar a conexão com o banco de dados após o uso
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículo</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <style>
        .container {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Veículo</h1>
    <div class="container">
        <p>Por favor, preencha os dados do veículo:</p>

        <?php 
        // Exibir mensagens de erro ou sucesso, se houver
        if (!empty($mensagem_erro)) {
            echo "<p style='color: red;'>$mensagem_erro</p>";
        }
        if (!empty($mensagem_sucesso)) {
            echo "<p style='color: green;'>$mensagem_sucesso</p>";
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="marca">Marca:</label><br>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="modelo">Modelo:</label><br>
            <input type="text" id="modelo" name="modelo" required><br><br>

            <label for="ano">Ano:</label><br>
            <input type="number" id="ano" name="ano" min="1900" max="2099" required><br><br>

            <label for="cor">Cor:</label><br>
            <input type="text" id="cor" name="cor"><br><br>

            <label for="placa">Placa:</label><br>
            <input type="text" id="placa" name="placa" maxlength="8" required><br><br>

            <input type="submit" value="Cadastrar" class="btn-logout" style="background-color: #008CBA">
            <button onclick="location.href='dashboard.php'" class="btn">Voltar</button>
        </form>
    </div>
</body>
</html>
