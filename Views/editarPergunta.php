<?php

    require_once '../Class/Perguntas.php';
    require_once '../conexao.php';
    require_once '../Controllers/verificacao.php';

    // Verifica se um ID de usuário foi passado na URL
    if (isset($_GET['id'])) {
        $idPergunta = $_GET['id'];

        // Cria uma instância da classe Usuario
        $pergunta = new Perguntas($conn);

        // Obtém as informações do usuário com base no ID
        $dadosPergunta = $pergunta->obterPerguntaPorID( $idPergunta);

        // Verifica se o usuário foi encontrado
        if (!$dadosPergunta) {
            // Redireciona de volta para a página de gerenciamento de perguntas se o usuário não existir
            header("Location: ../painelAdmin.php");
            exit();
        }
    } else {
        // Redireciona de volta para a página de gerenciamento de perguntas se o ID não estiver presente na URL
        header("Location: ../painelAdmin.php");
        exit();
    }

?>