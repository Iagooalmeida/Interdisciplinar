<?php

class Perguntas
{
    public $idPergunta;
    private $conn;
    private $autor;
    private $conteudoPergunta;
    private $dataSubmissao;
    private $visivel;
    public $idTema;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getConteudoPergunta()
    {
        return $this->conteudoPergunta;
    }

    public function setConteudoPergunta($conteudoPergunta)
    {
        $this->conteudoPergunta = $conteudoPergunta;
    }

    public function getDataSubmissao()
    {
        return $this->dataSubmissao;
    }

    public function setDataSubmissao($dataSubmissao)
    {
        $this->dataSubmissao = $dataSubmissao;
    }

    public function getVisivel()
    {
        return $this->visivel;
    }

    public function setVisivel($visivel)
    {
        $this->visivel = $visivel;
    }

    public function listarPerguntas()
    {
        try {
            $sql = "SELECT perguntas.*, temas.NomeTema FROM perguntas
                LEFT JOIN temas ON perguntas.temas_idTemas = temas.idTemas";
            $stmt = $this->conn->query($sql);

            if ($stmt) {
                # Retorna os resultados com um array associativo
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


    private function limparInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function cadastrarPergunta($idTema)
    {
        try {
            // Limpa os dados para evitar SQL injection
            $this->autor = $this->limparInput($this->autor);
            $this->conteudoPergunta = $this->limparInput($this->conteudoPergunta);
            $this->idTema = $this->limparInput($idTema);

            // Define outros valores conforme necessário, por exemplo, dataSubmissao e visivel

            // Sua lógica de inserção no banco aqui
            $sql = "INSERT INTO perguntas (temas_idTemas, Autor, ConteudoPergunta)
                    VALUES (?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->idTema, $this->autor, $this->conteudoPergunta]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao cadastrar pergunta: " . $e->getMessage());
            return false;
        }
    }

    public function validarConteudoPergunta()
    {
        return !empty($this->getConteudoPergunta());
    }

    public function excluirPergunta($idPerguntas)
    {
        try {
            $sql = "DELETE FROM perguntas WHERE idPerguntas = :idPeguntas";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idPeguntas', $idPerguntas, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true; // Exclusão bem-sucedida
            } else {
                throw new Exception("Erro ao excluir usuário");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao excluir Pergunta: " . $e->getMessage());
            return false;
        }
    }

    public function obterPerguntaPorID($idPergunta)
    {
        try {
            // Limpa o ID para evitar SQL injection
            $idPergunta = $this->limparInput($idPergunta);
    
            // Prepara a query SQL para obter as informações do usuário
            $sql = "SELECT * FROM perguntas WHERE idPerguntas = :idPergunta";
    
            // Prepara a query
            $stmt = $this->conn->prepare($sql);
    
            // Binda os parâmetros
            $stmt->bindParam(':idPergunta', $idPergunta, PDO::PARAM_INT);
    
            // Executa a query
            $stmt->execute();
    
            // Obtém os resultados como um array associativo
            $dadosPergunta = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Retorna os dados do usuário
            return $dadosPergunta;
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao obter usuário por ID: " . $e->getMessage());
            return false;
        }
    }

    public function obterDetalhesPergunta($idPergunta)
    {
        try {
            // Limpa o ID para evitar SQL injection
            $idPergunta = $this->limparInput($idPergunta);

            // Prepara a query SQL para obter as informações da pergunta
            $sql = "SELECT * FROM perguntas WHERE idPerguntas = :idPergunta";

            // Prepara a query
            $stmt = $this->conn->prepare($sql);

            // Binda os parâmetros
            $stmt->bindParam(':idPergunta', $idPergunta, PDO::PARAM_INT);

            // Executa a query
            $stmt->execute();

            // Obtém os resultados como um array associativo
            $detalhesPergunta = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Converte as datas para o formato brasileiro
            $detalhesPergunta['DataSubmissao'] = (new DateTime($detalhesPergunta['DataSubmissao']))->format('d/m/Y H:i:s');
            $detalhesPergunta['UltimaAtualizacao'] = $detalhesPergunta['UltimaAtualizacao'] ? (new DateTime($detalhesPergunta['UltimaAtualizacao']))->format('d/m/Y H:i:s') : null;

            // Retorna os detalhes da pergunta
            echo json_encode($detalhesPergunta);
            exit;

            // Verifica se há resultados
            if (!$detalhesPergunta) {
                // Pode retornar null ou um array vazio, dependendo da sua lógica
                return null;
            }

            // Retorna os detalhes da pergunta
            return $detalhesPergunta;


            // Retorna os detalhes da pergunta
            return $detalhesPergunta;
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao obter detalhes da pergunta (ID: $idPergunta): " . $e->getMessage());
            return false;
        }
    }
}
?>
