<?php
session_start();

// Verificação de login
if (!isset($_SESSION["username"])) {
    header("refresh:0; url=index.php");
    die("Acesso restrito.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Warehouse - Webcam</title>
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
                <img class="float-end img-dashboard" src="./img/warehouse.png" alt="estg logo">
                <h1>Webcam</h1>
                <p class="welcome">Bem vindo <span class="username">
                        <?php echo $_SESSION["username"] ?>
                    </span></p>
                <p>Tecnologias de Internet - Engenharia Informática</p>
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