<?php

require_once '../Class/Perguntas.php';
require_once '../conexao.php';

// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: ../login/login.html");
    exit();
}

// Obtém a função do usuário da sessão
$funcaoUsuario = $_SESSION['funcaoUsuario'];

// Verifica se o usuário tem permissão para atualizar a pergunta
if ($funcaoUsuario == 'Coordenador' || $funcaoUsuario == 'Administrador') {

    // Obtém os dados do formulário
    $idPergunta = isset($_POST['idPergunta']) ? $_POST['idPergunta'] : null;
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
    $nomeUsuario = isset($_POST['nomeUsuario']) ? $_POST['nomeUsuario'] : null;
    $conteudoPergunta = isset($_POST['ConteudoPergunta']) ? trim($_POST['ConteudoPergunta']) : null;
    $resposta = isset($_POST['resposta']) ? trim($_POST['resposta']) : null;
    $idTema = isset($_POST['Tema']) ? $_POST['Tema'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $origem = isset($_POST['origem']) ? $_POST['origem'] : null;

    // Crie uma instância da classe Perguntas
    $pergunta = new Perguntas($conn);

    // Chame a função para atualizar a pergunta
    $atualizacaoSucesso = $pergunta->atualizarPergunta($idPergunta, $idUsuario, $nomeUsuario, $conteudoPergunta, $resposta, $idTema, $status, $origem);

    // Adicione o código JavaScript para mostrar uma mensagem antes de redirecionar
    echo '<script>';
    if ($atualizacaoSucesso) {
        // Chame a função para atualizações e exiba mensagem de erro se necessário
        $ultimaAtualizacao = $pergunta->atualizacoesPerguntas( $idUsuario, $idPergunta);

        if ($ultimaAtualizacao) {
            // Atualize a tabela perguntas com a última data de atualização
            $atualizacaoPerguntaSucesso = $pergunta->atualizarUltimaAtualizacao($idPergunta, $ultimaAtualizacao);

            if ($atualizacaoPerguntaSucesso) {
                echo 'alert("Pergunta atualizada com sucesso!");';
            } else {
                echo 'alert("Erro ao atualizar pergunta. Por favor, tente novamente.");';
            }
        } else {
            echo 'alert("Erro ao gravar atualização. Por favor, tente novamente.");';
        }

    } else {
        echo 'alert("Erro ao atualizar pergunta. Por favor, tente novamente.");';
    }
    echo 'window.location.href = "../painelAdmin.php";'; // Redireciona após a mensagem
    echo '</script>';
    exit();
} else {
    // Usuário não tem permissão, redirecione ou mostre uma mensagem de erro
    echo "Você não tem permissão para atualizar perguntas.";
    exit();
}
?>
