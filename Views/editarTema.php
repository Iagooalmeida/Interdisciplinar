// editar_tema.php
<?php
require_once '../conexao.php';
require_once '../Class/Temas.php';

session_start();

// Verifique se o usuário está autenticado
if(!isset($_SESSION['idUsuario'])) {
    header("Location: ../login/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tema = new Temas($conn);

    $idTema = $_POST['idTema'];
    $nomeTema = $_POST['nomeTema'];
    $descricaoTema = $_POST['descricaoTema'];

    $tema->setNomeTema($nomeTema);
    $tema->setDescricaoTema($descricaoTema);

    if ($tema->editarTema($idTema)) {
        // Redirecione para a página de gerenciamento de temas após a edição
        header("Location: ../gerenciarTema.php");
        exit();
    } else {
        // Trate o erro, se necessário
        echo "Erro ao editar o tema.";
    }
}
?>
