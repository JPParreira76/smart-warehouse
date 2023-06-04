<?php
$nome = $_POST['nome'];
$value = $_POST['value'];

// Validate the value
if ($value === '0' || $value === '1' || $value === '2' || $value === '3') {
  // Define the file path
  $file = __DIR__ . '/files/' . $nome . '/valor.txt';

  // Write the value to the file
  file_put_contents($file, $value);
  
  http_response_code(200); // Return success status code
} else {
  http_response_code(400); // Return error status code
}
?>
