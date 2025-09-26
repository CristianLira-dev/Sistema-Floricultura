<?php
session_start();


    // Verifica se o login está definido e se é um dos níveis permitidos
    if (!isset($_SESSION['login']) || !in_array($_SESSION['login'], ['Super Admin', 'Admin', 'Usuário'])) {
        echo "
        <!doctype html>
        <html lang='pt-br'>
          <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Redirecionando...</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
          </head>
          <body>
            <div class='container' style='color:#8C1523; display: grid;  place-items: center; margin-top: 300px'>
              <h1 class='text-danger'>
                <strong>Você não tem permissão para isso. Redirecionando em <span id='countdown'>5</span> segundos...</strong>
              </h1>
              <div class='spinner-border text-danger mt-1' style='width: 6rem; height: 6rem;border-width: 0.6em;'  id='spinner' role='status'>
                <span class='visually-hidden'>Carregando...</span>
              </div>
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                let seconds = 5;
                const countdownElement = document.getElementById('countdown');
                const interval = setInterval(() => {
                    seconds--;
                    countdownElement.textContent = seconds;
                    if (seconds <= 0) {
                        clearInterval(interval);
                        window.location.href = 'index.php';
                    }
                }, 1000);
              });
            </script>
          </body>
        </html>";
        exit;
    } else {
      //pass
    }
?>
<script>
// Captura o valor da variável PHP e armazena no localStorage
const funcao = <?php echo json_encode($_SESSION['login']); ?>;

// Armazena o valor no localStorage
localStorage.setItem('login', funcao);
</script>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Floricultura Jardim  | Consulta Funcionários</title>
    <link rel="stylesheet" type="text/css" href="CSS/menu.css?v=1.0">
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>


  </head>
<body>

<style>
.modal-button:hover {
  filter: brightness(130%);
}
.button {
  color: #fafafa;
  background-color: #8C1523;
  padding: 5px;
  border: none;
  border-radius: 10px;
  text-decoration: none;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  transition: transform 0.1s ease, box-shadow 0.1s ease;
  cursor: pointer;
}
.button:active {
  transform: scale(0.96);
  box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 10px;
}
</style>

    <!-- Inserção do VLibras -->
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>

<!-- Modal para erros -->
<div class="modal fade" id="erro" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Erro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-danger" id="modalMessage">
        Nenhum cliente encontrado ou campo de busca vazio!
      </div>
      <div class="modal-footer">
        <button type="button" class="modal-button" style="background-color:#8C1523; color:white; border: none; padding: 10px; border-radius: 5px;" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

    <header>
      <a href="menu.php">
        <img src="IMG/floricultura-logo.png" alt="Floricultura Jardim" width="150" height="auto">
      </a>
    
      <div>
        <h5 class="text-light">Consulta Funcionários</h5>
      </div>

      <h3 style="border: solid 1px white; border-radius: 10px;" id="cargo" class="text-light p-2 mt-1"></h3>


      <form class="d-flex" method="POST" action="#" role="search">
        <input class="form-control me-2" type="search" style=" outline: none;box-shadow: none;" name="buscar" placeholder="digite..." aria-label="Search" value="<?php echo isset($_POST['buscar']) ? htmlspecialchars($_POST['buscar']) : ''; ?>">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
    </form>

      <div class="d-flex align-items-center">
        <a href="sair.php" style="color: white;text-decoration: none;">
          <h6>Sair</h6>
        </a>
        <img src="IMG/foto-perfil.png" alt="foto do usuário" width="70px" height="auto">
      </div>
    </header>
<?php
$servername = "localhost:3307";
$username = "root";
$password = "usbw";
$dbname = "Floricultura_Jardim";


function destacar($texto, $busca) {
    $texto = htmlspecialchars($texto);
    if (!empty($busca)) {
        $busca = preg_quote($busca, '/');
        return preg_replace("/($busca)/i", '<b style="color:#8c1523;">$1</b>', $texto);
    }
    return $texto;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
$buscar = isset($_POST['buscar']) ? trim($_POST['buscar']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $buscar == "") {
    echo "<script>window.onload = () => { new bootstrap.Modal(document.getElementById('erro')).show(); }</script>";
}

 if (!empty($buscar)) {
    $sql = "SELECT * FROM funcionarios WHERE 
      codigo LIKE :busca OR 
      nome LIKE :busca OR 
      estado_civil LIKE :busca OR 
      cpf LIKE :busca OR 
      cep LIKE :busca OR 
      numero LIKE :busca OR 
      celular LIKE :busca OR 
      data_nascimento LIKE :busca";
    
    $select = $conn->prepare($sql);
    $param = "%$buscar%";
    $select->bindParam(':busca', $param);
    $select->execute();
  } else {
    $select = $conn->prepare("SELECT * FROM funcionarios");
    $select->execute();
  }

  $resultados = $select->rowCount();

  if ($resultados > 0) {
    while($row = $select->fetch()) {
      echo "<p style='margin-left: 20px;'>";
      echo "<br><b>Codigo: </b>" . destacar($row['codigo'], $buscar);
      echo "<br><b>Nome: </b>" . destacar($row['nome'], $buscar);
      echo "<br><b>Estado Cívil: </b>" . destacar($row['estado_civil'], $buscar);
      echo "<br><b>CPF: </b>" . destacar($row['cpf'], $buscar);
      echo "<br><b>CEP: </b>" . destacar($row['cep'], $buscar);
      echo "<br><b>Numero: </b>" . destacar($row['numero'], $buscar);
      echo "<br><b>Celular: </b>" . destacar($row['celular'], $buscar);
      echo "<br><b>Data de Nascimento: </b>" . destacar($row['data_nascimento'], $buscar);
      echo "<div style='display:flex; margin-left: 10px; gap: 5px;'>";
      echo "<br><br><a class='button' href='config/alterar_funcionario.php?codigo=" . urlencode($row['codigo']) . "'>Alterar</a>";
      echo "<br><br><a class='button' href='config/delete_funcionarios.php?codigo=" . urlencode($row['codigo']) . "'>Excluir</a>";
      echo "</div>";
      echo "<hr>";
    }
  }
   else if (isset($_POST['buscar'])) {
    echo "<script>window.onload = () => { new bootstrap.Modal(document.getElementById('erro')).show(); }</script>";
  }

} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
?>

<script>
    document.body.querySelector("#cargo").textContent = localStorage.getItem('login');
</script>

    <style>
        @media (max-width: 390px){
           img{
            display: none;
            }
            header{
                padding: 20px 0px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>
