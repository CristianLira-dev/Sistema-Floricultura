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
    $estado_civil = isset($_POST['estado-civil']) ? $_POST['estado-civil'] : "";
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
    $cep = isset($_POST['cep']) ? $_POST['cep'] : "";
    $numero = isset($_POST['numero']) ? $_POST['numero'] : "";
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
    $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";

	  $stmt = $conn->prepare("INSERT INTO funcionarios (nome, estado_civil, cpf, cep, numero, celular, data_nascimento)  
	  	                                   VALUES (:nome, :estado_civil, :cpf, :cep, :numero, :telefone, :data_nascimento)"); //INSTRUÇÃO SQL

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':estado_civil', $estado_civil);
	  $stmt->bindParam(':cpf', $cpf);
	  $stmt->bindParam(':cep', $cep);                                    // REFERENCIAS PARA ENVIAR O CONTEÚDO DAS VARIÁVEIS PARA O INSERT
	  $stmt->bindParam(':numero', $numero);
	  $stmt->bindParam(':telefone', $telefone);
	  $stmt->bindParam(':data_nascimento', $data_nascimento);

	  
	  $stmt->execute();         

    // Se o código chegar aqui, significa que a inserção foi bem-sucedida
    $_SESSION['form_message'] = 'Cadastro realizado com sucesso!';
    $_SESSION['form_status'] = 'success';

    echo "dados cadastrados";
    
} catch (PDOException $e) {
    echo "dados nao cadastrados" . $e->getMessage();
    // Caso haja algum erro na execução da query
    $_SESSION['form_message'] = 'Erro ao cadastrar: ' . $e->getMessage();
    $_SESSION['form_status'] = 'error';
}

// Redireciona para a página do formulário
header("location: http://localhost:8080/sistema/Sistemas/cadastro_funcionario.php");
    

// Fechar a conexão
$conn = null;
?>
