<?php
header('Content-Type: text/html; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['imagem'])){
        print_r($_FILES['imagem']);
        $tempFile = $_FILES['imagem']['tmp_name'];
        $dest = 'images/webcam.jpg';
        move_uploaded_file($tempFile, $dest);
    } else {
        echo "Erro";
    }
} else {
    echo "Mensagem de erro";        
}

?>