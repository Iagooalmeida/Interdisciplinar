<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php
    require_once '../Class/Usuario.php';
    require_once '../conexao.php';
    require_once 'verificacao.php';

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém o ID do usuário a ser editado
        $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;

        // Cria uma instância da classe Usuario
        $usuario = new Usuario($conn);

        // Obtém os dados do formulário
        $nomeUsuario = isset($_POST["NomeUsuario"]) ? trim($_POST["NomeUsuario"]) : null;
        $email = isset($_POST["Email"]) ? trim($_POST["Email"]) : null;
        $senha = isset($_POST["Senha"]) ? trim($_POST["Senha"]) : null;
        $telCel = isset($_POST["Tel_Cel"]) ? trim($_POST["Tel_Cel"]) : null;
        $funcao = isset($_POST["Funcao"]) ? trim($_POST["Funcao"]) : null;

        $uploadsDirectory = __DIR__ . "/../uploads/";

        // Verifica se um arquivo de foto foi enviado
        if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == UPLOAD_ERR_OK) {
            $fotoNomeOriginal = basename($_FILES['Foto']['name']);
            $fotoPath = $uploadsDirectory . $fotoNomeOriginal;
            $fotoTipo = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));
        
            // Verifica se o arquivo é uma imagem
            $permitidos = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($fotoTipo, $permitidos)) {
                echo "Apenas arquivos de imagem são permitidos.";
                exit();
            }
        
            // Gera um nome de arquivo único usando MD5
            $fotoNomeHash = md5($fotoNomeOriginal . time()) . '.' . $fotoTipo;
        
            $fotoPath =  $uploadsDirectory . $fotoNomeHash;
        
            // Move o arquivo para a pasta de uploads
            move_uploaded_file($_FILES['Foto']['tmp_name'], $fotoPath);
        } else {
            // Se nenhum novo arquivo foi enviado, mantenha o caminho atual
            $fotoPath = isset($_POST['fotoAtual']) ? $_POST['fotoAtual'] : null;
        }

        if (!empty($senha)) {
            // Se a senha foi fornecida, atualiza o usuário com a nova senha
            $atualizacaoSucesso = $usuario->atualizarUsuario($idUsuario, $nomeUsuario, $email, $senha, $telCel, $funcao, $fotoPath);
        } else {
            // Se a senha não foi fornecida, atualiza o usuário sem alterar a senha
            $atualizacaoSucesso = $usuario->atualizarUsuario($idUsuario, $nomeUsuario, $email, null, $telCel, $funcao, $fotoPath);
        }

        // Adicione o código JavaScript para mostrar uma mensagem antes de redirecionar
        echo '<script>';
        if ($atualizacaoSucesso) {
            echo 'Swal.fire({';
            echo '    icon: "success",';
            echo '    title: "Sucesso",';
            echo '    text: "Usuário atualizado com sucesso!"';
            echo '}).then(() => {';
            echo '    window.location.href = "../gerenciarUsuario.php";';
            echo '});';
        } else {
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Erro",';
            echo '    text: "Erro ao atualizar usuário. Por favor, tente novamente."';
            echo '}).then(() => {';
            echo '    window.location.href = "../gerenciarUsuario.php";';
            echo '});';
        }
        echo '</script>';
        exit();
    }
    ?>
</body>
</html>

