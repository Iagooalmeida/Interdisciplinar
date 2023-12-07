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
// Regenerar o ID da sessão após a autenticação para maior segurança
session_regenerate_id();

$idUsuarioSessao = $_SESSION['idUsuario'];
$nivelAcessoSessao = $_SESSION['nivelAcesso'];

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
        <div class="foto-usuario">
            <?php
                $fotoPath = isset($_SESSION['fotoPath']) ? basename($_SESSION['fotoPath']) : '';
                $caminhoRelativo = 'uploads/' . $fotoPath;

                // Verifica se há um caminho da imagem e exibe a tag <img> com a classe 'foto-usuario-img'
                if (!empty($fotoPath)) {
                    echo '<img class="foto-usuario-img" src="' . $caminhoRelativo . '" alt="Foto do Usuário">';
                } else {
                    echo '<img class="foto-usuario-img" src="uploads/manager_icon_129392.png" alt="Imagem Padrão">';
                }
            ?>
        </div>

        <h2>
            <?php echo $_SESSION['nomeUsuario']; ?>
        </h2>
        
        </div>
        <a href="painelAdmin.php" onclick="vizualizar('lista', true)"><ion-icon
                name="desktop-outline"></ion-icon><span>Painel</span></a>
        <a href="gerenciarTema.php"><ion-icon name="book-outline"></ion-icon><span>Temas</span></a>
        <a href="gerenciarUsuario.php"><ion-icon name="person-outline"></ion-icon><span>Usuário</span></a>
        <a href="Views/listarVisitante.php"><ion-icon name="thumbs-up"></ion-icon></ion-icon><span>Feedback</span></a>
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
                <!-- <input style='flex:1' placeholder="PESQUISAR" autofocus id='inputPesquisa' /> -->
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
                <th>Data do Cadastro</th>
                <th>Ações</th>    
            </tr>
            </thead>
            <?php foreach ($usuarios as $user): ?>
                <tr>
                    <td><?php echo $user['idUsuarios']; ?></td>
                    <td><?php
                        // Verifica se há um caminho da imagem e exibe a tag <img>
                        if (!empty($user['FotoPath'])) {
                            $caminhoImagem = 'uploads/' . basename($user['FotoPath']);
                            echo '<img src="' . $caminhoImagem . '" alt="Foto do Usuário" style="max-width: 100px; max-height: 100px; border-radius: 20%;">';
                        } else {
                            echo '<img src="uploads/manager_icon_129392.png" alt="Imagem Padrão" style="max-width: 100px; max-height: 100px; border-radius: 40%;">';
                        }
                        ?>
                    </td>
                    <td><?php echo $user['NomeUsuario']; ?></td>
                    <td><?php echo $user['Email']; ?></td>
                    <td><?php echo $user['Tel_Cel']; ?></td>
                    <td><?php echo $user['Funcao']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($user['DataCadastro'])); ?></td>
                    <td>
                    <a href="Views/editarUsuario.php?id=<?php echo $user['idUsuarios']; ?>" onclick="return verificarPermissaoEditar(<?php echo $nivelAcessoSessao; ?>, <?php echo $user['idUsuarios']; ?>)"><button>Editar</button></a>

                    <!-- Script para verificar permissões -->
                    <script>
                        function verificarPermissaoEditar(nivelAcesso, idUsuario) {
                            // Se o usuário for master (nivelAcesso = 0) OU o usuário na sessão atual for o mesmo que está sendo editado, permitir a navegação
                            if (nivelAcesso === 0 || idUsuario == <?php echo $idUsuarioSessao; ?>) {
                                return true;
                            } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Permissão negada',
                                text: 'Desculpe, você não tem permissão para editar este usuário',
                            });
                                return false; // Impede a navegação para a página de edição
                            }
                        }
                    </script>   


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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

</body>
</html>