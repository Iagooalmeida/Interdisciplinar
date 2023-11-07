<?php
require_once '../Class/Usuario.php';
require_once '../conexao.php';

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

    // Validações adicionais, se necessário

    // Verifica se um arquivo de foto foi enviado
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == UPLOAD_ERR_OK) {
        $fotoPath = "uploads/" . basename($_FILES['Foto']['name']);
        $fotoTipo = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));

        // Verifica se o arquivo é uma imagem
        $permitidos = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($fotoTipo, $permitidos)) {
            echo "Apenas arquivos de imagem são permitidos.";
            exit();
        }

        // Move o arquivo para a pasta de uploads
        move_uploaded_file($_FILES['Foto']['tmp_name'], $fotoPath);
    } else {
        $fotoPath = null;
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
        echo 'alert("Usuário atualizado com sucesso!");';
    } else {
        echo 'alert("Erro ao atualizar usuário. Por favor, tente novamente.");';
    }
    echo 'window.location.href = "../gerenciarUsuario.php";'; // Redireciona após a mensagem
    echo '</script>';
    exit();
}
?>
