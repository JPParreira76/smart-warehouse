<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['imagem'])){
        $file = $_FILES['imagem'];
        $tempFile = $file['tmp_name'];

        // Diretório onde as imagens são armazenadas
        $directory = 'images/';

        // Obter a lista de arquivos no diretório
        $files = scandir($directory);
        $existingImages = count($files) - 2; // Exclui as entradas "." e ".."

        // Verifica se já existem 10 imagens no diretório
        if ($existingImages >= 10) {
            // Exclui a imagem mais antiga
            $oldestImage = $files[2]; // O primeiro arquivo é a entrada "."
            $oldestImagePath = $directory . $oldestImage;
            unlink($oldestImagePath);
        }

        // Gera um nome de arquivo único com base na data e hora atual
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = 'image_' . date('YmdHis') . '.' . $extension;
        $dest = $directory . $fileName;

        // Verifica o tamanho do arquivo
        if ($file['size'] <= 1000000) { // 1000kB (1MB)
            // Verifica a extensão do arquivo
            $allowedExtensions = array('jpeg', 'jpg', 'png');
            if (in_array($extension, $allowedExtensions)) {
                move_uploaded_file($tempFile, $dest);
                header('Location: /smart-warehouse/dashboard.php'); // Redireciona para dashboard.php
                exit;
            } else {
                echo "A extensão do arquivo não é permitida. Apenas arquivos JPG e PNG são aceitos.";
            }
        } else {
            echo "O tamanho do arquivo excede o limite permitido de 1000kB.";
        }
    } else {
        echo "Erro ao receber a imagem.";
    }
} else {
    echo "Mensagem de erro";
}
?>
