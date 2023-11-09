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
<script>
    $(document).ready(function () {
        $(".excluir-btn").on("click", function () {
            var idPergunta = $(this).data("id");

            if (confirm('Tem certeza que deseja excluir este usuário?')) {
                $.ajax({
                    url: "Controllers/excluir_Pergunta.php",
                    method: "POST",
                    data: { acao: "excluir", id: idPergunta },
                    success: function (data) {
                        // Faça algo após a exclusão, se necessário
                        console.log(data);
                        // Recarregar a página ou atualizar a lista, por exemplo
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Erro ao excluir: ", error);
                    }
                });
            }
        });
    });
</script>

    
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
            <img src="icon/manager_icon_129392.png" class="image" alt="">
            <h2>Admin</h2>
        </div>
        <a href="#" onclick="vizualizar('lista', true)"><ion-icon name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="gerenciarUsuario.php"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="pag_lista_sugestao.html"><ion-icon name="help-outline"></ion-icon><span>Dúvidas</span></a>
        <a href="#"><ion-icon name="information-circle-outline"></ion-icon><span>Sobre</span></a>
        <a href="#"><ion-icon name="settings-outline"></ion-icon><span>Configuração</span></a>
        <a href="login/sairLogin.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>
    </div>
    <!--sidebar final-->
    <div class="content">
        <div id='listaRegistros'>

            <div class="titulo_ask">
                <h1>Cadastro de Perguntas FAQ</h1>
                <a href="Views/cadastroUsuario.html"><button>Inserir</button></a>
            </div>
    
            <div style='display: flex; outline: none;' class="filtro">
                <input style='flex:1; outline: none;'  placeholder="PESQUISAR" autofocus id='inputPesquisa' />
            </div>

            <?php if(!empty($perguntas)) :?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autor</th>
                            <th>pergunta</th>
                            <th>Resposta</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <?php foreach ($perguntas as $lista): ?>
                        <tr>
                            <td><?php echo $lista['idPerguntas']; ?></td>
                            <td><?php echo $lista['Autor'] ?></td>
                            <td><?php echo $lista['ConteudoPergunta']?></td>
                            <td><?php echo substr($lista['Resposta'], 0, 50) . (strlen($lista['Resposta']) > 50 ? '...' : ''); ?></td>
                            <td><?php echo $lista['Status']?></td>
                            <td>
                                <a href="#"  class="detalhes-btn" data-id="<?php echo $lista['idPerguntas']; ?>" title="Detalhes">
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
    
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>