<?php
// Inicie a sessão
session_start();

// Destrua todas as variáveis de sessão
$_SESSION = array();

// Destrua a sessão
session_destroy();

// Redirecione para a página de login
header("Location: login.html");
exit();
?>
