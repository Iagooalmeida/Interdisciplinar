<?php
require_once '../Class/Usuario.php';
require_once '../conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'excluir') {
    // Verifica se o ID do usuário foi fornecido no formulário
    if (isset($_POST['id'])) {
        // Cria uma instância da classe Usuario
        $usuario = new Usuario($conn);

        // Obtém o ID do usuário do formulário
        $idUsuario = $_POST['id'];

        // Chama o método para excluir o usuário
        if ($usuario->excluirUsuario($idUsuario)) {
            header('Location: ../gerenciarUsuario.php');
        } else {
            echo "Erro ao excluir usuário";
        }
    } else {
        echo "ID do usuário não fornecido no formulário.";
    }
} else {
    echo "Ação inválida.";
}
?>