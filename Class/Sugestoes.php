<?php

class Sugestoes
{
    private $conn;
    private $nome;
    private $email;
    private $telefone;
    private $conteudoSugestao;
    private $status;
    private $dataSubmissao;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getConteudoSugestao()
    {
        return $this->conteudoSugestao;
    }

    public function setConteudoSugestao($conteudoSugestao)
    {
        $this->conteudoSugestao = $conteudoSugestao;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDataSubmissao()
    {
        return $this->dataSubmissao;
    }

    private function limparInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function inserirSugestao($idTema)
    {
        try {

            // Limpa os dados para evitar SQL injection
            $this->nome = $this->limparInput($this->nome);
            $this->email = $this->limparInput($this->email);
            $this->telefone = $this->limparInput($this->telefone);
            $this->conteudoSugestao = $this->limparInput($this->conteudoSugestao);
            $idTema = $this->limparInput($idTema);

            // Sua lógica de inserção no banco aqui, incluindo o uso do $idTema

            // Exemplo:
            $sql = "INSERT INTO sugestoes (Nome, Email, Telefone, ConteudoSugestao, idTema)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->nome, $this->email, $this->telefone, $this->conteudoSugestao, $idTema]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao inserir sugestão: " . $e->getMessage());
            return false;
        }
    }

    public function validarEmail()
    {
        return !empty($this->getEmail()) && filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL);
    }
}

?>
