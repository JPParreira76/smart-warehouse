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

</head>

<body>

    <div class="container">
        <div class="card boxes">
            <nav class="navbar navbar-expand-sm navegador">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="navbar-brand">
                            <p class="nav-item active"><button class="btn btn-outline-dark btn-lg" type="button"><a class="linkbig" href="dashboard.php">Smart Warehouse</a></button></p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="webcam.php">Webcam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="video.php">Video do Projeto</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="button">
                        <button class="btn btn-outline-dark" type="button"><a class="link" href="logout.php">Logout</a></button>
                    </form>
                </div>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="card boxes">
            <div class="card-body">
                <img class="float-end img-dashboard" src="./img/warehouse.png" alt="estg logo">
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
            <div class="card-header">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>