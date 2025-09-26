<?php 

$servername = "localhost:3307";

$username = "root";

$password = "usbw";

$dbname = "Floricultura_Jardim";

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE table fornecedores(codigo int PRIMARY KEY AUTO_INCREMENT,
                                razao_social varchar(100) not null,
                                nome_fantasia varchar(100) not null,
                                cnpj varchar(30) not null,
                                cep varchar(20) not null,
                                numero varchar(10) not null,
                                celular varchar(20) not null,
                               email varchar(50) not null)";
                                

    $conn->exec($sql);

    echo"Conectado com sucesso";
}
catch(PDOException $e)
{
    echo"Falha na conexão. Erro : " . $e->getMessage();
}

$conn = null;



?>