<?php
require_once 'Class/Temas.php';
require_once 'conexao.php';

session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login/login.html");
    exit();
}

// Cria uma instância da classe Usuario
$tema = new Temas($conn);

// Obtém todos os usuários cadastrados no banco de dados
$temas = $tema->listarTemas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="css/format.css">
    <style>
        /* Adicione ao seu CSS existente */

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 430px; /* Ajuste a largura máxima conforme necessário */
        }

        .fechar {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #formularioCadastro {
            display: grid;
            gap: 10px;
        }

        #formularioCadastro label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        #formularioCadastro input,
        #formularioCadastro textarea,
        #formularioCadastro select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #formularioCadastro button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #formularioCadastro button:hover {
            background-color: #45a049;
        }


    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#abrirModal").click(function() {
            $("#myModal").css("display", "block");
        });

        $(".fechar").click(function() {
            $("#myModal").css("display", "none");
        });

        $(window).click(function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").css("display", "none");
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
        <a href="painelAdmin.php" onclick="vizualizar('lista', true)"><ion-icon
                name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="#"><ion-icon name="book-outline"></ion-icon><span>Temas</span></a>
        <a href="gerenciarUsuario.php"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="Views/listarVisitante.php"><ion-icon name="thumbs-up"></ion-icon></ion-icon><span>Feedback</span></a>
        <a href="login/sairLogin.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>
    </div>
    <!--sidebar final-->

    <div class="content">
        <div id='listaRegistros'>

        <div class="titulo_ask">
            <h1>Gerenciador de Temas</h1>
            <button id="abrirModal">Inserir</button>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="fechar">&times;</span>
                <h2>Cadastrar Novo Tema</h2>
                <form id="formularioCadastro" action="Controllers/gravar_tema.php" method="post">
                    <!-- Campo Nome do Tema -->
                    <label for="nomeTema">Nome do Tema:</label>
                    <input type="text" id="nomeTema" name="nomeTema" placeholder="Nome do Tema" required>

                    <!-- Campo Descrição do Tema -->
                    <label for="descricaoTema">Descrição do Tema:</label>
                    <textarea id="descricaoTema" name="descricaoTema" rows="4" cols="50" placeholder="Descrição do Tema"></textarea>

                    <!-- Botão de Cadastro -->
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>


    
            <div style='display: flex;' class="filtro">
                <input style='flex:1' placeholder="PESQUISAR" autofocus id='inputPesquisa' />
            </div>


        <!-- Botão Adicionar -->
    
    <?php if (!empty($temas)): ?>
        <table>
            <tr>
                <thead>
                <th>ID</th>
                <th>Nome do Tema</th>
                <th>Descrição</th>
                <th>Data do Cadastro</th>
                <th>Ações</th>    
            </tr>
            </thead>
            <?php foreach ($temas as $lista): ?>
                <tr>
                    <td><?php echo $lista['idTemas']; ?></td>
                    <td><?php echo $lista['NomeTema']; ?></td>
                    <td><?php echo $lista['descricaoTema']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($lista['dataCadastro'])); ?></td>
                    <td>
                        <!-- Botão Editar -->
                        <a href="Views/editarUsuario.php?id=<?php echo $user['idUsuarios']; ?>" style="display: inline-block;">
                            <button>Editar</button>
                        </a>

                        <form method="post" action="Controllers/excluir_tema.php" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?= $lista['idTemas']; ?>">
                            <input type="hidden" name="acao" value="excluir">
                            <button type="submit" style="background-color: #a00;" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                        </form>
                    </td>

                </tr>
                
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum usuário cadastrado.</p>
    <?php endif; ?>

        </div>  
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>