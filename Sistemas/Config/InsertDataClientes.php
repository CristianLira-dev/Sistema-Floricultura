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
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
    $rg = isset($_POST['rg']) ? $_POST['rg'] : "";
    $cep = isset($_POST['cep']) ? $_POST['cep'] : "";
    $numero = isset($_POST['numero']) ? $_POST['numero'] : "";
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";

	  $stmt = $conn->prepare("INSERT INTO clientes (nome, cpf, rg, cep, numero, celular, email)  
	  	                                   VALUES (:nome, :cpf, :rg, :cep, :numero, :telefone, :email)"); //INSTRUÇÃO SQL

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':cpf', $cpf);
	  $stmt->bindParam(':rg', $rg);
	  $stmt->bindParam(':cep', $cep);                                    // REFERENCIAS PARA ENVIAR O CONTEÚDO DAS VARIÁVEIS PARA O INSERT
	  $stmt->bindParam(':numero', $numero);
	  $stmt->bindParam(':telefone', $telefone);
	  $stmt->bindParam(':email', $email);
	  
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
      header("location: http://localhost:8080/sistema/Sistemas/cadastro_cliente.php");
    

// Fechar a conexão
$conn = null;
?>
