<?php
// Iniciar a sess�o
session_start();

// Limpar todas as vari�veis de sess�o
$_SESSION = array();

// Destruir a sess�o
session_destroy();

// Redirecionar para a p�gina de login
header("Location: index.php");
exit;
?>