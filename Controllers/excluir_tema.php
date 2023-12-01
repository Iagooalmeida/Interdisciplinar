<?php
require_once '../Class/Temas.php';
require_once '../conexao.php';
require_once 'verificacao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'excluir') {
    // Verifica se o ID do usuário foi fornecido no formulário
    if (isset($_POST['id'])) {
        // Cria uma instância da classe Usuario
        $tema = new Temas($conn);

        // Obtém o ID do usuário do formulário
        $idTema = $_POST['id'];

        // Chama o método para excluir o usuário
        if ($tema->excluirTema($idTema)) {
            header('Location: ../gerenciarTema.php');
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