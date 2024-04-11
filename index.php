<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body class="body2">
    <div class="container">
        <h2>Bem vindo ao cadastro de Veículos</h2>
        <h2>Login</h2>
        <form action="login.php" method="post">
            Email: <input type="email" name="email"><br>
            Senha: <input type="password" name="senha"><br>
            <input type="submit" value="Entrar" class="btn">
        </form>
        <button onclick="location.href='cadastro.php'" class="btn-logout">Cadastar</button>
    </div>
</body>
</html>
