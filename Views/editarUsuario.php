<?php
require_once '../Class/Usuario.php';
require_once '../conexao.php';

// Verifica se um ID de usuário foi passado na URL
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Cria uma instância da classe Usuario
    $usuario = new Usuario($conn);

    // Obtém as informações do usuário com base no ID
    $dadosUsuario = $usuario->obterUsuarioPorID($idUsuario);

    // Verifica se o usuário foi encontrado
    if (!$dadosUsuario) {
        // Redireciona de volta para a página de gerenciamento de usuários se o usuário não existir
        header("Location: gerenciarUsuario.php");
        exit();
    }
} else {
    // Redireciona de volta para a página de gerenciamento de usuários se o ID não estiver presente na URL
    header("Location: gerenciarUsuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="../Controllers/editar_usuario_gravar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idUsuario" value="<?php echo $dadosUsuario['idUsuarios']; ?>">

        <label for="NomeUsuario">Nome do Usuário:</label>
        <input type="text" id="NomeUsuario" name="NomeUsuario" value="<?php echo $dadosUsuario['NomeUsuario']; ?>">
    
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" value="<?php echo $dadosUsuario['Email']; ?>">

        <label for="Senha">Senha:</label>
        <input type="password" name="Senha">

        <label for="Fone">Tel / Cel:</label>
        <input type="tel" name="Tel_Cel" id="Tel_Cel" value="<?php echo $dadosUsuario['Tel_Cel']; ?>">

        <label for="Funcao">Função:</label>
            <select id="Funcao" name="Funcao" value="<?php echo $dadosUsuario['Funcao']; ?>">
                <option value="Administrador">Administrador</option>
                <option value="Coordenador">Coordenador</option>
            </select>

        <label for="Foto">Carregar Foto:</label>
        <input type="file" id="Foto" name="Foto">
    
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
