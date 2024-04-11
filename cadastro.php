<!-- cadastro.php -->
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <div class="container">
    <h2>Cadastro</h2>
    <form action="registrar.php" method="post">
        Nome: <input type="text" name="nome"><br>
        Email: <input type="email" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" value="Cadastrar" class="btn-logout">
	
    </form>
	<button onclick="location.href='index.php'" class="btn">Voltar</button>
    </div>
</body>
</html>
