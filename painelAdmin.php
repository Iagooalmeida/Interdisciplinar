<?php
// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login/login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Adm FAQ</title>
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
                <button class="inserir" onclick="vizualizar('cadastro', true)">Inserir</button>
            </div>
    
            <div style='display: flex; outline: none;' class="filtro">
                <input style='flex:1; outline: none;'  placeholder="PESQUISAR" autofocus id='inputPesquisa' />
            </div>
    
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Autor</th>
                        <th>pergunta</th>
                        <th>Resposta</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id='listaRegistrosBody'></tbody>
            </table>    
        </div>


        <form id='cadastroRegistro'>
            <div class="name_id">

                <div class='label'>
                    <div>ID</div>
                    <div>
                        <input type='number' readonly id='id' />
                    </div>
                </div>

                <div class='label'>
                    <div>Autor</div>
                    <div>
                        <input id='nome' />
                    </div>
                </div>
    
            </div>
                
            <div class='label'>
                <div>Pergunta</div>
                <div>
                    <input id='pergunta' />
                </div>
            </div>
    
            <div class="label">
                <div>Resposta</div>
                <div>
                    <!-- <input type="text" id="resposta"> -->
                    <textarea name="messagem"  id="resposta" cols="36" rows="7" maxlength="500"></textarea>
                </div>      
            </div>
    
            <div>
                <button>Salvar</button>
                <button onclick="vizualizar('lista')" class="cinza" type='button'>Cancelar</button>
            </div>
    
        </form>

    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>