<?php
// Inicie a sessão
session_start();

// Inclua o arquivo de conexão
require_once '../conexao.php';
require_once '../Class/Usuario.php';

// Verifique se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : null;

    // Cria uma instância da classe Usuario
    $usuario = new Usuario($conn);

    // Tenta realizar o login
    $loginSucesso = $usuario->validarLogin($email, $senha);

    echo '<script>';
    if ($loginSucesso) {
        // Login bem-sucedido
        $_SESSION['usuarioLogado'] = true;
        header("Location: ../painelAdmin.php");
        exit();
    } else {
        // Login falhou
        echo 'alert("Falha no login. Verifique suas credenciais.");';
    }
    echo 'window.location.href = "login.html";'; // Redireciona após a mensagem
    echo '</script>';
    exit();
}
?>
