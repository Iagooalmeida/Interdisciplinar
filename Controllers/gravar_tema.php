<?php
require_once '../Class/Temas.php';
require_once '../conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tema = new Temas($conn);

    // Obtém os dados do formulário
    $tema->setNomeTema(isset($_POST["nomeTema"]) ? trim($_POST["nomeTema"]) : null);
    $tema->setDescricaoTema(isset($_POST["descricaoTema"]) ? trim($_POST["descricaoTema"]) : null);
    $dataCadastro = date("Y-m-d");
    $tema->setDataCadastro($dataCadastro);

    if (empty($tema->getNomeTema())) {
        echo '<script>';
        echo 'alert("Os campos obrigatórios devem ser preenchidos.");';
        echo 'window.location.href = "../cadastrarTema.php";';
        echo '</script>';
        exit();
    }

    try {
        // Grava o tema no banco
        if ($tema->inserirTema()) {
            echo '<script>';
            echo 'alert("Tema gravado com sucesso!");';
            echo 'window.location.href = "../gerenciarTema.php";';
            echo '</script>';
        } else {
            throw new Exception("Erro ao gravar o tema.");
        }
    } catch (Exception $e) {
        echo '<script>';
        echo 'alert("Erro: ' . $e->getMessage() . '");';
        echo 'window.location.href = "../principal.php";';
        echo '</script>';
    }
}
?>