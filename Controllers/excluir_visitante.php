<?php
include_once '../conexao.php';
require_once '../Class/Sugestoes.php';
require_once 'verificacao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'excluir') {
    if (isset($_POST['id'])) {
        $sugestoes = new Sugestoes($conn);
        $idSugestoes = $_POST['id'];
        if ($sugestoes->excluirSugestoes($idSugestoes)) {
            header('Location: ../Views/listarVisitante.php');
        } else {
            echo "Erro ao excluir sugestão";
        }
    } else {
        echo "ID da sugestão não fornecido no formulário.";
    }
} else {
    echo "Ação inválida.";
}
?>