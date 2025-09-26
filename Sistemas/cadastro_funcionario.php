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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Funcionário</title>
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
    <script src="JS/funcao.js" defer></script>
    <script src="JS/cadastro.js" defer></script>
    <link rel="stylesheet" type="text/css" href="CSS/cadastro_cliente.css?v=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<style>
  /* Remover setas no Chrome, Safari, Edge */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Remover setas no Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

</style>


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
        <form id="formulario" class="form" method="POST" action="config/InsertDataFuncionarios.php" enctype="multipart/form-data">
            <div class="title">Cadastro de Funcionário 🌹<br><span>Preencha os dados abaixo</span></div>

            <div class="input-container">
                <input class="input" placeholder="Nome" id="nome" name="nome" type="text" required>
                <div id="mensagem-nome" class="text-danger mt-1"></div>
            </div>

            <div class="input-container">
                <select class="form-select input" name="estado-civil"  style="background-color: #FFF5E6; border: solid 3px #8C1523" id="estado-civil" required>
                    <option value="" disabled selected>Estado Civil</option>
                    <option value="solteiro">Solteiro(a)</option>
                    <option value="casado">Casado(a)</option>
                    <option value="divorciado">Divorciado(a)</option>
                    <option value="viuvo">Viúvo(a)</option>
                    <option value="separado">Separado(a)</option>
                </select>
            </div>

            <div class="input-container">
                <input class="input" placeholder="CPF" name="cpf" id="cpf" type="text" required>
                <div id="mensagem-cpf" class="text-danger mt-1"></div>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="CEP" name="cep" id="cep" type="text" required>
                <button type="button" id="buscar-cep" class="btn btn-primary">Buscar</button>
            </div>
            <div id="mensagem-cep" class="text-danger mt-1"></div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="RUA" name="rua" id="rua" type="text" required>
                <input class="input" placeholder="Número" name="numero" id="numero" type="number" required>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="Complemento" name="complemento" id="complemento" type="text">
                <input class="input" placeholder="Bairro" name="bairro" id="bairro" type="text" required>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="Cidade" name="cidade" id="cidade" type="text" required>
                <select class="form-select input" id="uf" name="uf"  style="background-color: #FFF5E6; border: solid 3px #8C1523"  required>
                    <option value="" disabled selected>UF</option>
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                </select>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="Telefone" name="telefone" id="telefone" maxlength="15" type="text" required>
                <div class="input-container">
                    <input class="input mt-4" placeholder="Data de Nascimento" name="data_nascimento" id="data-nascimento" type="date" required>
                    <div id="mensagem-data" class="text-danger mt-1"></div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-center input-container">
      <label style="color:#666;" for="upload" id="label" class="input">Envie uma Foto sua para se Cadastrar <i style="color: #8C1523" class="fa-solid fa-camera"></i></label>
      <input class="input d-none" name="upload" onchange="FileName()"  accept="image/*" placeholder="upload" id="upload"  type="file" required>
    </div>
            <div class="d-flex justify-content-center align-items-center gap-3">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
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

    if (invalido) {
        event.preventDefault(); // Impede envio
        let modalMessage = document.getElementById('modalMessage');
        let modal = new bootstrap.Modal(document.getElementById('modal'));
        modalMessage.textContent = 'Por favor, preencha todos os campos corretamente (sem apenas espaços).';
        modal.show();
    }
});
</script>

    <script src="JS/funcao.js" defer></script>
    <script src="JS/cadastro.js" defer></script>

    <script>
        document.getElementById('data-nascimento').addEventListener('change', function() {
            const dataNascimento = new Date(this.value);
            const hoje = new Date();
            const idade = hoje.getFullYear() - dataNascimento.getFullYear();
            const mes = hoje.getMonth() - dataNascimento.getMonth();

            if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
                idade--;
            }

            if (idade < 18) {
                document.getElementById('mensagem-data').textContent = "Você precisa ter pelo menos 18 anos.";
                this.classList.add('is-invalid');
            } else {
                document.getElementById('mensagem-data').textContent = "";
                this.classList.remove('is-invalid');
            }
        });

        const upload = document.querySelector("#upload");
upload.addEventListener("change", function() {
  const size = upload.files[0].size;
  const label = document.getElementById('label');

  
  // Verifica se o tamanho do arquivo é maior que 5 MB (5 * 1024 * 1024 bytes)
  if (size > 5 * 1024 * 1024) {           
    let modalMessage = document.getElementById('modalMessage');
    let modal = new bootstrap.Modal(document.getElementById('modal'));

    modalMessage.textContent = 'Foto indisponível (máximo de 5 MB)';
    modal.show();
    
    // Limpa o campo de upload
    upload.value = ""; 
    label.value = ""; 
  }
});

        function FileName() {
  const input = document.getElementById('upload');
  const label = document.getElementById('label');
  
  // Remove ícones antigos (se houver)
  label.textContent = '';

  if (input.files.length > 0) {
    // Adiciona o nome do arquivo ao texto do label
    label.textContent = input.files[0].name;

    // Cria o ícone e adiciona a classe
    const iconCam = document.createElement('i');
    iconCam.classList.add('fa-solid', 'fa-camera', 'ms-2');
    iconCam.style.color = "#8C1523";
    
    // Anexa o ícone ao label
    label.appendChild(iconCam);
  } else {
    label.textContent = 'Escolher arquivo';
  }
}

    </script>


<?php


date_default_timezone_set('America/Sao_Paulo');

// Verifica se o arquivo foi enviado e se não houve erro
if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
    $ext = '.' . strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION)); // Extensão do arquivo

    // Gerando um nome único para o arquivo com base na data e hora
    $novo_nome = date("Y.m.d-H.i.s") . $ext;

    // Diretório onde o arquivo será salvo
    $dir = 'Imagens-Sistemas/';

    // Move o arquivo para o diretório especificado
    move_uploaded_file($_FILES['upload']['tmp_name'], $dir . $novo_nome);

}
?> 

</body>

</html>
