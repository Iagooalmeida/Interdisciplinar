<?php
// Inclua os arquivos necessários
require_once '../Class/Perguntas.php';
require_once '../conexao.php';
require_once 'verificacao.php';

// Verifique se o ID da pergunta foi fornecido
if (isset($_POST['idPergunta'])) {
    $idPergunta = $_POST['idPergunta'];

    // Crie uma instância da classe Perguntas
    $pergunta = new Perguntas($conn);

    // Obtenha os detalhes da pergunta
    $detalhesPergunta = $pergunta->obterDetalhesPergunta($idPergunta);

    // Agrupe os detalhes da pergunta em um array
    $response = ['detalhesPergunta' => $detalhesPergunta];

    // Verifique se os detalhes foram obtidos com sucesso
    if ($detalhesPergunta) {
        // Retorne os detalhes da pergunta no formato JSON
        echo json_encode($response);
    } else {
        // Se houver um erro, retorne uma mensagem de erro no mesmo formato JSON
        $response = ['error' => 'Erro ao obter detalhes da pergunta.'];
        echo json_encode($response);
    }
} else {
    // Se o ID da pergunta não foi fornecido, retorne uma mensagem de erro no mesmo formato JSON
    $response = ['error' => 'ID da pergunta não fornecido.'];
    echo json_encode($response);
}
?>
