<!-- alterar_produto.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Produto - Floricultura Jardim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fff5e6;
    }
    form {
      background: #fff5e6;
      border: 2px solid #8c1523;
      box-shadow: 4px 4px #8c1523;
      padding: 30px;
      margin-top: 20px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      border-radius: 8px;
    }
    .title {
      color: #323232;
      font-weight: 900;
      font-size: 24px;
      text-align: center;
    }
    .input {
      width: 100%;
      padding: 10px;
      border: 3px solid #8c1523;
      border-radius: 5px;
      background-color: #fff5e6;
      box-shadow: 4px 4px #8c1523;
      font-size: 18px;
      margin-bottom: 16px;
    }
    .btn-primary {
      background-color: #8c1523;
      border-color: #8c1523;
      padding: 10px 20px;
      font-size: 16px;
    }
    .btn-success {
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
</head>
<body>

<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "usbw";
$dbname = "floricultura_jardim";

$codigo = $_GET['codigo'];

try {
  $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM produtos WHERE codigo = :codigo");
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
?>

<form method="POST" action="confirma_produto.php">
  <div class="title">Alterar Produto 🌿</div>


  <input class="input"  type="text" name="codigo" value="<?php echo $row['codigo'];?>" readonly>

  <input class="input" type="text" name="descricao" placeholder="Descrição" required value="<?= $row['descricao']; ?>">


<div class="input-container">
<input class="input" type="text" name="peso" placeholder="Peso" required value="<?= $row['peso']; ?>">
  <div id="mensagem-cpf" class="text-danger mt-1"></div>
</div>

<div class="input-container">
<input class="input" type="text" name="codigo_barras" placeholder="Código de Barras" required value="<?= $row['codigo_barras']; ?>">
  <div id="mensagem-rg" class="text-danger mt-1"></div>
</div>


<div class="input-container d-flex justify-content-center align-items-center gap-2">
<input class="input" type="text"  name="preco_custo" placeholder="Preço de Custo" required value="<?= $row['preco_custo']; ?>">
<input class="input" type="text"  name="preco_venda" placeholder="Preço de Venda" required value="<?= $row['preco_venda']; ?>">
</div>

<div class="input-container d-flex justify-content-center align-items-center gap-2">
<input class="input" type="number" name="estoque" placeholder="Estoque Atual" required value="<?= $row['estoque']; ?>">
<input class="input" type="number" name="estoqueMax" placeholder="Estoque Máximo" required value="<?= $row['estoqueMax']; ?>">
</div>


<div class="input-container d-flex justify-content-center align-items-center">
<input class="input" type="text" name="marca" placeholder="Marca" required value="<?= $row['marca']; ?>">
</div>


<div class="input-container d-flex justify-content-center align-items-center gap-2">
<input class="input" type="text" name="fornecedor" placeholder="Fornecedor" required value="<?= $row['fornecedor']; ?>">
<input class="input" type="text" name="setor" placeholder="Setor" required value="<?= $row['setor']; ?>">
</div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-success" onclick="location.href='consulta_produtos.php'">Voltar</button>
  </div>
</form>

</body>
</html>
