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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                        <img class="img-responsive" src="#" alt="temperatura">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_temperatura; ?> - <a href="history_temperatura.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <img class="img-responsive" src="#" alt="humidade">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_humidade; ?> - <a href="history_humidade.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <img class="img-responsive" src="#" alt="ar-condicionado">
                    </div>
                    <div class="card-footer text-center">
                        <b>Atualização:</b>
                        <?php echo $hora_ac; ?> - <a href="history_ac.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_luz; ?> - <a href="history_luz.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_distancia; ?> - <a href="history_distancia.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_fogo; ?> - <a href="history_fogo.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_iluminacao; ?> - <a href="history_iluminacao.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_portao; ?> - <a href="history_portao.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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
                        <?php echo $hora_alarme; ?> - <a href="history_alarme.php"><button type="button"
                                class="btn btn-outline-dark btn-sm">Histórico</button></a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</body>

</html>