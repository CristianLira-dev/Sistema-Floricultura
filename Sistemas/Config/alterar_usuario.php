<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar - Floricultura Jardim</title>
  <script src="JS/cadastro.js" defer></script>
  <script src="JS/funcao.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<style>
  body {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  height: 100%;
  background-color: #fff5e6;
}

form {
  --input-focus: #8c1523;
  --font-color: #323232;
  --font-color-sub: #666;
  --bg-color: #fff5e6;
  --main-color: #8c1523;
  padding: 10px 30px;
  background: var(--bg-color);
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  margin-top: 10px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  width: 100%;
  max-width: 1036px;
}

.title {
  color: var(--font-color);
  font-weight: 900;
  font-size: 24px;
  text-align: center;
}

.title span {
  color: var(--font-color-sub);
  font-weight: 600;
  font-size: 18px;
}

.input-container {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.input,
.form-select {
  width: 100%;
  height: 50px;
  border-radius: 5px;
  border: 3px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 18px;
  font-weight: 600;
  color: var(--font-color);
  padding: 10px;
  outline: none;
  margin: 5px;
}

.input::placeholder {
  color: var(--font-color-sub);
  opacity: 0.8;
}

.input:focus,
.form-select:focus {
  border-color: var(--input-focus);
}

.btn-primary,
.btn-warning,
.btn-danger {
  color: #fff;
  font-weight: 600;
  font-size: 18px;
  border-radius: 5px;
  padding: 15px 30px;
  transition: background-color 0.3s ease;
  min-width: 120px;
}

.btn-primary {
  background-color: var(--main-color);
  border-color: var(--main-color);
}

.btn-primary:hover {
  background-color: #741220;
}

.btn-warning {
  background-color: #ffa500;
  border-color: #ffa500;
}

.btn-warning:hover {
  background-color: #e69500;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn-danger:hover {
  background-color: #c82333;
}

.input-container {
  width: 100%;
  margin-bottom: 16px;
}

.input {
  width: 100%;
  padding: 8px;
  border: solid 3px #8c1523;
  border-radius: 4px;
  box-sizing: border-box;
}

.form-select {
  width: 100%;
  padding: 8px;
  border: solid 2px #8c1523;
  border-radius: 4px;
  box-sizing: border-box;
  background-color: #fff5e6;
}

.d-flex .input-container {
  flex: 1;
}

.d-flex .btn-primary {
  margin-left: 8px;
}

#botao {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

#botao button {
  flex: 1;
  min-width: 120px;
}
.modal-button:hover {
  filter: brightness(130%);
}

@media (max-width: 768px) {
  #botao {
    flex-direction: row;
    gap: 10px; /* Espaçamento entre os botões */
  }

  #botao button {
    width: 100%;
    min-width: auto;
  }
}

@media (max-width: 768px) {
  body {
    overflow-y: auto;
  }

  .d-flex {
    flex-direction: column;
  }

  .d-flex .input-container,
  .d-flex .btn-primary {
    margin: 0;
  }

  .d-flex .gap-3 {
    gap: 10px;
  }

  /* Mantém o botão "Buscar" ao lado do input de CEP em telas menores */
  #cep,
  #buscar-cep {
    flex: initial;
    width: 100%;
    margin-bottom: 10px;
  }

  #buscar-cep {
    width: auto;
    margin-left: 0;
    margin-bottom: 0;
  }

  .d-flex.align-items-center.justify-content-center.gap-3 {
    flex-direction: column;
  }

  /* Reduzir o tamanho dos botões conforme a tela diminui */
  #botao button {
    padding: 10px;
    font-size: 16px;
  }
}

@media (max-width: 576px) {
  #botao button {
    padding: 8px 16px;
    font-size: 14px;
  }
}

@media (max-width: 400px) {
  #botao button {
    padding: 6px 12px;
    font-size: 12px;
  }
}

</style>

<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";

$cod = $_GET['codigo'];

try {
  $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $select = $conn->prepare("SELECT * FROM usuarios WHERE codigo = :codigo");
  $select->bindParam(':codigo', $cod, PDO::PARAM_INT);
  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
$SenhaScript = base64_decode($row['senha']);
?>


<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <form class="form" method="POST" action="confirma_usuario.php" id="formulario">
    <div class="title text-center">Alterar Usuário 🌹<br><span>Preencha os dados abaixo</span></div>

    <input class="input"  type="text" name="codigo" value="<?php echo $row['codigo'];?>" readonly>

    <input class="input" name="nome" placeholder="Nome Completo" id="nome" type="text" required value="<?php echo $row['nome'];?>">

    <div class="input-container">
      <input class="input" name="função" placeholder="função" id="função" type="text" required value="<?php echo $row['funcao'];?>">
    </div>

    <div class="input-container d-flex justify-content-center align-items-center">
      <input class="input" name="senha" placeholder="senha" id="senha" type="text" required value="<?= $SenhaScript; ?>">
      <input class="input" name="email" placeholder="E-mail" id="email" type="email" required value="<?= $row['email']; ?>">
    </div>

    <div class="text-center mt-3">
      <button type="submit"  class="btn btn-primary p-2">Atualizar</button>
      <button type="reset" class="btn btn-success" onclick="javascript: location.href='http://localhost:8080/sistema/Sistemas/consulta_usuario.php'">Voltar</button>
    </div>
  </form>
</div>

<script>
  document.getElementById("formulario").addEventListener("submit", function (e) {
    const senhaInput = document.getElementById("senha");
    const senha = senhaInput.value;

    // Codifica a senha para base64
    const senhaCriptografada = btoa(senha);
    
      senhaInput.value = senhaCriptografada;
    // Substitui o valor no input antes de enviar
  });
</script>


</body>
</html>
