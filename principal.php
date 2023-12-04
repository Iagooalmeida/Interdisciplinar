<?php
require_once 'conexao.php';
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/principal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/fatec_icon.ico" type="image/x-icon">
    <script src="js/validacao.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" async></script>
    <title>Pagina Principal</title>

    <script>
        function redirecionar() {
            window.location.href = "https://fatecitapira.edu.br/maisnoticias.html";
        }         
    </script>

</head>

<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    </div>
    <header id="cabecalho">
        <div class="card_cabecalho">
            <figure class="logotipo">
                <a href="#"><img src="img/logo_fatec.png" alt="Logo Fatec Itapira" title="logo_fatec"></a>
            </figure>

            <nav class="nav" title="menu">
                <ul class="nav-list">
                    <li class="nav-item"><a href="https://fatecitapira.edu.br/">Home</a></li>
                    <li class="nav-item"><a href="https://www.vestibularfatec.com.br/home/"
                            target="_blank">Vestibular</a></li>
                    <li class="nav-item"><a href="principal.html" title="duvidas">Dúvidas frequentes</a></li>
                    <li class="nav-item"><a href="login/login.html">Painel</a></li>
                </ul>
            </nav>
        </div>

    </header>
    <main main class="flex-container">
        <section class="conteudo">
            <div class="page">
                <h1>FAQ - FATEC</h1>
                <h2>Principais Perguntas e Respostas para o FAQ</h2>

                <!-- Input de busca  -->
                <input type="text" id="busca" oninput="buscarProdutos()">
                <!-- Div onde os resultados da busca são mostrados -->
                <div id="resultado"></div>

                <!-- Começo da lógica para mostrar as perguntas cadastradas do banco  -->
                <?php


                // Defina o número de perguntas por página
                $perguntasPorPagina = 2;

                // Obtenha o número da página atual a partir do parâmetro 'page'
                $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calcule o offset para a consulta SQL
                $offset = ($paginaAtual - 1) * $perguntasPorPagina;

                // Modifique a consulta SQL para incluir LIMIT e OFFSET
                $query = "SELECT t.idTemas, t.NomeTema, p.ConteudoPergunta, p.Resposta
                            FROM temas t
                            LEFT JOIN perguntas p ON t.idTemas = p.temas_idTemas
                            WHERE p.Status = 'Aprovado'
                            ORDER BY t.NomeTema
                            LIMIT :perguntasPorPagina OFFSET :offset";

                $stmt = $conn->prepare($query);
                $stmt->bindParam(':perguntasPorPagina', $perguntasPorPagina, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $temaAtual = null;

                    foreach ($stmt as $row) {
                        // Verifica se o tema mudou
                        if ($temaAtual !== $row['NomeTema']) {
                            // Se sim, exibe um cabeçalho para o novo tema
                            echo '<h2>' . $row['NomeTema'] . '</h2>';
                            $temaAtual = $row['NomeTema'];
                        }
                        echo '<details class="card">';
                        echo '<summary class="card__header">';
                        echo '<img class="card__avatar" alt="Imagem cps_fatec" src="img/cps_fatec.jpg">';
                        echo "<h1>" . nl2br($row['ConteudoPergunta']) . "</h1>";
                        echo '<span class="card__indicator"></span>';
                        echo '</summary>';

                        echo '<div class="card__body">';
                        echo "<p>" . nl2br($row['Resposta']) . "</p>";

                        // Adicione links específicos (substitua os URLs pelos corretos)
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
                    // Se não houver perguntas aprovadas, exiba uma mensagem ou faça algo adequado
                    echo '<p>Nenhuma pergunta aprovada no momento.</p>';
                }
                ?>

                <!-- Adicione links de navegação para a próxima e anterior página -->
                <div class="pagination">
                    <?php
                    // Calcule o número total de perguntas
                    $totalPerguntasQuery = $conn->query("SELECT COUNT(*) FROM perguntas WHERE Status = 'Aprovado'");
                    $totalPerguntas = $totalPerguntasQuery->fetchColumn();
                    $totalPaginas = ceil($totalPerguntas / $perguntasPorPagina);

                    // Exiba links para a página anterior, se houver
                    if ($paginaAtual > 1) {
                        echo '<a href="?page=' . ($paginaAtual - 1) . '">Anterior</a>';
                    }

                    // Exiba os números das páginas
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        // Adicione uma classe para destacar a página atual
                        $classeDestaque = ($i == $paginaAtual) ? 'pagina-atual' : '';

                        echo '<a href="?page=' . $i . '" class="' . $classeDestaque . '">' . $i . '</a>';
                        // Adicione um espaçamento (pode ajustar o valor conforme necessário)
                        echo ' ';
                    }

                    // Exiba um link para a próxima página, se houver
                    if ($paginaAtual < $totalPaginas) {
                        echo '<a href="?page=' . ($paginaAtual + 1) . '">Próxima</a>';
                    }
                    ?>
                </div>

            </div>
        </section>

        <aside class="itens_lateral">
            <form id="myForm" action="Controllers/gravarSugestoes.php" method="post">
                <header class="lateral_titulo">
                    <h1>Dúvidas e Sugestões</h1>
                </header>
                <div class="floating_placehold">
                    <label for="nome">Nome: <span>*</span></label>
                    <input type="text" name="nome" id="nome" onkeyup="handleName(event)" required>
                </div>

                <div class="floating_placehold">
                    <label for="email">E-mail: </label>
                    <input name="email" id="email" type="email">
                </div>

                <div class="floating_placehold">
                    <label for="telefone" name="telefone">Telefone: </label>
                    <input type="tel" name="telefone" id="phone" maxlength="15" onkeyup="handlePhone(event)">
                </div>
                <div class="floating_placehold">
                    <label for="Tema">Escolha tema da sugestão:</label>
                    <select id="Tema" name="Tema" required>
                        <!-- Adicione opção padrão -->
                        <option value="" selected disabled>Escolha um tema</option>
                        <?php
                        try {
                            $stmtTemas = $conn->query("SELECT idTemas, NomeTema FROM temas");
                            while ($tema = $stmtTemas->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$tema['idTemas']}'>{$tema['NomeTema']}</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Erro ao obter temas: " . $e->getMessage();
                        }
                        ?>
                    </select>
                </div>
                <textarea name="messagem" id="message" cols="36" rows="6" placeholder="Mensagem"></textarea>
                <button type="submit" class="button_enviar">
                    Enviar
                </button>
            </form>

        </aside>
        <div class="contato_whatsapp">
            <a href="https://api.whatsapp.com/send?phone=551938635210&amp;text=" target="_blank" rel="whatsapp">
                <img src="icon/whatsapp-icon-png-whatsapp-transparent.png" alt="Whatsapp">
            </a>
        </div>
    </main>

    <!-- Rodapé da página -->
    <footer class="rodape">
        <div class="container_footer">
            <!-- Css relacionado ao contato endereço -->
            <div class="footer">
                <div class="img_icone" title="icone">
                    <img src="icon/location-icon-white-png.png" width="30px" height="auto" alt="">
                </div>
                <h2><strong>Endereço</strong></h2>
                <p>Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista, 13974-080</p>
            </div>
            <!-- Css relacionado ao contato telefone -->
            <div class="footer">
                <div class="img_icone" title="icone">
                    <img src="icon/telefone-do-lab-white-contact-icon-png.png" width="30px" height="auto"
                        alt="icone telefone">
                </div>
                <h2><strong>Telefone:</strong></h2>
                <p>Telefones: (19) 3843-1996</p>
                <p>Whatsapp: (19) 98933-6291 | (19) 3863-5210</p>
            </div>
            <!-- Css relacionado ao E-mail -->
            <div class="footer">
                <div class="img_icone" title="icone">
                    <img src="icon/mail-png-994910.png" width="40px" height="auto" alt="icone email">
                </div>
                <h2><strong>E-mail</strong></h2>
                <p>contato@fatecitapira.edu.br</p>
            </div>
        </div>
        <div class="Copyright">
            <h3>Copyright © 2023 Fatec Itapira - Todos os Direitos Reservados - Desenvolvido por alunos T.I. da Fatec
            </h3>
        </div>
    </footer>


    <!-- Script relaciona ao input #busca -->
    <script src="js/busca.js"></script>

</body>


</html>