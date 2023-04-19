<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { // atribui username e password as devidas variaveis em caso de POST
    $username = $_POST["username"];
    $password = $_POST["password"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Warehouse - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <form class="login-form" method="post">
                <a href="index.php"><img class="login-img" src="./img/login_logo.png" alt="estg logo"></a>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" placeholder="Insira aqui o seu username" type="text" class="form-control"
                        id="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" placeholder="Insira aqui a sua Password" type="password" class="form-control"
                        id="password" required>
                </div>
                <div>
                    <?php
                    //verifica se existem parametros de login
                    if (isset($_POST['password']) && isset($_POST['username'])) {
                        // validação do login
                        if ($_POST["username"] == $_SESSION["username_1"] && password_verify($_POST["password"], $_SESSION["hash_1"]) || $_POST["username"] == $_SESSION["username_2"] && password_verify($_POST["password"], $_SESSION["hash_2"]) || $_POST["username"] == $_SESSION["username_3"] && password_verify($_POST["password"], $_SESSION["hash_3"])) {
                            // login validado
                            $_SESSION["username"] = $_POST["username"];
                            header("refresh:1; url=dashboard.php");
                            echo "<p>Password correta!</p>";
                        } elseif (isset($_POST["username"])) {
                            // login não validado
                            echo "<p>Credenciais inválidas!</p>";
                        }
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>