<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "usbw";
$dbname = "floricultura_jardim";

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebe dados do formulário
    $cod   = $_POST['codigo'];
    $nome  = $_POST['nome'];
    $estado_civil = $_POST['estado_civil'];
    $cpf   = $_POST['cpf'];
    $cep   = $_POST['cep'];
    $num   = $_POST['numero'];
    $cel   = $_POST['celular'];
    $data_nascimento = $_POST['data_nascimento'];

    // Prepara a query
    $stmt = $conn->prepare("UPDATE funcionarios SET 
                              nome = :nome,
                              estado_civil = :estado_civil,
                              cpf = :cpf,
                              cep = :cep,
                              numero = :num,
                              celular = :cel,
                              data_nascimento = :data_nascimento
                            WHERE codigo = :id");

    // Executa a atualização
    $stmt->execute([
        ':id' => $cod,
        ':nome' => $nome,
        ':estado_civil' => $estado_civil,
        ':cpf' => $cpf,
        ':cep' => $cep,
        ':num' => $num,
        ':cel' => $cel,
        ':data_nascimento' => $data_nascimento
    ]);

    // Exibe modal de sucesso
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Atualização de Funcionário</title>
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
                <p class="fs-5">Funcionário atualizado com sucesso!</p>
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let modal = new bootstrap.Modal(document.getElementById('sucesso'));
                modal.show();

                // Redireciona após 3 segundos
                setTimeout(function () {
                    window.location.href = 'http://localhost:8080/sistema/Sistemas/consulta_funcionario.php';
                }, 3000);
            });
        </script>
    </body>
    </html>
    <?php

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
