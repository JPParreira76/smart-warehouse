<?php
session_start();

// Verificação de login
if (!isset($_SESSION["username"])) {
    header("refresh:0; url=index.php");
    die("Acesso restrito.");
}

// Open the txt file for reading
$file = fopen("api/files/temperatura/log.txt", "r");

// Initialize an empty array to store the data
$log_temperatura = [];

// Loop through each line of the file
while (($row = fgetcsv($file)) !== false) {
    // Add the row to the data array
    $log_temperatura[] = $row;
}

// Close the file
fclose($file);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Temperatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <div class="card boxes">
            <nav class="navbar navbar-expand-sm navegador">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="navbar-brand">
                            <p class="nav-item active"><a href="dashboard.php" class="btn btn-outline-dark btn-lg" role="button">Smart Warehouse</a></p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="webcam.php">Webcam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="video.php">Video do Projeto</a>
                        </li>
                    </ul>
                    <button onclick="window.location.href='logout.php'" class="btn btn-outline-dark" type="button">Logout</button>
                </div>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="card boxes">
            <div class="card-body">
                <img class="float-end img-dashboard" src="./img/warehouse2.png" alt="estg logo">
                <h1>Histórico de Temperatura</h1>
                <p class="welcome">Bem vindo <span class="username">
                        <?php echo $_SESSION["username"] ?>
                    </span></p>
                <p>Tecnologias de Internet - Engenharia Informática</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card boxes">
            <div class="card-body">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card boxes">
            <div class="card-header headers">
                <b>Tabela de Histórico de Temperatura</b>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Dispositivo IoT</th>
                            <th scope="col">Data de Atualização</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Para cada row em $log_ac cria uma linha da tabela
                        foreach ($log_temperatura as $row) {
                            echo "<tr>";
                            echo "<td>Temperatura</td>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "°</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer with a link to top page -->
    <footer>
        <a class="link" href="#Top">
            <p>Top</p>
        </a>
    </footer>

    <script>
        // Extrair datas e valores do histórico
        var dates = [];
        var values = [];
        <?php
        foreach ($log_temperatura as $row) {
            echo "dates.push('" . $row[0] . "');";
            echo "values.push(" . $row[1] . ");";
        }
        ?>

        // Configuração do gráfico
        var chartConfig = {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Temperatura',
                    data: values,
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Data'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Temperatura'
                        }
                    }
                }
            }
        };

        // Renderizar o gráfico
        var ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, chartConfig);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>