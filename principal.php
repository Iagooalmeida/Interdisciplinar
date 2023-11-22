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
    <meta name="author" content="Iago Almeida">
    <title>Pagina Principal</title>

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
                <h2>Principais Perguntas e Respostas para o FAQ </h2>
                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem cps_fatec" src="img/cps_fatec.jpg">
                        <h1>Como faço para trancar minha matrícula?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            De acordo com o artigo 35 do Regulamento Geral dos Cursos das Fatecs, o aluno veterano tem a
                            opção de fazer até dois trancamentos
                            de matrícula, seja de forma consecutiva ou não. Para solicitar o trancamento, o aluno deve
                            comparecer à Secretaria Acadêmica da
                            Unidade com a sua carteirinha e preencher um requerimento de solicitação de trancamento. É
                            importante observar que o pedido de
                            trancamento de matrícula só pode ser realizado dentro do prazo final estipulado no
                            Calendário Acadêmico,
                            disponível no site da Fatec de Itapira. <strong>Link abaixo:</strong>
                        </p>
                        <hr>
                        <a href="https://fatecitapira.edu.br" target="_blank"
                            aria-label="Link para acessar site fatec">Site Fatec</a>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem cps_fatec" src="img/siga fatec.png">
                        <h1>Como faço para pedir um atestado?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Os atestados devem ser solicitados no sistema SIGA (Sistema Integrado de Gestão Acadêmica),
                            na opção Solicitação de Documentos. <br>
                        </p>
                        <p>
                            Após 3 dias úteis o atestado ficará disponível na tela de Solicitação de Documentos e também
                            será enviado para o aluno na plataforma Ms Teams.
                        </p>
                        <p>
                            O acesso ao SIGA pode ser feito pelo seguinte <strong>Link abaixo:</strong>
                        </p>
                        <hr>
                        <a href="https://siga.cps.sp.gov.br/aluno/login.aspx" target="_blank">Acessar Siga</a>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem siga fatec" src="img/cps_fatec.jpg">
                        <h1>Como faço para ver o meu horário de aula?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Para obter o horário de aula atualizado da Fatec de Itapira, aconselho acessar o site
                            oficial da instituição. Lá, você encontrará
                            informações detalhadas sobre os horários de aula de cada curso oferecido, bem como outras
                            informações relevantes sobre a instituição.
                            É sempre recomendável verificar o site da Fatec de Itapira regularmente, pois o horário de
                            aula pode ser atualizado a cada semestre
                            ou período letivo. <br><br> <strong>Link do site abaixo:</strong>
                        </p>
                        <hr>
                        <a href="https://fatecitapira.edu.br" target="_blank">Site Fatec</a>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/siga fatec.png">
                        <h1>Como fazer minha rematrícula?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Para fazer a rematrícula o aluno deve acessar o sistema SIGA (Sistema Integrado de Gestão
                            Acadêmica) dentro do prazo de rematrícula,
                            conforme previsão do Calendário de Escolar e clicar em Rematrícula. Cabe lembrar que a
                            rematrícula só estará liberada após a entrega
                            de todos os documentos originais solicitados pela secretaria, e após a confirmação de
                            recebimento do e-mail com as instruções para a rematrícula.
                        </p>
                        <p>
                            O acesso ao SIGA e o Calendário Escolar poderá ser consultados nos <strong>links
                                abaixo:</strong>
                        </p>
                        <hr>
                        <div class="pag_links">
                            <span>Portal: <a href="https://siga.cps.sp.gov.br/aluno/login.aspx"
                                    target="_blank">Siga</a></span>
                            <span>Site: <a href="https://fatecitapira.edu.br" target="_blank">Fatec Itapira</a></span>
                        </div>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Perdi minha senha do e-mail, como eu resolvo ?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            O aluno que perder a sua senha do e-mail deve procurar a Secretaria Acadêmica da Unidade
                            para solicitar a redefinição de senha do e-mail.
                        </p>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Não consigo acessar o SIGA, como eu faço?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            O aluno que não conseguir acessar o sistema SIGA (Sistema Integrado de Gestão Acadêmica)
                            deverá enviar uma mensagem eletrônica, DO SEU E-MAIL INSTITUCIONAL,
                            para o endereço <i>f278acad@cps.sp.gov.br</i> solicitando uma nova senha ou o desbloqueio do
                            seu acesso. Caso o problema de acesso seja o esquecimento da senha,
                            a Secretaria Acadêmica irá responder este e-mail com a nova senha temporária. <br><br>
                            <strong>Link abaixo:</strong>
                        </p>
                        <hr>
                        <span>E-mail: <a href="f278acad@cps.sp.gov.br" target="_blank">f278acad@cps.sp.gov.br</a></span>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Quem é o coordenador? (alunos ingressantes)</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Cada curso na Fatec de Itapira possui um coordenador responsável por auxiliar os alunos. O
                            Coordenador é um docente eleito
                            pelos docentes e designado pela Direção para desempenhar um papel importante na orientação
                            dos estudantes, no acompanhamento
                            do currículo do curso e na resolução de questões acadêmicas relacionadas ao programa de
                            estudos. O Coordenador do curso está
                            disponível para esclarecer dúvidas, fornece orientações sobre disciplinas, carga horária,
                            estágios, projetos, entre outros
                            assuntos relacionados ao curso. Além disso, o Coordenador pode ajudar a resolver questões
                            administrativas e fornecer informações
                            relevantes sobre a área de estudo do curso.
                        </p>
                        <p>
                            - <strong>CST em Gestão da Produção Industrial</strong> – Prof. José Marcos Romão Júnior
                            <br>
                            (jose.romao@fatec.sp.gov.br)
                        </p>
                        <p>
                            - <strong>CST em Gestão Empresarial</strong> – Prof. Gilberto Brandão Marcon <br>
                            (gilberto.marcon@fatec.sp.gov.br)
                        </p>
                        <p>
                            - <strong>CST em Desenvolvimento de Software Multiplataforma</strong> – Profa. Márcia Regina
                            Reggiolli <br>
                            (marcia.reggiolli@fatec.sp.gov.br)
                        </p>
                        <p>
                            - <strong>CST em Gestão da Tecnologia da Informação</strong> – Prof. Mateus Guilherme Fuini
                            <br>
                            (mateus.fuini@fatec.sp.gov.br)
                        </p>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Posso usar a biblioteca/laboratório fora do horário de aula?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Sim, os alunos da Fatec de Itapira têm permissão para utilizar a biblioteca e as salas de
                            estudos fora do horário de aula,
                            desde que esses espaços estejam abertos e haja funcionários presentes. A Fatec de Itapira
                            reconhece a importância do acesso
                            a recursos educacionais e espaços adequados para estudo, e, portanto, permite que os alunos
                            façam uso dessas instalações quando disponíveis. <br>
                            É importante ressaltar que o acesso à biblioteca e às salas de estudos fora do horário de
                            aula pode variar de acordo com as políticas internas
                            da instituição e as restrições aplicáveis em determinados períodos. Por isso, é recomendável
                            verificar os horários de funcionamento e as regras
                            específicas junto à administração da Fatec de Itapira ou com os responsáveis pela biblioteca
                            e pelas salas de estudos.
                        </p>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Qual o horário de funcionamento da biblioteca?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            O horário de funcionamento da biblioteca e da sala de estudos neste 1º semestre de 2023
                            ocorre: <br><br>
                            Segunda-feira – das 14h às 19h e das 21h às 22h <br>
                            Terça-feira – das 17h às 22h <br>
                            Quarta-feira – das 13h às 22h <br>
                            Quinta-feira – das 18h às 20h <br>
                            Sexta-feira – das 13h às 18h <br>
                            Sábado – das 10h às 14h <br>
                        </p>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem aqui" src="img/cps_fatec.jpg">
                        <h1>Quando abre o vestibular?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            O Processo Seletivo Vestibular da Fatec de Itapira para ingresso de novos alunos acontece
                            duas vezes por ano.
                            Essas datas costumam ser nos últimos meses de cada semestre. <br>
                            As aulas para o 1º semestre geralmente começam na primeira quinzena do mês de fevereiro.
                            Esse é o período em
                            que os alunos aprovados no vestibular iniciam suas atividades acadêmicas na instituição.
                            <br>
                            Já as aulas para o 2º semestre normalmente têm início na primeira quinzena do mês de agosto.
                            Nesse momento, novos alunos aprovados
                            no processo seletivo têm a oportunidade de começar sua trajetória na Fatec de Itapira.
                        </p>
                        <p>
                            É importante lembrar que essas informações são baseadas em padrões gerais e podem estar
                            sujeitas a alterações. Recomenda-se que os
                            interessados em ingressar na Fatec de Itapira consultem o site oficial da instituição ou
                            entrem em contato com a Fatec de Itapira
                            para obter informações atualizadas sobre o calendário do processo seletivo e o início das
                            aulas em cada semestre.
                        </p>
                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem cps_fatec" src="img/cps_fatec.jpg">
                        <h1>Quais os cursos?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            Atualmente a Fatec de Itapira oferece um total de 120 vagas, distribuídas entre os seguintes
                            Cursos Superiores Tecnológicos:
                        </p>
                        <p>
                            - <b>CST em Gestão da Produção Industrial</b> – saiba mais em <br>
                            https://fatecitapira.edu.br/gpi.html <br>
                        </p>
                        <p>
                            - <strong>CST em Gestão Empresarial</strong> – saiba mais em <br>
                            https://fatecitapira.edu.br/ge.html <br>
                        </p>
                        <p>
                            - <strong>CST em Desenvolvimento de Software Multiplataforma</strong> – saiba mais em <br>
                            https://fatecitapira.edu.br/dsm.html
                        </p>

                    </div>
                </details>

                <details class="card">
                    <summary class="card__header">
                        <img class="card__avatar" alt="Imagem cps_fatec" src="img/cps_fatec.jpg">
                        <h1>Como faço para ver o meu horário de aula?</h1>
                        <span class="card__indicator"></span>

                    </summary>
                    <div class="card__body">
                        <p>
                            De acordo com o Regulamento dos Cursos de Graduação das Fatecs existe a opção de
                            transferência intercursos dentro das Fatecs,
                            porém como pré-requisito o aluno deve possuir pelo menos metade das disciplinas do 1º
                            semestre do curso desejado eliminadas
                            com aproveitamento de estudos. Em seguida o candidato deverá acessar o site da Fatec de
                            Itapira <a href="https://fatecitapira.edu.br" target="_blank">https://fatecitapira.edu.br
                            </a>
                            e fazer o download do Edital de Transferência Interna. A divulgação do edital ocorre um
                            pouco antes período das inscrições
                            para transferência cujas datas estão especificadas no Calendário Escolar também disponível
                            no site https://fatecitapira.edu.br.
                        </p>
                        <p>
                            <b>Link do site abaixo:</b>
                        </p>
                        <hr>
                        <span>Site: <a href="https://fatecitapira.edu.br" target="_blank">Fatec Itapira</a></span>
                    </div>
                </details>

                <?php
                    // Faça a consulta para obter temas e perguntas correspondentes
                    $query = "SELECT t.idTemas, t.NomeTema, p.ConteudoPergunta, p.Resposta
                            FROM temas t
                            LEFT JOIN perguntas p ON t.idTemas = p.temas_idTemas
                            WHERE p.Status = 'Aprovado'
                            ORDER BY t.NomeTema";

                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    // Verifique se há temas e perguntas correspondentes
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
                            $stmtTemas = $conn->query("SELECT idTemas, NomeTema FROM temas WHERE idTemaPai IS NULL ORDER BY NomeTema");
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

</body>


</html>