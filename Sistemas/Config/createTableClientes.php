<?php 
$servername = "localhost:3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";
try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE table clientes(codigo int PRIMARY KEY AUTO_INCREMENT,
                                nome varchar(100) not null,
                                cpf varchar(20) not null,
                                rg varchar(20) not null,
                                cep varchar(20) not null,
                                numero varchar(10) not null,
                                celular varchar(20) not null,
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