<?php
header('Content-Type: text/html; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Recebi um POST" . PHP_EOL;
    if (isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['hora'])) {
        $filePath = "files/" . $_POST['nome'] . "/";
        try {
            file_put_contents($filePath . "valor.txt", $_POST['valor']);
            file_put_contents($filePath . "hora.txt", $_POST['hora']);
            file_put_contents($filePath . "log.txt", $_POST['hora'] . ", " . $_POST['valor'] . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $th) {
            http_response_code(500); // erro ao escrever dados
            exit;
        }
        echo $_POST['nome'] . PHP_EOL;
        echo $_POST['hora'] . PHP_EOL;
        echo $_POST['valor'];
    } else {
        http_response_code(404);
        echo "Parametros incorretos no POST";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "Recebi um GET" . PHP_EOL;
    if (isset($_GET['nome'])) {
        $fileName = "files/" . $_GET['nome'] . "/valor.txt";
        if (!is_readable($fileName)) {
            http_response_code(404);
            echo "Sensor nao encontrado";
        } else {
            echo file_get_contents($fileName);
        }
    } else {
        echo http_response_code(400);
        echo "Faltam parametros ou sao incorretos no GET";
    }
} else {
    http_response_code(403);
    echo "Metodo nao permitido";
}
?>