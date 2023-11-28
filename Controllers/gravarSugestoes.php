<?php
require_once '../Class/Sugestoes.php';
require_once '../Class/Perguntas.php';
require_once '../conexao.php';

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
    $pergunta->setOrigem("Externa");

    // Obtém o tema selecionado
    $temaSelecionado = isset($_POST["Tema"]) ? $_POST["Tema"] : null;


    // Insere a sugestão no banco
    $sugestao->inserirSugestao($temaSelecionado);

    // Realiza validações específicas da classe Perguntas
    if (!$pergunta->validarConteudoPergunta()) {
        echo '<script>';
        echo 'alert("O conteúdo da pergunta não pode estar vazio.");';
        echo 'window.location.href = "../principal.php";';
        echo '</script>';
        exit();
    }

    try {
        // Cadastra a pergunta no banco
        if ($pergunta->cadastrarPergunta($temaSelecionado)) {
            echo '<script>';
            echo 'alert("Pergunta gravada com sucesso!");';
            echo 'window.location.href = "../principal.php";';
            echo '</script>';
        } else {
            throw new Exception("Erro ao gravar a pergunta.");
        }
    } catch (Exception $e) {
        echo '<script>';
        echo 'alert("Erro: ' . $e->getMessage() . '");';
        echo 'window.location.href = "../principal.php";';
        echo '</script>';
    }

    exit();
}
?>
