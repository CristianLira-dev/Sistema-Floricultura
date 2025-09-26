<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $cod = $_POST['codigo']; 
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $cep = $_POST['cep'];
    $num = $_POST['numero'];
    $email = $_POST['email'];
    $cel = $_POST['celular'];

    $stmt = $conn->prepare("UPDATE clientes SET 
                              nome = :nome,
                              cpf = :cpf,
                              rg = :rg,
                              cep = :cep,
                              numero = :num,
                              email = :email,
                              celular = :cel 
                            WHERE codigo = :id");

    $stmt->execute([
        ':id' => $cod, 
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':rg' => $rg,
        ':cep' => $cep,
        ':num' => $num,
        ':email' => $email,
        ':cel' => $cel
    ]);

    // Exibe modal de sucesso com redirecionamento
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
        <div class="modal fade" id="erro" tabindex="-1" aria-labelledby="erroLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success">
              <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="erroLabel">Sucesso!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <div class="modal-body text-center">
                <p id="modalMessage" class="fs-5">Cliente atualizado com sucesso!</p>
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let erro = new bootstrap.Modal(document.getElementById('erro'));
                erro.show();

                // Redireciona após 3 segundos
                setTimeout(function() {
                    window.location.href = 'http://localhost:8080/sistema/Sistemas/consulta_cliente.php';
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
