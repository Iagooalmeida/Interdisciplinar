<?php
class Usuario
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function listarUsuarios()
    {
        try {
            $sql = "SELECT * FROM usuarios";
            $stmt = $this->conn->query($sql);

            if ($stmt) {
                // Retorna os resultados como um array associativo
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Erro ao executar a consulta SQL");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }

    public function listarAutores()
    {
        try {
            $sql = "SELECT DISTINCT Autor FROM perguntas";
            $stmt = $this->conn->query($sql);

            if ($stmt) {
                // Retorna os resultados como um array associativo
                return $stmt->fetchAll(PDO::FETCH_COLUMN);
            } else {
                throw new Exception("Erro ao executar a consulta SQL");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao listar autores: " . $e->getMessage());
            return [];
        }
    }

    

    private function limparInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function inserirUsuario($nomeUsuario, $email, $senha, $telCel, $funcao, $fotoPath)
    {
        $nivelAcesso = 1; // Valor padrão
        $dataCadastro = date("Y-m-d");
        $dataUltimaAtualizacao = date("Y-m-d H:i:s");
    
        // Limpa os dados para evitar SQL injection
        $nomeUsuario = $this->limparInput($nomeUsuario);
        $email = $this->limparInput($email);
        $senha = $this->limparInput($senha);
        $telCel = $this->limparInput($telCel);
        $funcao = $this->limparInput($funcao);
    
        // Verifica se o e-mail já existe no banco de dados
        $sqlVerificaEmail = "SELECT COUNT(*) FROM usuarios WHERE Email = ?";
        $stmtVerificaEmail = $this->conn->prepare($sqlVerificaEmail);
        $stmtVerificaEmail->execute([$email]);
        $emailExistente = $stmtVerificaEmail->fetchColumn();
    
        if ($emailExistente > 0) {
            // O e-mail já existe, informa ao usuário
            return false;
        }
    
        // Insere o novo usuário no banco de dados
        $sqlInserirUsuario = "INSERT INTO usuarios (NomeUsuario, Email, Senha, Tel_Cel, Funcao, NivelAcesso, DataCadastro, DataUltimaAtualizacao, FotoPath)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmtInserirUsuario = $this->conn->prepare($sqlInserirUsuario);
        $stmtInserirUsuario->execute([$nomeUsuario, $email, $senha, $telCel, $funcao, $nivelAcesso, $dataCadastro, $dataUltimaAtualizacao, $fotoPath]);
    
        if ($stmtInserirUsuario->rowCount() > 0) {
            return true; // Inserção bem-sucedida
        } else {
            throw new Exception("Erro ao inserir usuário no banco de dados.");
        }
    }
    

    public function excluirUsuario($idUsuario)
    {
        try {
            $sql = "DELETE FROM usuarios WHERE idUsuarios = :idUsuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true; // Exclusão bem-sucedida
            } else {
                throw new Exception("Erro ao excluir usuário");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }

    public function atualizarUsuario($idUsuario, $nomeUsuario, $email, $senha, $telCel, $funcao, $fotoPath){

    try {
        // Validações
        if (empty($idUsuario) || empty($nomeUsuario) || empty($email)) {
            throw new Exception("ID, Nome do Usuário e Email são campos obrigatórios.");
        }

        // Limpa os dados para evitar SQL injection
        $idUsuario = $this->limparInput($idUsuario);
        $nomeUsuario = $this->limparInput($nomeUsuario);
        $email = $this->limparInput($email);
        $telCel = $this->limparInput($telCel);
        $funcao = $this->limparInput($funcao);
       

        // Verifica se um arquivo de foto foi enviado
        if (!empty($fotoPath)) {
            // Validação da extensão da foto, se necessário
        }

        // Monta a query SQL para a atualização
        $sql = "UPDATE usuarios 
                SET NomeUsuario = :nomeUsuario, 
                    Email = :email, 
                    Tel_Cel = :telCel, 
                    Funcao = :funcao, 
                    FotoPath = :fotoPath, 
                    DataUltimaAtualizacao = :dataAtual";

        // Adiciona a atualização da senha à query se o campo de senha não estiver vazio
        if (!empty($senha)) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql .= ", Senha = :senha";
        }

        $sql .= " WHERE idUsuarios = :idUsuario";

        // Prepara a query
        $stmt = $this->conn->prepare($sql);

        // Binda os parâmetros
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telCel', $telCel, PDO::PARAM_STR);
        $stmt->bindParam(':funcao', $funcao, PDO::PARAM_STR);
        $stmt->bindParam(':fotoPath', $fotoPath, PDO::PARAM_STR);
        

        // Adiciona a atualização da senha ao binding se o campo de senha não estiver vazio
        if (!empty($senha)) {
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
        }

        $dataAtual = date("Y-m-d H:i:s");
        $stmt->bindParam(':dataAtual', $dataAtual, PDO::PARAM_STR);

        // Executa a query
        if ($stmt->execute()) {
            // Atualização bem-sucedida
            return true;
        } else {
            throw new Exception("Erro ao atualizar usuário");
        }
    } catch (Exception $e) {
        // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
        error_log("Erro ao atualizar usuário: " . $e->getMessage());
        return false;
    }
}


    public function obterUsuarioPorID($idUsuario)
    {
        try {
            // Limpa o ID para evitar SQL injection
            $idUsuario = $this->limparInput($idUsuario);

            // Prepara a query SQL para obter as informações do usuário
            $sql = "SELECT * FROM usuarios WHERE idUsuarios = :idUsuario";

            // Prepara a query
            $stmt = $this->conn->prepare($sql);

            // Binda os parâmetros
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Obtém os resultados como um array associativo
            $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retorna os dados do usuário
            return $dadosUsuario;
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao obter usuário por ID: " . $e->getMessage());
            return false;
        }
    }

    public function validarLogin($email, $senha)
    {
        try {
            // Limpa os dados para evitar SQL injection
            $email = $this->limparInput($email);

            // Consulta o banco de dados para obter o usuário pelo e-mail
            $sql = "SELECT * FROM usuarios WHERE Email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                // Verifica se a senha fornecida é válida
                if (password_verify($senha, $usuario['Senha'])) {
                    // Senha válida, o login é bem-sucedido
                    $_SESSION['idUsuario'] = $usuario['idUsuarios'];
                    $_SESSION['nomeUsuario'] = $usuario['NomeUsuario'];
                    $_SESSION['emailUsuario'] = $usuario['Email'];
                    $_SESSION['funcaoUsuario'] = $usuario['Funcao'];
                    $_SESSION['nivelAcesso'] = $usuario['NivelAcesso'];

                    return true;
                } else {
                    // Senha inválida
                    return false;
                }
            } else {
                // Usuário não encontrado
                return false;
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao validar login: " . $e->getMessage());
            return false;
        }
    }
}
