<?php
require_once '../Class/Sugestoes.php';
require_once '../conexao.php';
require_once '../Class/Perguntas.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma instância da classe Sugestoes
    $sugestao = new Sugestoes($conn);
    $pergunta = new Perguntas($conn);

    // Obtém os dados do formulário
    $sugestao->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
    $sugestao->setEmail(isset($_POST["email"]) ? trim($_POST["email"]) : null);
    $sugestao->setTelefone(isset($_POST["telefone"]) ? trim($_POST["telefone"]) : null);
    $sugestao->setConteudoSugestao(isset($_POST["messagem"]) ? trim($_POST["messagem"]) : null);

    $pergunta->setAutor(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
    $pergunta->setConteudoPergunta(isset($_POST["messagem"]) ? trim($_POST["messagem"]) : null);

    // Obtém o tema selecionado
    $temaSelecionado = isset($_POST["Tema"]) ? $_POST["Tema"] : null;

    // Realize validações específicas da classe Sugestoes
    if (!$sugestao->validarEmail()) {
        echo "O email da sugestão é obrigatório e deve ser válido.";
        exit();
    }

    // Insere a sugestão no banco
    $sugestao->inserirSugestao($temaSelecionado);

    // Realize validações específicas da classe Perguntas
    if (!$pergunta->validarConteudoPergunta()) {
        echo "O conteúdo da pergunta não pode estar vazio.";
        exit();
    }

    if ($pergunta->cadastrarPergunta($temaSelecionado)) {
        echo "Pergunta gravada com sucesso!";
    } else {
        echo "Erro ao gravar a pergunta.";
    }

    // Redireciona para a página FAQ após a inserção
    header("Location: ../principal.php");
    exit();
}
?>
