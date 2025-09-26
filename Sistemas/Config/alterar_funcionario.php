<!-- alterar_funcionario.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Funcionário - Floricultura Jardim</title>
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
    .input, .form-select {
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
    .invalid-feedback {
      color: red;
      font-size: 14px;
      margin-top: -12px;
      margin-bottom: 8px;
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

  $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE codigo = :codigo");
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
?>

<form method="POST" action="confirma_funcionario.php">
  <div class="title">Alterar Funcionário 🌼</div>

  <input class="input" type="text" name="codigo" value="<?= $row['codigo']; ?>" readonly>

  <input class="input" type="text" name="nome" placeholder="Nome Completo" required value="<?= $row['nome']; ?>">

  <select class="form-select" name="estado_civil" required>
    <option value="">Estado Civil</option>
    <option value="Solteiro" <?= $row['estado_civil'] == 'Solteiro' ? 'selected' : '' ?>>Solteiro</option>
    <option value="Casado" <?= $row['estado_civil'] == 'Casado' ? 'selected' : '' ?>>Casado</option>
    <option value="Divorciado" <?= $row['estado_civil'] == 'Divorciado' ? 'selected' : '' ?>>Divorciado</option>
    <option value="Viúvo" <?= $row['estado_civil'] == 'Viúvo' ? 'selected' : '' ?>>Viúvo</option>
  </select>

  <input class="input" type="text" name="cpf" id="cpf" placeholder="CPF" required value="<?= $row['cpf']; ?>">
  <div id="mensagem-cpf" class="invalid-feedback"></div>

  <div class="d-flex gap-2">
    <input class="input" type="text" name="cep" id="cep" placeholder="CEP" required value="<?= $row['cep']; ?>">
    <button class="btn btn-secondary" type="button" id="buscar-cep">Buscar</button>
  </div>
  <div id="mensagem-cep" class="invalid-feedback"></div>

  <input class="input" type="text" name="numero" placeholder="Número" required value="<?= $row['numero']; ?>">

  <input class="input" type="text" name="celular" placeholder="Celular" required value="<?= $row['celular']; ?>">

  <input class="input" type="date" name="data_nascimento" id="data-nascimento" required value="<?= $row['data_nascimento']; ?>">
  <div id="mensagem-data" class="invalid-feedback"></div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-success" onclick="location.href='consulta_funcionarios.php'">Voltar</button>
  </div>
</form>

<script>document.querySelector("form").addEventListener("submit", function (e) {
  let formularioValido = true;

  // CPF
  const cpfInput = document.getElementById("cpf");
  if (!validarCPF(cpfInput.value)) {
    document.getElementById("mensagem-cpf").textContent = "CPF inválido!";
    cpfInput.classList.add("is-invalid");
    formularioValido = false;
  } else {
    document.getElementById("mensagem-cpf").textContent = "";
    cpfInput.classList.remove("is-invalid");
  }

  // CEP
  const cepInput = document.getElementById("cep");
  const rua = document.getElementById("rua").value;
  const bairro = document.getElementById("bairro").value;
  if (rua === "" || bairro === "") {
    document.getElementById("mensagem-cep").textContent = "CEP inválido ou não preenchido!";
    cepInput.classList.add("is-invalid");
    formularioValido = false;
  } else {
    document.getElementById("mensagem-cep").textContent = "";
    cepInput.classList.remove("is-invalid");
  }

  // Data de nascimento
  const dataInput = document.getElementById("data-nascimento");
  const dataNascimento = new Date(dataInput.value);
  const hoje = new Date();
  let idade = hoje.getFullYear() - dataNascimento.getFullYear();
  const mes = hoje.getMonth() - dataNascimento.getMonth();
  if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) idade--;
  if (idade < 18) {
    document.getElementById("mensagem-data").textContent = "Você precisa ter pelo menos 18 anos.";
    dataInput.classList.add("is-invalid");
    formularioValido = false;
  } else {
    document.getElementById("mensagem-data").textContent = "";
    dataInput.classList.remove("is-invalid");
  }

  if (!formularioValido) {
    e.preventDefault(); // Impede o envio do formulário
  }
});
</script>

</body>
</html>
