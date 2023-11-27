<?php
    require_once '../Class/Perguntas.php';
    require_once '../conexao.php';

    // Verifica se o formulário foi enviado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pergunta = new Perguntas($conn);

        // Obtém os dados do formulário
        $pergunta->setConteudoPergunta(isset($_POST["ConteudoPergunta"]) ? trim($_POST["ConteudoPergunta"]) : null);
        $pergunta->setResposta(isset($_POST["resposta"]) ? trim($_POST["resposta"]) : null);
        $pergunta->idTema = isset($_POST["Tema"]) ? $_POST["Tema"] : null;
        $pergunta->status = isset($_POST["status"]) ? $_POST["status"] : null;
        $idUsuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : null;
        $pergunta->setAutor(isset($_POST["nomeUsuario"]) ? trim($_POST["nomeUsuario"]) : null);
        $origem = "Interna";
        $pergunta->setOrigem($origem);

        if(empty($pergunta->getConteudoPergunta()) || empty($pergunta->getResposta()) || empty($pergunta->idTema)){
            echo '<script>';
            echo 'alert("Os campos obrigatórios devem ser preenchidos.");';
            echo 'window.location.href = "../cadastrarPergunta.php";';
            echo '</script>';
            exit();
        }
        
        try{
            // Grava a pergunta no banco
            if($pergunta->gravarPergunta($idUsuario)){
                echo '<script>';
                echo 'alert("Pergunta gravada com sucesso!");';
                echo 'window.location.href = "../Views/cadastrarPergunta.php";';
                echo '</script>';
            } else {
                throw new Exception("Erro ao gravar a pergunta.");
            }
        } catch (Exception $e){
            echo '<script>';
            echo 'alert("Erro: ' . $e->getMessage() . '");';
            echo 'window.location.href = "../principal.php";';
            echo '</script>';
        }
    }
?>