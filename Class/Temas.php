<?php
class Temas
{
    private $conn;
    private $NomeTema;
    private $DescricaoTema;
    private $DataCadastro;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function setNomeTema($nomeTema)
    {
        $this->NomeTema = $nomeTema;
    }

    public function setDescricaoTema($descricaoTema)
    {
        $this->DescricaoTema = $descricaoTema;
    }

    public function setDataCadastro($dataCadastro)
    {
        $this->DataCadastro = $dataCadastro;
    }

    public function getNomeTema()
    {
        return $this->NomeTema;
    }

    public function getDescricaoTema()
    {
        return $this->DescricaoTema;
    }

    public function getDataCadastro()
    {
        return $this->DataCadastro;
    }

    public function inserirTema()
    {
        try {
            $dataCadastro = date("Y-m-d");

            $sql = "INSERT INTO temas (NomeTema, DescricaoTema, dataCadastro) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $this->getNomeTema(), PDO::PARAM_STR);
            $stmt->bindValue(2, $this->getDescricaoTema(), PDO::PARAM_STR);
            $stmt->bindValue(3, $this->getDataCadastro(), PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao gravar tema: " . $e->getMessage());
            return false;
        }
    }

    public function listarTemas()
    {
        try {
            $sql = "SELECT * FROM temas";
            $stmt = $this->conn->query($sql);

            if ($stmt) {
                // Retorna os resultados como um array associativo
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Erro ao executar a consulta SQL");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao listar temas: " . $e->getMessage());
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


    public function listarTemasPaginados($paginaAtual, $itensPorPagina)
    {
        try {
            $sql = "SELECT * FROM temas LIMIT :paginaAtual, :itensPorPagina";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':paginaAtual', ($paginaAtual - 1) * $itensPorPagina, PDO::PARAM_INT);
            $stmt->bindValue(':itensPorPagina', $itensPorPagina, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt) {
                // Retorna os resultados como um array associativo
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Erro ao executar a consulta SQL");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao listar temas: " . $e->getMessage());
            return [];
        }
    }

    public function excluirTema($idTema)
    {
        try {
            $sql = "DELETE FROM temas WHERE idTemas = :idTema";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':idTema', $idTema, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new Exception("Erro ao excluir tema");
            }
        } catch (Exception $e) {
            // Trate o erro conforme necessário (ex: log, exibir mensagem, etc.)
            error_log("Erro ao excluir tema: " . $e->getMessage());
            return false;
        }
    }

    // Adicione este método à classe Temas
        public function editarTema($idTema)
        {
            try {
                $sql = "UPDATE temas SET NomeTema = ?, descricaoTema = ? WHERE idTemas = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $this->getNomeTema(), PDO::PARAM_STR);
                $stmt->bindValue(2, $this->getDescricaoTema(), PDO::PARAM_STR);
                $stmt->bindValue(3, $idTema, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    throw new Exception("Erro ao editar tema");
                }
            } catch (Exception $e) {
                error_log("Erro ao editar tema: " . $e->getMessage());
                return false;
            }
        }

}
?>