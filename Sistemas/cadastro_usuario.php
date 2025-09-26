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
<?php
// Verificar se há uma mensagem de sessão e exibir o modal
if (isset($_SESSION['form_message'])) {
    echo "<script>
        window.onload = function() {
            let modalMessage = document.getElementById('modalMessage');
            let modal = new bootstrap.Modal(document.getElementById('modal'));
            modalMessage.textContent = '" . $_SESSION['form_message'] . "';
            modal.show();
        }
    </script>";

    // Limpar a variável de sessão para não exibir o modal novamente
    unset($_SESSION['form_message']);
    unset($_SESSION['form_status']);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Usuário</title>
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
    <link rel="stylesheet" type="text/css" href="CSS/cadastro_cliente.css?v=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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


<!--modal -->
<div class="modal" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Floricultura Jardim Informa:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Mensagem que vai ser Exibida!! -->
         <p id="modalMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

    <div class="d-flex justify-content-center align-items-center">
      <form id="formulario" class="form" method="POST" action="config/InsertDataUsuarios.php" onsubmit="return verificar(event)">
      <div class="title">Cadastro de Usuários 🌹<br><span>Preencha os dados abaixo</span></div>
      
      <div class="input-container">
        <input class="input" placeholder="Cristian Lira" id="nome-adm" type="text" disabled>
      </div>
      
      <div class="input-container">
        <select class="form-select" style="background-color: #FFF5E6; border: solid 3px #8C1523" disabled>
          <option value="" disabled selected>Administrador</option>
        </select>
      </div>
      
      <div class="input-container">
        <input class="input" placeholder="E-mail: florjardim@floricultura.com" disabled>
      </div>
      
      <div class="input-container">
        <input class="input" placeholder="Senha: floresrosas" type="password" disabled>
      </div>
      
      <div class="title">Cadastre outro Usuário<br></div>
      
      <div class="input-container">
                <input class="input" placeholder="Nome Completo" name="nome" id="nome" type="text" required>
                <div id="mensagem-nome" class="text-danger"></div>
            </div>

            <div class="input-container">
                <select class="form-select" name="funcao" style="background-color: #FFF5E6; border: solid 3px #8C1523" id="funcao" required>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Usuário">Usuário</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <div class="input-container">
                <input class="input" placeholder="E-mail" name="email" type="email" id="email" required>
            </div>

            <div class="input-container">
                <input class="input" placeholder="Senha" name="senha" type="password" id="senha" required>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-3">
                <button type="submit" class="btn btn-primary" onclick="verificar(event)">Cadastrar</button>
                <button type="reset" class="btn btn-warning">Limpar</button>
                <a href="menu.php">
        <button type="button" class="btn btn-danger">Voltar</button>
      </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

            <script>
document.getElementById('formulario').addEventListener('submit', function(event) {
    const campos = this.querySelectorAll('input, select');
    let invalido = false;

    campos.forEach(campo => {
        const tipo = campo.type;
        const nome = campo.name;

        // Só valida campos de texto, número, email ou select (exceto file)
        if (tipo !== 'file' && tipo !== 'button' && tipo !== 'submit' && tipo !== 'reset') {
            const valor = campo.value.trim();

            if (valor === "") {
                campo.classList.add('is-invalid'); // Bootstrap visual feedback
                invalido = true;
            } else {
                campo.classList.remove('is-invalid');
            }
        }
    });

});
</script>

    <script src="JS/funcao.js"></script>

    <script>
function verificar(event) {
  event.preventDefault();

  let nome = document.getElementById("nome").value;
  let funcao = document.getElementById("funcao").value;
  let email = document.getElementById("email").value;
  let senha = document.getElementById("senha").value;
  let modalMessage = document.getElementById("modalMessage");
  let modal = new bootstrap.Modal(document.getElementById("modal")); // Bootstrap Modal 

 if (nome === "Cristian Lira") {
    modalMessage.textContent = 'Já existe um usuário com esse nome!';
    modal.show();
} else if (funcao === "administrador") {
    modalMessage.textContent = 'Já existe um administrador!';
    modal.show();
} else if (email === "florjardim@floricultura.com") {
    modalMessage.textContent = 'Já existe um usuário com esse e-mail!';
    modal.show();
} else if (senha === "") {
    modalMessage.textContent = 'Digite uma senha';
    modal.show();
} else if (senha.length < 8) {
    modalMessage.textContent = 'Digite uma senha com mais de 8 caracteres';
    modal.show();
} else {
    document.querySelector("form").submit();
}


    </script>


</body>

</html>
