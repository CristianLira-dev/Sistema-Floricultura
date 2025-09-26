<?php 

$servername = "localhost:3307";

$username = "root";

$password = "usbw";

$dbname = "Floricultura_Jardim";


try 
{
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE Floricultura_Jardim";

    $conn->exec($sql);

    echo"Conectado com sucesso";
}
catch(PDOException $e)
{
    echo"Falha na conexão. Erro : " . $e->getMessage();
}

$conn = null;



?>