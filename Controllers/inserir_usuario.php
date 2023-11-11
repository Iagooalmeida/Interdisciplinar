<?php
require_once '../Class/Usuario.php';
require_once '../conexao.php';
require_once 'verificacao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma instância da classe Usuario
    $usuario = new Usuario($conn);

    // Obtém os dados do formulário
    $nomeUsuario = trim(addslashes($_POST["NomeUsuario"]));
    $email = trim(addslashes($_POST["Email"]));
    $senha = trim(password_hash($_POST["Senha"], PASSWORD_DEFAULT));
    $telCel = isset($_POST["Tel_Cel"]) ? trim(addslashes($_POST["Tel_Cel"])) : null;
    $funcao = isset($_POST["Funcao"]) ? trim(addslashes($_POST["Funcao"])) : null;

    // Verifica se os campos obrigatórios não estão vazios
    if (empty($nomeUsuario) || empty($email) || empty($senha)) {
        echo "Os campos obrigatórios devem ser preenchidos";
        exit();
    }

    // Validar o formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de e-mail inválido";
        exit;
    }

    // Validar a senha
    if (strlen($senha) < 6) {
        echo "A senha deve ter pelo menos 6 caracteres";
        exit;
    }

    // Validar a função
    if (!empty($funcao) && !preg_match('/^[a-zA-Z\s]+$/', $funcao)) {
        echo "Função inválida. Use apenas letras e espaços.";
        exit;
    }

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
        $fotoPath = null;
    }


    // Chama o método para inserir o usuário
    
        $resultado = $usuario->inserirUsuario($nomeUsuario, $email, $senha, $telCel, $funcao, $fotoPath);
   

    if ($resultado === false) {
         // O e-mail já existe, incluir mensagem no script JavaScript
        echo '<script>';
        echo 'alert("O e-mail fornecido já está cadastrado. Por favor, tente outro.");';
    } else {
        // Inserção bem-sucedida, continue com o restante do código
        echo 'alert("Usuário cadastrado com sucesso!";)';
    }
    echo 'window.location.href = "../gerenciarUsuario.php";'; // Redireciona após a mensagem
    echo '</script>';
    exit();
    
}
?>
