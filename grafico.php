<?php

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';
require_once 'Class/Usuario.php';

// Inicie a sessão

session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login/login.html");
    exit();
}

$stmt = $conn->prepare("SELECT NomeTema, COUNT(NomeTema) AS Quantidade FROM temas GROUP BY NomeTema;");
$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($resultado as $row) {
    $tema[] = $row['NomeTema'];
    $quantidade[] = $row['Quantidade'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <div id="teste"><canvas id="grafico"></canvas></div>

    <script>
        const ctx = document.getElementById('grafico').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($tema); ?>,
                datasets: [{
                    label: 'Quantidade de Perguntas',
                    data: <?php echo json_encode($quantidade); ?>,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }

                }
            }
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</body>

</html>