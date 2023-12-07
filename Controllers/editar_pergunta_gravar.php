<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Pergunta</title>

    <!-- Adicione os links para o SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
</head>
<body>
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
if ($funcaoUsuario == 'Coordenação' || $funcaoUsuario == 'Administrador' || $funcaoUsuario == 'Administrativo') {

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
        $ultimaAtualizacao = $pergunta->atualizacoesPerguntas($idUsuario, $idPergunta);

        if ($ultimaAtualizacao) {
            // Atualize a tabela perguntas com a última data de atualização
            $atualizacaoPerguntaSucesso = $pergunta->atualizarUltimaAtualizacao($idPergunta, $ultimaAtualizacao);

            if ($atualizacaoPerguntaSucesso) {
                echo 'Swal.fire({';
                echo '    icon: "success",';
                echo '    title: "Sucesso",';
                echo '    text: "Pergunta atualizada com sucesso!"';
                echo '}).then(() => {';
                echo '    window.location.href = "../painelAdmin.php";';
                echo '});';
            } else {
                echo 'Swal.fire({';
                echo '    icon: "error",';
                echo '    title: "Erro",';
                echo '    text: "Erro ao atualizar pergunta. Por favor, tente novamente."';
                echo '}).then(() => {';
                echo '    window.location.href = "../painelAdmin.php";';
                echo '});';
            }
        } else {
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Erro",';
            echo '    text: "Erro ao gravar atualização. Por favor, tente novamente."';
            echo '}).then(() => {';
            echo '    window.location.href = "../painelAdmin.php";';
            echo '});';
        }
    } else {
        echo 'Swal.fire({';
        echo '    icon: "error",';
        echo '    title: "Erro",';
        echo '    text: "Erro ao atualizar pergunta. Por favor, tente novamente."';
        echo '}).then(() => {';
        echo '    window.location.href = "../painelAdmin.php";';
        echo '});';
    }
    echo '</script>';
    exit();
} else {
    // Usuário não tem permissão, redirecione ou mostre uma mensagem de erro
    echo "Você não tem permissão para atualizar perguntas.";
    exit();
}
?>
</body>
</html>
