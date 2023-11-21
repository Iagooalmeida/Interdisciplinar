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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                }
            
                form {
                max-width: 400px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            
                label {
                display: block;
                margin-bottom: 8px;
                }
            
                input, select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                box-sizing: border-box;
                }
            
                button {
                background-color: #4caf50;
                color: #fff;
                padding: 10px 15px;
                border: none;
                cursor: pointer;
                }
            
                button:hover {
                background-color: #45a049;
                }
            </style>
</head>
<body>
    
    <form action="../Controllers/gravarPergunta.php" method="POST">
        <!-- Adicione os campos ocultos para idUsuario e nomeUsuario -->
        <h1>Tela Cadastro de Perguntas FAQ</h1>
            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
            <input type="hidden" name="nomeUsuario" value="<?php echo $_SESSION['nomeUsuario']; ?>">


            <!-- Campos do formulário -->
            <label for="ConteudoPergunta">Titulo:</label>
            <textarea name="ConteudoPergunta" id="ConteudoPergunta" rows="3" cols="50"></textarea>

            <label for="resposta">Resposta:</label>
            <textarea name="resposta" id="resposta" rows="8" cols="50"></textarea>

            <label for="tema">Tema:</label>
            <select id="Tema" name="Tema" required>
                    <!-- Adicione opção padrão -->
                    <option value="" selected disabled>Escolha um tema</option>

                    <?php
                        try {
                            require_once '../conexao.php';
                            $stmtTemas = $conn->query("SELECT idTemas, NomeTema FROM temas WHERE idTemaPai IS NULL ORDER BY NomeTema ASC");
                            if (!$stmtTemas) {
                                throw new Exception("Erro ao executar a consulta");
                            }
                            while ($tema = $stmtTemas->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$tema['idTemas']}'>{$tema['NomeTema']}</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Erro ao obter temas: " . $e->getMessage();
                        }
                    ?>
            </select>

            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="" selected disabled>Escolha uma opção:</option>
                <option value="Aprovado">Aprovado</option>
                <option value="Pendente">Pendente</option>
            </select>

            <!-- Botão de submit -->
            <button type="submit">Atualizar Pergunta</button>
    </form>
</body>
</html>