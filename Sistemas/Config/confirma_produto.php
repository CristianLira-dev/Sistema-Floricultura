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
    $codigo        = $_POST['codigo'];
    $descricao     = $_POST['descricao'];
    $peso          = $_POST['peso'];
    $codigo_barras = $_POST['codigo_barras'];
    $preco_custo   = $_POST['preco_custo'];
    $preco_venda   = $_POST['preco_venda'];
    $estoque       = $_POST['estoque'];
    $estoqueMax    = $_POST['estoqueMax'];
    $marca         = $_POST['marca'];
    $fornecedor    = $_POST['fornecedor'];
    $setor         = $_POST['setor'];

    // Prepara a query
    $stmt = $conn->prepare("UPDATE produtos SET 
        descricao = :descricao,
        peso = :peso,
        codigo_barras = :codigo_barras,
        preco_custo = :preco_custo,
        preco_venda = :preco_venda,
        estoque = :estoque,
        estoqueMax = :estoqueMax,
        marca = :marca,
        fornecedor = :fornecedor,
        setor = :setor
        WHERE codigo = :codigo");

    // Executa a atualização
    $stmt->execute([
        ':codigo'        => $codigo,
        ':descricao'     => $descricao,
        ':peso'          => $peso,
        ':codigo_barras' => $codigo_barras,
        ':preco_custo'   => $preco_custo,
        ':preco_venda'   => $preco_venda,
        ':estoque'       => $estoque,
        ':estoqueMax'    => $estoqueMax,
        ':marca'         => $marca,
        ':fornecedor'    => $fornecedor,
        ':setor'         => $setor
    ]);

    // Exibe modal de sucesso
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Atualização de Produto</title>
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
                <p class="fs-5">Produto atualizado com sucesso!</p>
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
                    window.location.href = 'http://localhost:8080/sistema/Sistemas/consulta_produto.php';
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
