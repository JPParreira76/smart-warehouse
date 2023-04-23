<?php
session_start();

// Verificação de login
if (!isset($_SESSION["username"])) {
    header("refresh:0; url=index.php");
    die("Acesso restrito.");
}

// Valores do API em variáveis
$valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
$hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");
$valor_luz = file_get_contents("api/files/luz/valor.txt");
$hora_luz = file_get_contents("api/files/luz/hora.txt");
$nome_luz = file_get_contents("api/files/luz/nome.txt");
$valor_fogo = file_get_contents("api/files/fogo/valor.txt");
$hora_fogo = file_get_contents("api/files/fogo/hora.txt");
$nome_fogo = file_get_contents("api/files/fogo/nome.txt");
$valor_ac = file_get_contents("api/files/ac/valor.txt");
$hora_ac = file_get_contents("api/files/ac/hora.txt");
$nome_ac = file_get_contents("api/files/ac/nome.txt");
$valor_alarme = file_get_contents("api/files/alarme/valor.txt");
$hora_alarme = file_get_contents("api/files/alarme/hora.txt");
$nome_alarme = file_get_contents("api/files/alarme/nome.txt");
$valor_iluminacao = file_get_contents("api/files/iluminacao/valor.txt");
$hora_iluminacao = file_get_contents("api/files/iluminacao/hora.txt");
$nome_iluminacao = file_get_contents("api/files/iluminacao/nome.txt");
$valor_humidade = file_get_contents("api/files/humidade/valor.txt");
$hora_humidade = file_get_contents("api/files/humidade/hora.txt");
$nome_humidade = file_get_contents("api/files/humidade/nome.txt");
$valor_distancia = file_get_contents("api/files/distancia/valor.txt");
$hora_distancia = file_get_contents("api/files/distancia/hora.txt");
$nome_distancia = file_get_contents("api/files/distancia/nome.txt");
$valor_portao = file_get_contents("api/files/portao/valor.txt");
$hora_portao = file_get_contents("api/files/portao/hora.txt");
$nome_portao = file_get_contents("api/files/portao/nome.txt");

if ($valor_luz == 0) {
    $string_luz = "Fraca";
} else {
    $string_luz = "Boa";
}

if ($valor_fogo == 0) {
    $string_fogo = "Sem Incêndio";
} else {
    $string_fogo = "Incêndio";
}

if ($valor_ac == 0) {
    $string_ac = "Desligado";
} else {
    $string_ac = "Ligado";
}

if ($valor_alarme == 0) {
    $string_alarme = "Desligado";
} else {
    $string_alarme = "Ligado";
}

if ($valor_iluminacao == 0) {
    $string_iluminacao = "Desligada";
} else {
    $string_iluminacao = "Ligada";
}

