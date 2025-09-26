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
    $razao = isset($_POST['razao']) ? $_POST['razao'] : "";
    $fantasia = isset($_POST['fantasia']) ? $_POST['fantasia'] : "";
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : "";
    $cep = isset($_POST['cep']) ? $_POST['cep'] : "";
    $numero = isset($_POST['numero']) ? $_POST['numero'] : "";
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";

	  $stmt = $conn->prepare("INSERT INTO fornecedores (razao_social, nome_fantasia, cnpj, cep, numero, celular, email)  
	  	                                   VALUES (:razao, :fantasia, :cnpj, :cep, :numero, :telefone, :email)"); //INSTRUÇÃO SQL

	  $stmt->bindParam(':razao', $razao);
	  $stmt->bindParam(':fantasia', $fantasia);
	  $stmt->bindParam(':cnpj', $cnpj);
	  $stmt->bindParam(':cep', $cep);                                    // REFERENCIAS PARA ENVIAR O CONTEÚDO DAS VARIÁVEIS PARA O INSERT
	  $stmt->bindParam(':numero', $numero);
	  $stmt->bindParam(':telefone', $telefone);
	  $stmt->bindParam(':email', $email);
	  
	  $stmt->execute();         


    // Se o código chegar aqui, significa que a inserção foi bem-sucedida
    $_SESSION['form_message'] = 'Cadastro realizado com sucesso!';
    $_SESSION['form_status'] = 'success';
    
} catch (PDOException $e) {

        echo "erro ao cadastrar" . $e->getMessage();

    // Caso haja algum erro na execução da query
    $_SESSION['form_message'] = 'Erro ao cadastrar: ' . $e->getMessage();
    $_SESSION['form_status'] = 'error';
}

// Redireciona para a página do formulário
   header("location: http://localhost:8080/sistema/Sistemas/cadastro_fornecedor.php");
    

// Fechar a conexão
$conn = null;
?>
