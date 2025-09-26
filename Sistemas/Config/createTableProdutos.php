<?php 

$servername = "localhost:3307";

$username = "root";

$password = "usbw";

$dbname = "Floricultura_Jardim";

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE table produtos(codigo int PRIMARY KEY AUTO_INCREMENT,
                                descricao varchar(100) not null,
                                peso varchar(10) not null,
                                codigo_barras varchar(13) not null,
                                preco_custo varchar(10) not null,
                                preco_venda varchar(10) not null,
                                estoque varchar(20) not null,
                                estoqueMax varchar(20) not null,
                                marca varchar(20) not null,
                                fornecedor varchar(30) not null,
                               setor varchar(5) not null)";
                                

    $conn->exec($sql);

    echo"Conectado com sucesso";
}
catch(PDOException $e)
{
    echo"Falha na conexão. Erro : " . $e->getMessage();
}

$conn = null;



?>