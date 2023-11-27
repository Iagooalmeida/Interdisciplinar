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

    // Obtém o idUsuario e o nome da sessão
    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $nivelAcesso = $_SESSION['nivelAcesso'];


    // Verifica se um ID de pergunta foi passado na URL
    if (isset($_GET['id'])) {
        $idPergunta = $_GET['id'];

        // Cria uma instância da classe Perguntas
        $pergunta = new Perguntas($conn);

        // Obtém as informações da pergunta com base no ID
        $dadosPergunta = $pergunta->obterPerguntaPorID($idPergunta);

        // Verifica se a pergunta foi encontrada
        if (!$dadosPergunta) {
            // Redireciona de volta para a página de gerenciamento de perguntas se a pergunta não existir
            header("Location: ../painelAdmin.php");
            exit();
        }
    } else {
        // Redireciona de volta para a página de gerenciamento de perguntas se o ID não estiver presente na URL
        header("Location: ../painelAdmin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Perguntas</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function cancelarEdicao() {
            // Use window.history para voltar para a página anterior
            window.history.back();
        }
    </script>
    </head>
    <body>
        
        <form action="../Controllers/editar_pergunta_gravar.php" method="post">
            <h1>Editar Pergunta</h1>
            <!-- Adicione os campos ocultos para idUsuario e nomeUsuario -->
            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
            <input type="hidden" name="nomeUsuario" value="<?php echo $_SESSION['nomeUsuario']; ?>">

            <input type="hidden" name="idPergunta" value="<?php echo $idPergunta; ?>">

            <!-- Campos do formulário -->
            <label for="ConteudoPergunta">Conteúdo da Pergunta:</label>
            <textarea name="ConteudoPergunta" id="ConteudoPergunta" rows="4" cols="50"><?php echo $dadosPergunta['ConteudoPergunta']; ?></textarea>

            <label for="resposta">Resposta:</label>
            <textarea name="resposta" id="resposta" rows="8" cols="60"><?php echo $dadosPergunta['Resposta']; ?></textarea>

            
            <label for="responsavel">Responsável</label>
            <select name="responsavel" id="responsavel" <?php echo ($_SESSION['nivelAcesso'] != 0 && $dadosPergunta['Usuarios_idUsuarios'] != $_SESSION['idUsuario']) ? 'disabled' : ''; ?>>
                <option value="" selected disabled>Escolha um responsável</option>
                <?php
                try {
                    $stmtUsuarios = $conn->query("SELECT idUsuarios, NomeUsuario FROM usuarios");
                    while ($usuario = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)) {
                        // Verifica se o usuário atual está disponível no banco de dados
                        $selecionado = ($usuario['idUsuarios'] == $dadosPergunta['Usuarios_idUsuarios']) ? 'selected' : '';
                        // Adiciona a opção apenas se o nível de acesso for 0 ou o usuário correspondente à pergunta
                        if ($_SESSION['nivelAcesso'] == 0 || $dadosPergunta['Usuarios_idUsuarios'] == $_SESSION['idUsuario']) {
                            echo "<option value='{$usuario['idUsuarios']}' $selecionado>{$usuario['NomeUsuario']}</option>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro ao obter usuários: " . $e->getMessage();
                }
                ?>
            </select>

            <label for="tema">Tema:</label>
            <select id="Tema" name="Tema" required>
                <!-- Adicione opção padrão -->
                <option value="" selected disabled>Escolha um tema</option>

                <?php
                try {
                    $stmtTemas = $conn->query("SELECT idTemas, NomeTema FROM temas");
                    while ($tema = $stmtTemas->fetch(PDO::FETCH_ASSOC)) {
                        // Verifica se o tema atual está disponível no banco de dados
                        $selecionado = ($tema['idTemas'] == $dadosPergunta['temas_idTemas']) ? 'selected' : '';

                        echo "<option value='{$tema['idTemas']}' $selecionado>{$tema['NomeTema']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erro ao obter temas: " . $e->getMessage();
                }
                ?>
            </select>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="" selected disabled>Escolha uma opção:</option>
                <option value="Aprovado">Aprovado</option>
                <option value="Pendente">Pendente</option>
                <option value="Reprovado">Reprovado</option>
            </select>

            <!-- Botão de submit -->
            <button type="submit">Atualizar Pergunta</button>
            <button style="background: darkgray;" type="button" onclick="cancelarEdicao()">Cancelar</button>
        </form>
    </body>
</html>