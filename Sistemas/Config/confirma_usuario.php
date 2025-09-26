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
    $funcao = $_POST['função'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // senha já criptografada em base64 pelo JS

    // Atualiza com senha incluída
    $stmt = $conn->prepare("UPDATE usuarios SET 
                              nome = :nome,
                              funcao = :funcao,
                              email = :email,
                              senha = :senha
                            WHERE codigo = :id");

    $stmt->execute([
        ':id' => $cod, 
        ':nome' => $nome,
        ':funcao' => $funcao,
        ':email' => $email,
        ':senha' => $senha
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
        <div class="modal fade" id="sucesso" tabindex="-1" aria-labelledby="sucessoLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success">
              <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="sucessoLabel">Sucesso!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <div class="modal-body text-center">
                <p class="fs-5">Cliente atualizado com sucesso!</p>
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let sucessoModal = new bootstrap.Modal(document.getElementById('sucesso'));
                sucessoModal.show();

                setTimeout(function() {
                    window.location.href = 'http://localhost:8080/sistema/Sistemas/consulta_usuario.php';
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
