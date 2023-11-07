<?php
require_once 'Class/Sugestoes.php';
require_once 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma instância da classe Sugestoes
    $sugestao = new Sugestoes($conn);

    // Obtém os dados do formulário
    $sugestao->setNome(isset($_POST["nome"]) ? trim($_POST["nome"]) : null);
    $sugestao->setEmail(isset($_POST["email"]) ? trim($_POST["email"]) : null);
    $sugestao->setTelefone(isset($_POST["telefone"]) ? trim($_POST["telefone"]) : null);
    $sugestao->setConteudoSugestao(isset($_POST["messagem"]) ? trim($_POST["messagem"]) : null);

     // Obtém o tema selecionado
     $temaSelecionado = isset($_POST["Tema"]) ? $_POST["Tema"] : null;
     // Obtém a data atual
    $dataSubmissao = date("Y-m-d H:i:s");

    // Insere a sugestão no banco
    if ($sugestao->inserirSugestao($temaSelecionado)) {
        echo "Sugestão gravada com sucesso!";
    } else {
        echo "Erro ao gravar a sugestão.";
    }
}

    // Realize validações adicionais conforme necessário
    $errors = [];

    // Exemplo de validação: Verifica se o nome da sugestão está presente
    if (empty($nomeSugestao)) {
        $errors[] = "O nome da sugestão é obrigatório.";
    }

    // Exemplo de validação: Verifica se o email da sugestão está presente e é válido
    if (empty($emailSugestao) || !filter_var($emailSugestao, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "O email da sugestão é obrigatório e deve ser válido.";
    }

    function validarTelefone($telefone)
    {
        return preg_match('/^\d+$/', $telefone);
    }

// Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém o número de telefone do formulário
        $telefone = isset($_POST['Telefone']) ? $_POST['Telefone'] : '';

}

    // Se houver erros, exiba mensagens de erro e pare o processamento
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        exit(); // Ou redirecione para uma página de erro, se preferir
    }

    

    // Cria uma instância da classe Sugestoes
    $sugestao = new Sugestoes($conn);

    // Insere a sugestão no banco de dados
    $sugestao->inserirSugestao($nomeSugestao, $emailSugestao, $telefoneSugestao, $conteudoSugestao);

    // Redireciona para a página FAQ após a inserção
    header("Location: faq.php");
   exit();
?>
