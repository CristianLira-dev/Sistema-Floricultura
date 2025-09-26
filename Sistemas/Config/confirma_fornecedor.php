<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebe dados do POST
    $cod = $_POST['codigo'];
    $razao = $_POST['razao_social'];
    $fantasia = $_POST['nome_fantasia'];
    $cnpj = $_POST['cnpj'];
    $cep = $_POST['cep'];
    $num = $_POST['numero'];
    $email = $_POST['email'];
    $cel = $_POST['celular'];

    // Prepara e executa o UPDATE
    $stmt = $conn->prepare("UPDATE fornecedores SET 
                              razao_social = :razao,
                              nome_fantasia = :fantasia,
                              cnpj = :cnpj,
                              cep = :cep,
                              numero = :num,
                              email = :email,
                              celular = :cel 
                            WHERE codigo = :id");

    $stmt->execute([
        ':id' => $cod,
        ':razao' => $razao,
        ':fantasia' => $fantasia,
        ':cnpj' => $cnpj,
        ':cep' => $cep,
        ':num' => $num,
        ':email' => $email,
        ':cel' => $cel
    ]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="sucesso" tabindex="-1" aria-labelledby="sucessoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="sucessoLabel">Sucesso!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body text-center">
            <p id="modalMessage" class="fs-5">Fornecedor atualizado com sucesso!</p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let sucesso = new bootstrap.Modal(document.getElementById('sucesso'));
            sucesso.show();

            // Redireciona após 3 segundos
            setTimeout(function() {
                window.location.href = 'http://localhost:8080/sistema/Sistemas/consulta_fornecedor.php';
            }, 3000);
        });
    </script>
</body>
</html>
<?php

} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
