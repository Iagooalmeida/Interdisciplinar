<?php
require_once 'Class/Perguntas.php';
require_once 'conexao.php';
// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login/login.html");
    exit();
}

$pergunta = new Perguntas($conn);
$perguntas = $pergunta->listarPerguntas();

$stmt = $conn->prepare("SELECT temas.NomeTema, COUNT(perguntas.idPerguntas) AS Quantidade
                        FROM temas
                        LEFT JOIN perguntas ON temas.idTemas = perguntas.temas_idTemas
                        GROUP BY temas.NomeTema;");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $row) {
    $tema[] = $row['NomeTema'];
    $quantidade[] = $row['Quantidade'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Adm FAQ</title>
    <link rel="stylesheet" href="css/format.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/filtroPerguntas.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tema', 'Quantidade'],
            <?php
            foreach ($resultado as $row) {
                echo "['" . $row['NomeTema'] . "', " . $row['Quantidade'] . "],";
            }
            ?>
        ]);

        var options = {
            title: '',
            width: '500',
            titleTextStyle: {
                color: '#333',
                fontSize: 24,
                bold: true,
                textAlign: 'center',
                
            },
            is3D: true,
            pieSliceText: 'percentage', // Exibir porcentagem
            pieSliceTextStyle: {
                color: 'white', // Cor do texto das fatias
                fontSize: 14,    // Tamanho da fonte do texto das fatias
                textStyle: {
                    bold: true, // Negrito
                }
            },
            backgroundColor: {
                fill: '#fff', // Cor de fundo
            },
            legend: {
                textStyle: {
                    color: '#333',
                    fontSize: 14,
                },
            },
            chartArea: {
                //right: '20%',   // Margem à esquerda
                top: '15%',    // Margem superior
                width: '100%',   // Largura da área do gráfico
                height: '900%',  // Altura da área do gráfico
            },
            margin: '10', // Centraliza o gráficos
        };

        // Defina as dimensões do contêiner do gráfico
        var chartContainer = document.getElementById('chart_div');
        chartContainer.style.width = '100%'; // Defina a largura desejada
        chartContainer.style.height ='200px'; // Defina a altura desejada

        var chart = new google.visualization.PieChart(chartContainer);

        // Adicione um ouvinte de redimensionamento para ajustar o gráfico quando a janela for redimensionada
        window.addEventListener('resize', function () {
            chart.draw(data, options);
        });

        // Desenhe o gráfico pela primeira vez
        chart.draw(data, options);
    }
</script>



</head>

<body page='lista'>
    <input type="checkbox" id="check">
    <!--começo do cabeçalho-->
    <header>
        <label for="check">
            <ion-icon name="menu-outline" id="sidebar_btn"></ion-icon>
        </label>
        <div class="left">
            <h3>Fatec <span>Itapira</span></h3>
        </div>
    </header>
    <!--final do cabeçalho-->
    <!--começo da barra lateral-->
    <div class="sidebar">
        <div class="center">
            <img src="icon/manager_icon_129392.png" class="image" alt="">
            <h2>Admin</h2>
        </div>
        <a href="#" onclick="vizualizar('lista', true)"><ion-icon
                name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="gerenciarTema.php"><ion-icon name="book-outline"></ion-icon><span>Temas</span></a>
        <a href="gerenciarUsuario.php"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="Views/listarVisitante.php"><ion-icon name="thumbs-up"></ion-icon></ion-icon><span>Feedback</span></a>
        <a href="login/sairLogin.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>
    </div>
    <!--final da barra lateral-->

    <div class="content">
        <div id='listaRegistros'>
             
        <div class="grafico">
            <h3 class="titulo_grafico">Distribuição Temática de Perguntas</h3>
            <div></div>
            <div id='chart_div'></div>
            <div></div>
        </div>
            
        

            <div class="titulo_ask">
                <h1>Cadastro de Perguntas FAQ</h1>
                <a href="Views/cadastrarPergunta.php"><button>Inserir</button></a>
            </div>

            <div style='display: flex; outline: none;' class="filtro">
                <form id="filtroForm">
                               
                    <input type="radio" id="filtroAutor" name="filtro" value="autor">
                    <label for="filtroAutor">Autor</label>

                    <input type="radio" id="filtroPergunta" name="filtro" value="pergunta" checked>
                    <label for="filtroPergunta">Pergunta</label>

                    <input type="radio" id="filtroTema" name="filtro" value="tema">
                    <label for="filtroTema">Tema</label>

                    <input type="text" autofocus id="filtroInput" placeholder="Digite o termo de pesquisa">

                    <button type="button" onclick="limparFiltro()">Limpar</button>

                    <label style="display: inline-block;" for="visualizacao">Visualização:
                        <select id="visualizacao" name="visualizacao">
                            <option value="atual">Tabela Atual</option>
                            <option value="internas">Somente Interna</option>
                            <option value="externas">Somente Externa</option>
                            <option value="aprovadas">Somente Aprovadas</option>
                            <option value="pendentes">Somente Pendente</option>
                        </select>
                    </label>                    

                    <label for="ordenarData">Ordenar por Data:</label>
                    <input type="date" id="ordenarData" name="ordenarData" placeholder="Escolha uma data">

                </form>
            </div>

            <?php if (!empty($perguntas)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Origem</th>
                            <th>Autor</th>                    
                            <th>pergunta</th>
                            <th>Resposta</th>
                            <th>Tema</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <?php foreach ($perguntas as $lista): ?>
                        <tr>
                            <td><?php echo $lista['idPerguntas']; ?></td>
                            <td><?php echo $lista['Origem'] ?></td>
                            <td><?php echo $lista['Autor'] ?></td>  
                            <td><?php echo $lista['ConteudoPergunta'] ?></td>
                            <td><?php echo substr($lista['Resposta'], 0, 60) . (strlen($lista['Resposta']) > 60 ? '...' : ''); ?></td>
                            <td><?php echo $lista['NomeTema']; ?></td>
                            <td><?php echo $lista['Status'] ?></td>
                            <td>
                                <a href="#" class="detalhes-btn" data-id="<?php echo $lista['idPerguntas']; ?>" title="Detalhes">
                                    <i style="background: indigo;" class="edit material-icons">info</i>
                                </a>
                                <a href="Views/editarPergunta.php?id=<?php echo $lista['idPerguntas']; ?>" title="Editar">
                                    <i class=" edit material-icons">edit</i>
                                </a>
                                <button type="button" class="excluir-btn" data-id="<?php echo $lista['idPerguntas']; ?>" title="Excluir">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Nenhuma pergunta cadastrada.</p>
            <?php endif; ?>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Detalhes da Pergunta</h2>
                <p><strong>ID:</strong><span id="detalhe-id"></span></p>
                <p><strong>Autor:</strong> <span id="detalhe-autor"></span></p>
                <p><strong>Conteúdo da Pergunta:</strong> <br><span id="detalhe-conteudo"></span></p>
                <p><strong>Resposta:</strong> <span id="detalhe-resposta"></span></p>
                <p><strong>Status:</strong> <span id="detalhe-status"></span></p>
                <p><strong>Data do Cadastro:</strong> <span id="detalhe-data"></span></p>
                <p><strong>Última Atualização:</strong> <span id="detalhe-atualizacao"></span></p>
                <p><strong>Autor da Última Atualização:</strong> <span id="detalhe-autor-ultima-atualizacao"></span></p>
            </div>
        </div>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        
    </body>
</html>