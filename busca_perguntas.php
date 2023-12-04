<?php
require_once "conexao.php";

// Recebe o termo de busca do Ajax
$termo = $_POST['termo'];

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL com LEFT JOIN entre as tabelas temas e perguntas
    $sql = "SELECT t.idTemas, t.NomeTema, p.ConteudoPergunta, p.Resposta
            FROM temas t
            LEFT JOIN perguntas p ON t.idTemas = p.temas_idTemas
            WHERE p.Status = 'Aprovado' AND (t.NomeTema LIKE :termo OR p.ConteudoPergunta LIKE :termo)
            ORDER BY t.NomeTema
            LIMIT :perguntasPorPagina OFFSET :offset";

    // Prepara a consulta usando prepared statements
    $stmt = $conn->prepare($sql);


    // Adiciona os parâmetros
    $stmt->bindValue(':termo', "%$termo%", PDO::PARAM_STR);
    $stmt->bindValue(':perguntasPorPagina', 10, PDO::PARAM_INT);  // Substitua pelo número desejado
    $stmt->bindValue(':offset', 0, PDO::PARAM_INT);  // Substitua pelo offset desejado

    // Executa a consulta
    $stmt->execute();

    // Exibe os resultados
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // echo "<p>ID Tema: " . $row["idTemas"] . " - Nome do Tema: " . $row["NomeTema"] . " - Conteúdo da Pergunta: " . $row["ConteudoPergunta"] . " - Resposta: " . $row["Resposta"] . "</p>";

            echo '<details class="card">';
            echo '<summary class="card__header">';
            echo '<img class="card__avatar" alt="Imagem cps_fatec" src="img/cps_fatec.jpg">';
            echo "<h1>" . nl2br($row['ConteudoPergunta']) . "</h1>";
            echo '<span class="card__indicator"></span>';
            echo '</summary>';

            echo '<div class="card__body">';
            echo "<p>" . nl2br($row['Resposta']) . "</p>";

            echo '<p>Links dos sites Abaixo</p>';
            echo '<hr>';
            echo '<div class="pag_links">';
            echo '<span> Portal: <a href="https://siga.cps.sp.gov.br/aluno/login.aspx" target="_blank">Siga</a> </span>';
            echo '<span> Site: <a href="https://fatecitapira.edu.br" target="_blank">Fatec Itapira</a> </span>';
            echo '</div>';

            echo '</div>';
            echo '</details>';
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro: " . $e->getMessage();
} finally {
    // Fecha a conexão com o banco de dados
    $conn = null;
}

?>