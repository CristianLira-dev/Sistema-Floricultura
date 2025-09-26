<?php
session_start();  // Inicia a sessão

$servername = "localhost:3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";

try {
    // Conectando ao banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pegando os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $peso = isset($_POST['peso']) ? $_POST['peso'] : "";
    $codigo_barras = isset($_POST['codigo']) ? $_POST['codigo'] : "";
    $preco_custo = isset($_POST['custo']) ? $_POST['custo'] : "";
    $preco_venda = isset($_POST['venda']) ? $_POST['venda'] : "";
    $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : "";
    $estoqueMax = isset($_POST['marca']) ? $_POST['etq_max'] : "";
    $marca = isset($_POST['marca']) ? $_POST['marca'] : "";
    $fornecedor = isset($_POST['fornecedor']) ? $_POST['fornecedor'] : "";
    $setor = isset($_POST['setor']) ? $_POST['setor'] : "";

	  $stmt = $conn->prepare("INSERT INTO produtos (descricao, peso, codigo_barras, preco_custo, preco_venda, estoque, estoqueMax, marca, fornecedor, setor)  
	  	                                   VALUES (:nome, :peso, :codigo_barras, :preco_custo, :preco_venda, :estoque, :estoqueMax, :marca, :fornecedor, :setor)"); //INSTRUÇÃO SQL

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':peso', $peso);
	  $stmt->bindParam(':codigo_barras', $codigo_barras);
	  $stmt->bindParam(':preco_custo', $preco_custo);                                    // REFERENCIAS PARA ENVIAR O CONTEÚDO DAS VARIÁVEIS PARA O INSERT
	  $stmt->bindParam(':preco_venda', $preco_venda);
	  $stmt->bindParam(':estoque', $estoque);
	  $stmt->bindParam(':estoqueMax', $estoqueMax);
	  $stmt->bindParam(':marca', $marca);
	  $stmt->bindParam(':fornecedor', $fornecedor);
	  $stmt->bindParam(':setor', $setor);

      
	  $stmt->execute();         

    // Se o código chegar aqui, significa que a inserção foi bem-sucedida
    $_SESSION['form_message'] = 'Cadastro realizado com sucesso!';
    $_SESSION['form_status'] = 'success';

    echo "dados cadastrados";
    
} catch (PDOException $e) {

    echo "erro ao cadastrar" . $e->getMessage();

    // Caso haja algum erro na execução da query
    $_SESSION['form_message'] = 'Erro ao cadastrar: ' . $e->getMessage();
    $_SESSION['form_status'] = 'error';
}

// Redireciona para a página do formulário
    header("location: http://localhost:8080/sistema/Sistemas/cadastro_produto.php");
    

// Fechar a conexão
$conn = null;
?>
