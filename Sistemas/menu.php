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

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Floricultura Jardim  |  Menu</title>
    <link rel="stylesheet" type="text/css" href="CSS/menu.css?v=1.0">
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>


  </head>
<body>

    <!-- Inserção do VLibras -->
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>


  

    <header>
      <img src="IMG/floricultura-logo.png" alt="Floricultura Jardim Logo" width="150" height="auto">
      <h6 class="text-light">Início</h6>
      <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Cadastro
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="cadastro_cliente.php">Cadastro Cliente</a></li>
          <li><a class="dropdown-item" href="cadastro_fornecedor.php">Cadastro Fornecedor</a></li>
          <li><a class="dropdown-item" href="cadastro_funcionario.php">Cadastro Funcionário</a></li>
          <li><a class="dropdown-item" href="cadastro_produto.php">Cadastro Produto</a></li>
          <li><a class="dropdown-item" href="cadastro_usuario.php">Cadastro Usuário</a></li>
        </ul>
      </div>
      <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Consulta
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="consulta_cliente.php">Consulta Cliente</a></li>
          <li><a class="dropdown-item" href="consulta_fornecedor.php">Consulta Fornecedor</a></li>
          <li><a class="dropdown-item" href="consulta_funcionario.php">Consulta Funcionário</a></li>
          <li><a class="dropdown-item" href="consulta_produto.php">Consulta Produto</a></li>
          <li><a class="dropdown-item" href="consulta_usuario.php">Consulta Usuário</a></li>
        </ul>
      </div>
      <div class="d-flex align-items-center">
        <a href="sair.php" style="color: white;text-decoration: none;">
          <h6>Sair</h6>
        </a>
        <img src="IMG/foto-perfil.png" alt="foto do usuário" width="70px" height="auto">
      </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>
