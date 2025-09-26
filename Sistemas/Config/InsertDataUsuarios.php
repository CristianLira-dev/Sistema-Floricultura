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
    $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";


    $senhacrip = base64_encode($senha);

	  $stmt = $conn->prepare("INSERT INTO Usuarios (nome, funcao, senha, email)  
	  	                                   VALUES (:nome, :funcao, :senha, :email)"); //INSTRUÇÃO SQL

	  $stmt->bindParam(':nome', $nome);
	  $stmt->bindParam(':funcao', $funcao);
	  $stmt->bindParam(':email', $email);
	  $stmt->bindParam(':senha', $senhacrip);                                    // REFERENCIAS PARA ENVIAR O CONTEÚDO DAS VARIÁVEIS PARA O INSERT

      
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
   header("location: http://localhost:8080/sistema/Sistemas/cadastro_usuario.php");
    

// Fechar a conexão
$conn = null;
?>
