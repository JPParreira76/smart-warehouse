<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("refresh:0; url=index.php");
    die("Acesso restrito.");
}
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
        <nav class="navbar navbar-expand-sm navegador">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="navbar-brand">
                        <a href="dashboard.php">
                            <p class="nav-item active"><button class="btn btn-outline-dark btn-lg" type="button">Smart
                                    Warehouse</button></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Webcam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Video do Projeto</a>
                    </li>
                </ul>
                <form class="d-flex" role="logout">
                    <a href="logout.php"><button class="btn btn-outline-dark" type="button">Logout</button></a>
                </form>
            </div>
        </nav>
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
                    <div class="card-header sensor text-center">
                        <b>Temperatura:
                            <?php echo $valor_temperatura; ?>°
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-snow" viewBox="0 0 16 16">
                            <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5z" />
                            <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-half" viewBox="0 0 16 16">
                            <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z" />
                            <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-thermometer-sun" viewBox="0 0 16 16">
                            <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V2.5a.5.5 0 0 1 1 0v8.585A1.5 1.5 0 0 1 5 12.5z" />
                            <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5zm4.243 1.757a.5.5 0 0 1 0 .707l-.707.708a.5.5 0 1 1-.708-.708l.708-.707a.5.5 0 0 1 .707 0zM8 5.5a.5.5 0 0 1 .5-.5 3 3 0 1 1 0 6 .5.5 0 0 1 0-1 2 2 0 0 0 0-4 .5.5 0 0 1-.5-.5zM12.5 8a.5.5 0 0 1 .5-.5h1a.5.5 0 1 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1.172 2.828a.5.5 0 0 1 .708 0l.707.708a.5.5 0 0 1-.707.707l-.708-.707a.5.5 0 0 1 0-.708zM8.5 12a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5z" />
                        </svg>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_temperatura; ?> - <a href="history_temperatura.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header sensor text-center">
                        <b>Humidade:
                            <?php echo $valor_humidade; ?>%
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet-half" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                            <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25%" height="auto" fill="currentColor" class="bi bi-droplet-fill" viewBox="0 0 16 16">
                            <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z" />
                        </svg>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_humidade; ?> - <a href="history_humidade.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header sensor text-center">
                        <b>Ar Condicionado:
                            <?php echo $valor_ac; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wind" viewBox="0 0 16 16">
                            <path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_ac; ?> - <a href="history_ac.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header sensor text-center">
                        <b>Luz Natural:
                            <?php echo $valor_luz; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="luz-natural">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_luz; ?> - <a href="history_luz.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header sensor text-center">
                        <b>Distância ao Portão:
                            <?php echo $valor_distancia; ?> metros
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="distancia">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_distancia; ?> - <a href="history_distancia.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header atuador text-center">
                        <b>Incêndio:
                            <?php echo $valor_fogo; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="incendio">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_fogo; ?> - <a href="history_fogo.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header atuador text-center">
                        <b>Iluminação:
                            <?php echo $valor_iluminacao; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="iluminacao">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_iluminacao; ?> - <a href="history_iluminacao.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header atuador text-center">
                        <b>Portão:
                            <?php echo $valor_portao; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="portao">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_portao; ?> - <a href="history_portao.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 boxes">
                <div class="card">
                    <div class="card-header sensor text-center">
                        <b>Alarme:
                            <?php echo $valor_alarme; ?>
                        </b>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-responsive" src="#" alt="alarme">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_alarme; ?> - <a href="history_alarme.php"><button type="button" class="btn btn-outline-dark btn-sm">Histórico</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <td><span class="badge rounded-pill text-bg-success">Normal</span></td>
                        </tr>
                        <tr>
                            <td>Humidade</td>
                            <td>
                                <?php echo $valor_humidade; ?>%
                            </td>
                            <td>
                                <?php echo $hora_humidade; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-danger">Elevada</span></td>
                        </tr>
                        <tr>
                            <td>Ar Condicionado</td>
                            <td>
                                <?php echo $valor_ac; ?>
                            </td>
                            <td>
                                <?php echo $hora_ac; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Desligado</span></td>
                        </tr>
                        <tr>
                            <td>Luz Natural</td>
                            <td>
                                <?php echo $valor_luz; ?>
                            </td>
                            <td>
                                <?php echo $hora_luz; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Boa</span></td>
                        </tr>
                        <tr>
                            <td>Iluminação</td>
                            <td>
                                <?php echo $valor_iluminacao; ?>
                            </td>
                            <td>
                                <?php echo $hora_iluminacao; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Desligada</span></td>
                        </tr>
                        <tr>
                            <td>Incêndio</td>
                            <td>
                                <?php echo $valor_fogo; ?>
                            </td>
                            <td>
                                <?php echo $hora_fogo; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Normal</span></td>
                        </tr>
                        <tr>
                            <td>Alarme Incêndio</td>
                            <td>
                                <?php echo $valor_alarme; ?>
                            </td>
                            <td>
                                <?php echo $hora_alarme; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Desligado</span></td>
                        </tr>
                        <tr>
                            <td>Distância ao Portão</td>
                            <td>
                                <?php echo $valor_distancia; ?> metros
                            </td>
                            <td>
                                <?php echo $hora_temperatura; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Longe</span></td>
                        </tr>
                        <tr>
                            <td>Estado do Portão</td>
                            <td>
                                <?php echo $valor_portao; ?>
                            </td>
                            <td>
                                <?php echo $hora_portao; ?>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Fechado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <a class="link" href="#Top">
            <p>Top</p>
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>