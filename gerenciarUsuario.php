<?php
require_once 'Class/Usuario.php';
require_once 'conexao.php';

session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login/login.html");
    exit();
}

// Cria uma instância da classe Usuario
$usuario = new Usuario($conn);

// Obtém todos os usuários cadastrados no banco de dados
$usuarios = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="css/format.css">

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
        <a href="painelAdmin.php"><ion-icon name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="#"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="grafico.php"><ion-icon name="help-outline"></ion-icon><span>Grafico</span></a>
        <a href="login/sairLogin.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>
    </div>
    <!--sidebar final-->

    <div class="content">
        <div id='listaRegistros'>

            <div class="titulo_ask">
                <h1>Cadastro de Usuários</h1>
                <a href="Views/cadastroUsuario.html"><button>Cadastrar</button></a>
            </div>

            <div style='display: flex;' class="filtro">
                <input style='flex:1' placeholder="PESQUISAR" autofocus id='inputPesquisa' />
            </div>


            <!-- Botão Adicionar -->

            <?php if (!empty($usuarios)): ?>
                <table>
                    <tr>
                        <thead>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nome do Usuário</th>
                            <th>Email</th>
                            <th>Tel / Cel</th>
                            <th>Função</th>
                            <th>Ações</th>
                    </tr>
                    </thead>
                    <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td>
                                <?php echo $user['idUsuarios']; ?>
                            </td>
                            <td>
                                <?php
                                // Verifica se há um caminho da imagem e exibe a tag <img>
                                if (!empty($user['FotoPath'])) {
                                    $caminhoImagem = 'uploads/' . basename($user['FotoPath']);
                                    echo '<img src="' . $caminhoImagem . '" alt="Foto do Usuário" style="max-width: 100px; max-height: 100px; border-radius: 20%;">';
                                } else {
                                    echo '<img src="uploads/manager_icon_129392.png" alt="Imagem Padrão" style="max-width: 100px; max-height: 100px; border-radius: 40%;">';
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $user['NomeUsuario']; ?>
                            </td>
                            <td>
                                <?php echo $user['Email']; ?>
                            </td>
                            <td>
                                <?php echo $user['Tel_Cel']; ?>
                            </td>
                            <td>
                                <?php echo $user['Funcao']; ?>
                            </td>
                            <td>
                                <!-- Botão Editar -->
                                <a
                                    href="Views/editarUsuario.php?id=<?php echo $user['idUsuarios']; ?>"><button>Editar</button></a>

                                <form method="post" action="Controllers/excluir_usuario.php">
                                    <input type="hidden" name="acao" value="excluir">
                                    <input type="hidden" name="id" value="<?php echo $user['idUsuarios']; ?>">
                                    <button style="background-color: #a00;" type="submit" <?php echo ($user['NivelAcesso'] == 0) ? 'hidden' : ''; ?>
                                        onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
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