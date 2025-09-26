<?php
session_start();

if (!empty($_POST)) {

    /* ----------- 1. Captura dos dados do formulário (sem `??`) ----------- */
    $emailDigitado = isset($_POST['email']) ? $_POST['email'] : '';
    $senhaDigitada = isset($_POST['senha']) ? $_POST['senha'] : '';

    /* ----------- 2. Conexão PDO (sem `[]` nos arrays) -------------------- */
    $host   = 'localhost:3307';
    $user   = 'root';
    $pass   = 'usbw';
    $dbname = 'Floricultura_Jardim';   // ajuste se necessário

    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $user,
            $pass
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* ----------- 3. Busca do usuário pelo e‑mail ---------------------- */
        $sql  = 'SELECT funcao, senha FROM usuarios WHERE email = :email LIMIT 1';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $emailDigitado);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        /* ----------- 4. Verificação da senha (base64) --------------------- */
        if ($usuario) {
            $senhaBanco = base64_decode($usuario['senha']);
            if ($senhaBanco === $senhaDigitada) {
                $_SESSION['login'] = $usuario['funcao'];  // Super Admin, Usuário, Admin
                header('Location: menu.php');
                exit;
            }
        }

        /* ----------- 5. Credenciais inválidas => modal -------------------- */
        echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    var erroModal    = new bootstrap.Modal(document.getElementById("erro"));
                    var modalMessage = document.getElementById("modalMessage");
                    modalMessage.textContent = "Email ou Senha inválidos!";
                    erroModal.show();
                });
              </script>';

    } catch (PDOException $e) {
        echo 'Erro de conexão: ' . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
    <script src="JS/index.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Floricultura Jardim | Login</title>

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


<div class="modal fade" id="erro"  aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="errorModalLabel">Erro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-danger" id="modalMessage">
           
          <div class="spinner-border text-danger" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

          </div>
          <div class="modal-footer">
    <button type="button" onclick="focarInput()" style="background-color: #8C1523; color:white; padding: 10px; border: none; border-radius: 10px; cursor: pointer;" class="modal-button" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

<header class="header">
    <nav class="navbar navbar-expand-lg =justify-content-center">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="IMG/floricultura-logo.png" alt="Floricultura Jardim Logo" width="150" height="auto" class="imagem-logo-header">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Carrinho
                            <img src="IMG/carrinho-compras.webp" class="carrinho-compras" alt="Seu carrinho de compras" width="50" height="auto">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<article class="mainArticle">
    <form class="form" method="POST" action="#">
        <div class="title">Bem vindo! 🌹<br><span>Login</span></div>
        <input class="input" placeholder="Email" name="email" id="email" type="email" required>
        <input class="input" placeholder="Senha" name="senha" type="password" required>
        <div class="login-with">
            <div class="button-log"><img src="IMG/X.png" style="filter: brightness(0) saturate(100%) invert(11%) sepia(79%) saturate(3777%) hue-rotate(342deg) brightness(92%) contrast(94%);" width="55px" height="auto"></div>
            <div class="button-log">
                <svg xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="56.6934px" viewBox="0 0 56.6934 56.6934" version="1.1" style="enable-background:new 0 0 56.6934 56.6934;" id="Layer_1" height="56.6934px" class="icon"><path d="M51.981,24.4812c-7.7173-0.0038-15.4346-0.0019-23.1518-0.001c0.001,3.2009-0.0038,6.4018,0.0019,9.6017  c4.4693-0.001,8.9386-0.0019,13.407,0c-0.5179,3.0673-2.3408,5.8723-4.9258,7.5991c-1.625,1.0926-3.492,1.8018-5.4168,2.139  c-1.9372,0.3306-3.9389,0.3729-5.8713-0.0183c-1.9651-0.3921-3.8409-1.2108-5.4773-2.3649  c-2.6166-1.8383-4.6135-4.5279-5.6388-7.5549c-1.0484-3.0788-1.0561-6.5046,0.0048-9.5805  c0.7361-2.1679,1.9613-4.1705,3.5708-5.8002c1.9853-2.0324,4.5664-3.4853,7.3473-4.0811c2.3812-0.5083,4.8921-0.4113,7.2234,0.294  c1.9815,0.6016,3.8082,1.6874,5.3044,3.1163c1.5125-1.5039,3.0173-3.0164,4.527-4.5231c0.7918-0.811,1.624-1.5865,2.3908-2.4196  c-2.2928-2.1218-4.9805-3.8274-7.9172-4.9056C32.0723,4.0363,26.1097,3.995,20.7871,5.8372  C14.7889,7.8907,9.6815,12.3763,6.8497,18.0459c-0.9859,1.9536-1.7057,4.0388-2.1381,6.1836  C3.6238,29.5732,4.382,35.2707,6.8468,40.1378c1.6019,3.1768,3.8985,6.001,6.6843,8.215c2.6282,2.0958,5.6916,3.6439,8.9396,4.5078  c4.0984,1.0993,8.461,1.0743,12.5864,0.1355c3.7284-0.8581,7.256-2.6397,10.0725-5.24c2.977-2.7358,5.1006-6.3403,6.2249-10.2138  C52.5807,33.3171,52.7498,28.8064,51.981,24.4812z"></path></svg>
            </div>
            <div class="button-log">
                <svg class="icon" height="56.693px" id="Layer_1" version="1.1" viewBox="0 0 56.693 56.693" width="56.693px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z"></path></svg>
            </div>
        </div>
        <button id="submitButton" class="button-confirm" style="color: #8C1523;">Avançar →</button>
    </form>
</article>

<nav class="mainNav">
    
<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6 p-0">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="IMG/flores-urso.jpg" alt="Item da loja" class="d-block w-100">
              <div class="carousel-caption d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img src="IMG/flores-jarro.webp" alt="Item da loja" class="d-block w-100">
              <div class="carousel-caption d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img src="IMG/flores-girassol.webp" alt="Item da loja" class="d-block w-100">
              <div class="carousel-caption d-md-block">
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

</nav>

<div class="ads">
    <div class="card" style="width: 15rem;">
        <img src="IMG/flores-card.webp" class="card-img-top" alt="Imagem de um buquê de flores coloridas">
        <div class="card-body">
            <h5 class="card-title">
                <b><span style="text-decoration: line-through;">R$ 219,99</span></b>
                <b class="text-success"> R$ 169,99</b>
            </h5>
            <p class="card-text">Este buquê cheio de vida e alegria é confeccionado com 24 rosas nacionais coloridas, envolvido em Ruscus, Tango e acabamento em ráfia.</p>
        </div>
    </div>
</div>


<footer class="footer">
<p>&COPY; 2024 FLORICULTURA JARDIM. TODOS OS DIREITOS RESERVADOS.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