if ($valor_portao == 0) {
    $string_portao = "Fechado";
} else {
    $string_portao = "Aberto";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Warehouse - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

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
                <h1>Dashboard</h1>
                <p class="welcome">Bem vindo <span class="username">
                        <?php echo $_SESSION["username"] ?>
                    </span></p>
                <p>Tecnologias de Internet - Engenharia Informática</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Temperatura:
                            <?php echo $valor_temperatura; ?>°
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_temperatura <= 10) {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-snow" viewBox="0 0 16 16">
                            <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5z" />
                            <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5z" />
                        </svg>';
                        } elseif ($valor_temperatura > 10 && $valor_temperatura < 20) {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-half" viewBox="0 0 16 16">
                            <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 2 1.415z" />
                            <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
                            </svg>';
                        } elseif ($valor_temperatura >= 20) {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-sun" viewBox="0 0 16 16">
                            <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V2.5a.5.5 0 0 1 1 0v8.585A1.5 1.5 0 0 1 5 12.5z" />
                            <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5zm4.243 1.757a.5.5 0 0 1 0 .707l-.707.708a.5.5 0 1 1-.708-.708l.708-.707a.5.5 0 0 1 .707 0zM8 5.5a.5.5 0 0 1 .5-.5 3 3 0 1 1 0 6 .5.5 0 0 1 0-1 2 2 0 0 0 0-4 .5.5 0 0 1-.5-.5zM12.5 8a.5.5 0 0 1 .5-.5h1a.5.5 0 1 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1.172 2.828a.5.5 0 0 1 .708 0l.707.708a.5.5 0 0 1-.707.707l-.708-.707a.5.5 0 0 1 0-.708zM8.5 12a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_temperatura; ?> - <a href="history_temperatura.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Humidade:
                            <?php echo $valor_humidade; ?>%
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_humidade <= 30) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                        </svg>';
                        } elseif ($valor_humidade > 30 && $valor_humidade < 60) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet-half" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                        </svg>';
                        } elseif ($valor_humidade >= 60) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet-fill" viewBox="0 0 16 16">
                            <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_humidade; ?> - <a href="history_humidade.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Ar Condicionado:
                            <?php echo $string_ac; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_ac == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                        </svg>';
                        } elseif ($valor_ac == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-wind" viewBox="0 0 16 16">
                            <path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_ac; ?> - <a href="history_ac.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Luz Natural:
                            <?php echo $string_luz; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_luz == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-moon-stars" viewBox="0 0 16 16">
                            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z" />
                            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
                        </svg>';
                        } elseif ($valor_luz == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_luz; ?> - <a href="history_luz.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Distância ao Portão:
                            <?php echo $valor_distancia; ?> metros
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_distancia > 5) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-sign-no-parking" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16Zm5.29-3.416L9.63 8.923C10.5 8.523 11 7.66 11 6.586c0-1.482-.955-2.584-2.538-2.584H5.5v.79L3.416 2.71a7 7 0 0 1 9.874 9.874Zm-.706.707A7 7 0 0 1 2.71 3.417l2.79 2.79V12h1.283V9.164h1.674l4.127 4.127ZM8.726 8.019 6.777 6.07v-.966H8.27c.893 0 1.419.539 1.419 1.482 0 .769-.35 1.273-.963 1.433Zm-1.949-.534.59.59h-.59v-.59Z" />
                        </svg>';
                        } elseif ($valor_distancia <= 5) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_distancia; ?> - <a href="history_distancia.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Incêndio:
                            <?php echo $string_fogo; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_fogo == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                        </svg>';
                        } elseif ($valor_fogo == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                            <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_fogo; ?> - <a href="history_fogo.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Iluminação:
                            <?php echo $string_iluminacao; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_iluminacao == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-lightbulb-off" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.23 4.35A6.004 6.004 0 0 0 2 6c0 1.691.7 3.22 1.826 4.31.203.196.359.4.453.619l.762 1.769A.5.5 0 0 0 5.5 13a.5.5 0 0 0 0 1 .5.5 0 0 0 0 1l.224.447a1 1 0 0 0 .894.553h2.764a1 1 0 0 0 .894-.553L10.5 15a.5.5 0 0 0 0-1 .5.5 0 0 0 0-1 .5.5 0 0 0 .288-.091L9.878 12H5.83l-.632-1.467a2.954 2.954 0 0 0-.676-.941 4.984 4.984 0 0 1-1.455-4.405l-.837-.836zm1.588-2.653.708.707a5 5 0 0 1 7.07 7.07l.707.707a6 6 0 0 0-8.484-8.484zm-2.172-.051a.5.5 0 0 1 .708 0l12 12a.5.5 0 0 1-.708.708l-12-12a.5.5 0 0 1 0-.708z" />
                        </svg>';
                        } elseif ($valor_iluminacao == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16">
                            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_iluminacao; ?> - <a href="history_iluminacao.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Portão:
                            <?php echo $string_portao; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_portao == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                            <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z" />
                            <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z" />
                        </svg>';
                        } elseif ($valor_portao == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_portao; ?> - <a href="history_portao.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Alarme:
                            <?php echo $string_alarme; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Dynamic SVG
                        if ($valor_alarme == 0) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-bell-slash" viewBox="0 0 16 16">
                            <path d="M5.164 14H15c-.299-.199-.557-.553-.78-1-.9-1.8-1.22-5.12-1.22-6 0-.264-.02-.523-.06-.776l-.938.938c.02.708.157 2.154.457 3.58.161.767.377 1.566.663 2.258H6.164l-1 1zm5.581-9.91a3.986 3.986 0 0 0-1.948-1.01L8 2.917l-.797.161A4.002 4.002 0 0 0 4 7c0 .628-.134 2.197-.459 3.742-.05.238-.105.479-.166.718l-1.653 1.653c.02-.037.04-.074.059-.113C2.679 11.2 3 7.88 3 7c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0c.942.19 1.788.645 2.457 1.284l-.707.707zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z" />
                        </svg>';
                        } elseif ($valor_alarme == 1) {
                            echo
                            '<svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_alarme; ?> - <a href="history_alarme.php" role="button" class="btn btn-outline-dark btn-sm">Histórico</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- force start button to be implemented -->
    <div class="container">
        <div class="card boxes">
            <div class="card-header">
                <b>Tabela de Sensores e Estado de Atuadores</b>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Dispositivo IoT</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Atualização</th>
                            <th scope="col">Estado Alertas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Temperatura</td>
                            <td>
                                <?php echo $valor_temperatura; ?>°
                            </td>
                            <td>
                                <?php echo $hora_temperatura; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_temperatura <= 10) {
                                    echo '<span class="badge rounded-pill text-bg-primary">Baixa</span>';
                                } elseif ($valor_temperatura > 10 && $valor_temperatura < 20) {
                                    echo '<span class="badge rounded-pill text-bg-success">Normal</span>';
                                } elseif ($valor_temperatura >= 20) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Elevada</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Humidade</td>
                            <td>
                                <?php echo $valor_humidade; ?>%
                            </td>
                            <td>
                                <?php echo $hora_humidade; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_humidade <= 30) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Baixa</span>';
                                } elseif ($valor_humidade > 30 && $valor_humidade < 60) {
                                    echo '<span class="badge rounded-pill text-bg-success">Normal</span>';
                                } elseif ($valor_humidade >= 60) {
                                    echo '<span class="badge rounded-pill text-bg-primary">Elevada</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ar Condicionado</td>
                            <td>
                                <?php echo $string_ac; ?>
                            </td>
                            <td>
                                <?php echo $hora_ac; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_ac == 0) {
                                    echo '<span class="badge rounded-pill text-bg-success">Desligado</span>';
                                } elseif ($valor_ac == 1) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Ligado</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Luz Natural</td>
                            <td>
                                <?php echo $string_luz; ?>
                            </td>
                            <td>
                                <?php echo $hora_luz; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_luz == 0) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Fraca</span>';
                                } elseif ($valor_luz == 1) {
                                    echo '<span class="badge rounded-pill text-bg-success">Boa</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Iluminação</td>
                            <td>
                                <?php echo $string_iluminacao; ?>
                            </td>
                            <td>
                                <?php echo $hora_iluminacao; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_iluminacao == 0) {
                                    echo '<span class="badge rounded-pill text-bg-success">Desligada</span>';
                                } elseif ($valor_iluminacao == 1) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Ligada</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Incêndio</td>
                            <td>
                                <?php echo $string_fogo; ?>
                            </td>
                            <td>
                                <?php echo $hora_fogo; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_fogo == 0) {
                                    echo '<span class="badge rounded-pill text-bg-success">Sem Incêndio</span>';
                                } elseif ($valor_fogo == 1) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Incêndio</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alarme Incêndio</td>
                            <td>
                                <?php echo $string_alarme; ?>
                            </td>
                            <td>
                                <?php echo $hora_alarme; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_alarme == 0) {
                                    echo '<span class="badge rounded-pill text-bg-success">Desligado</span>';
                                } elseif ($valor_alarme == 1) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Ligado</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Distância ao Portão</td>
                            <td>
                                <?php echo $valor_distancia; ?> metros
                            </td>
                            <td>
                                <?php echo $hora_temperatura; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_distancia > 5) {
                                    echo '<span class="badge rounded-pill text-bg-success">Longe</span>';
                                } elseif ($valor_distancia <= 5) {
                                    echo '<span class="badge rounded-pill text-bg-success">Perto</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Estado do Portão</td>
                            <td>
                                <?php echo $string_portao; ?>
                            </td>
                            <td>
                                <?php echo $hora_portao; ?>
                            </td>
                            <td>
                                <?php
                                if ($valor_portao == 0) {
                                    echo '<span class="badge rounded-pill text-bg-success">Fechado</span>';
                                } elseif ($valor_portao == 1) {
                                    echo '<span class="badge rounded-pill text-bg-danger">Aberto</span>';
                                }
                                ?>
                            </td>
                        </tr>
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

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>