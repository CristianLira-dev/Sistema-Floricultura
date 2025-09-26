<?php 

$servername = "localhost:3307";

$username = "root";

$password = "usbw";

$dbname = "Floricultura_Jardim";

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE table usuarios(codigo int PRIMARY KEY AUTO_INCREMENT,
                                nome varchar(100) not null,
                                funcao varchar(20) not null,
                                senha varchar(20) not null,
                               email varchar(40) not null)";
                                

    $conn->exec($sql);

    echo"Conectado com sucesso";
}
catch(PDOException $e)
{
    echo"Falha na conexão. Erro : " . $e->getMessage();
}

$conn = null;



?>