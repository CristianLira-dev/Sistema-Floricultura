<?php
$servername = "localhost:3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";

$cod = $_GET['codigo'];


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = $conn->prepare("DELETE FROM clientes WHERE codigo = :codigo");
$sql->bindParam(':codigo', $cod);
$sql->execute();


  echo "deu certo!";
  
 header('location: http://localhost:8080/sistema/Sistemas/consulta_cliente.php');
  
} catch(PDOException $e) {
  echo $sql . "
" . $e->getMessage();
}

$conn = null;
?>