<?php
require_once '../Class/Sugestoes.php';
require_once '../conexao.php';
require_once '../Class/Pagination.php';

session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login/login.html");
    exit();
}

$sugestao = new Sugestoes($conn);
$totalRegistros = $sugestao->contarSugestoes();

$registrosPorPagina = 10;
$pagination = new Pagination($totalRegistros, $registrosPorPagina);
$paginaAtual = $pagination->getPaginaAtual();
$offset = ($paginaAtual - 1) * $registrosPorPagina;

$sugestoesPaginadas = $sugestao->listarSugestoesPaginadas($registrosPorPagina, $offset);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="../css/format.css">
</head>
<body page='lista'>
    <input type="checkbox" id="check">

    <!--header começo-->
    <header>
        <label for="check">
            <ion-icon name="menu-outline" id="sidebar_btn"></ion-icon>
        </label>
        <div class="left">
            <h3>Fatec <span>Itapira</span></h3>
        </div>
    </header>
    <!--header final-->
    <!--sidebar começo-->
    <div class="sidebar">
        <div class="center">
            <img src="../icon/manager_icon_129392.png" class="image" alt="">
            <h2>Admin</h2>
        </div>
        <a href="../painelAdmin.php" onclick="vizualizar('lista', true)"><ion-icon
                name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="../gerenciarUsuario.php"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="#"><ion-icon name="help-outline"></ion-icon><span>Feedback</span></a>
        <a href="../login/sairLogin.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>
    </div>
    <!--sidebar final-->

    <div class="content">
        <div id='listaRegistros'>

            <div class="titulo_ask">
                <h1>Feedback de Dúvidas Sugeridas</h1>
                <a href="Views/cadastroUsuario.html"><button>Cadastrar</button></a>
            </div>
    
            <div style='display: flex;' class="filtro">
                <input style='flex:1' placeholder="PESQUISAR" autofocus id='inputPesquisa' />
            </div>


        <!-- Botão Adicionar -->
    
        <?php if (!empty($sugestoesPaginadas)): ?>
        <table>
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tel / Cel</th>
                    <th>Pergunta Sugerida</th>    
                    <th>Data</th>
                    <th>Ações</th>   
                </tr>
            </thead>
            <?php foreach ($sugestoesPaginadas as $user): ?>
                <tr>
                    <td><?= $user['idSugestao']; ?></td>
                    <td><?= $user['Nome']; ?></td>
                    <td><a href="mailto:<?= $user['Email']; ?>"><?= $user['Email']; ?></a></td>
                    <td>
                        <?php
                        $numeroTelefone = preg_replace("/[^0-9]/", "", $user['Telefone']);
                        $ehCelular = preg_match("/^\d{10,}$/", $numeroTelefone);

                        if ($ehCelular): ?>
                            <a href="https://wa.me/<?= $numeroTelefone; ?>" target="_blank"><?= $user['Telefone']; ?></a>
                        <?php else: ?>
                            <?= $user['Telefone']; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $user['ConteudoSugestao']; ?></td>
                    <td><?= (new DateTime($user['DataSubmissao']))->format('d/m/Y H:i:s'); ?></td>
                    <td>
                    <a href="mailto:<?php echo $user['Email']; ?>">
                        <ion-icon name="mail-outline"></ion-icon>
                    </a>
                    <a href="https://wa.me/<?php echo preg_replace("/[^0-9]/", "", $user['Telefone']); ?>" target="_blank">
                        <ion-icon name="logo-whatsapp"></ion-icon>
                    </a>
                        <form action="../Controllers/excluir_visitante.php" method="POST">
                            <input type="hidden" name="id" value="<?= $user['idSugestao']; ?>">
                            <input type="hidden" name="acao" value="excluir">
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <?= $pagination->criarLinks(); ?>

    <?php else: ?>
        <p>Nenhum dado encontrado</p>
    <?php endif; ?>

        </div>  
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>