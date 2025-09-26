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
  <title>Cadastro Cliente</title>
  <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
  <script src="JS/cadastro.js" defer></script>
<script src="JS/funcao.js" defer></script>
  <link rel="stylesheet" type="text/css" href="CSS/cadastro_cliente.css?v=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <form class="form" method="POST" action="config/InsertDataClientes.php" id="formulario" enctype="multipart/form-data">
    <div class="title">Cadastro de Cliente 🌹<br><span>Preencha os dados abaixo</span></div>

    <div class="input-container">
      <input class="input" name="nome" placeholder="Nome Completo" id="nome" type="text" required>
      <div id="mensagem-nome" class="text-danger"></div>
     </div>

     <div class="input-container">
  <input class="input" name="cpf" placeholder="CPF" id="cpf" type="text" required>
  <div id="mensagem-cpf" class="text-danger mt-1"></div>
</div>


    <div class="input-container">
      <input class="input" name="rg" placeholder="RG" id="rg" type="text" required>
      <div id="mensagem-rg" class="text-danger mt-1"></div>
    </div>

    <div style="display: flex;
  justify-content: center;
  align-items: center;" class="input-container">
      <input class="input" name="cep" placeholder="CEP" id="cep" type="text" required>  
      <button type="button" class="btn btn-primary p-2" id="buscar-cep">Buscar</button>
    </div>

    <div id="mensagem-cep" class="text-danger"></div>

    <div class="d-flex align-items-center justify-content-center input-container">
      <input class="input" name="rua" placeholder="RUA" id="rua" type="text" required>
      <input class="input" name="numero" placeholder="Número" id="numero" type="number" required>
    </div>

    <div class="d-flex align-items-center justify-content-center input-container">
      <input class="input" name="complemento" placeholder="Complemento" id="complemento" type="text">
      <input class="input" name="bairro" placeholder="Bairro" id="bairro" type="text" required>
    </div>

    <div class="d-flex align-items-center justify-content-center input-container">
      <input class="input" name="cidade" placeholder="Cidade" id="cidade" type="text" required>
      <select class="form-select input" name="uf" style="background-color: #FFF5E6; border: solid 3px #8C1523" id="uf" required>
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
        <option value="SE">SE</option>
        <option value="SP">SP</option>
        <option value="TO">TO</option>
      </select>
    </div>

    <div class="d-flex align-items-center justify-content-center input-container">
      <input class="input" name="telefone" placeholder="Telefone" id="telefone" maxlength="15" type="text" required>
      <input class="input" name="email" placeholder="E-mail" id="email" type="email" required>
    </div>
    
    <div class="d-flex align-items-center justify-content-center input-container">
      <label style="color:#666;" for="upload" id="label" class="input">Envie uma Foto sua para se Cadastrar <i style="color: #8C1523" class="fa-solid fa-camera"></i></label>
      <input class="input d-none" name="upload" onchange="FileName()"  accept="image/*" placeholder="upload" id="upload"  type="file" required>
    </div>

    <div class="d-flex justify-content-center align-items-center" id="botao">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
      <button type="reset" class="btn btn-warning" id="limpar">Limpar</button>
      <a href="menu.php">
        <button type="button" class="btn btn-danger">Voltar</button>
      </a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

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

<script>
  function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o hífen
    return cpf;
  }

  function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
      return false;
    }

    let soma = 0;
    let resto;

    for (let i = 1; i <= 9; i++) {
      soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
      resto = 0;
    }

    if (resto !== parseInt(cpf.substring(9, 10))) {
      return false;
    }

    soma = 0;
    for (let i = 1; i <= 10; i++) {
      soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
      resto = 0;
    }

    if (resto !== parseInt(cpf.substring(10, 11))) {
      return false;
    }

    return true;
  }

  document.getElementById('cpf').addEventListener('input', function() {
    this.value = formatarCPF(this.value);
  });

  document.getElementById('cpf').addEventListener('blur', function(event) {
    let cpf = this.value;
    let mensagemCPF = document.getElementById('mensagem-cpf');

    if (!validarCPF(cpf)) {
      event.preventDefault();
      mensagemCPF.textContent = "CPF inválido";
    } else {
      mensagemCPF.textContent = "";
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

    label.textContent = input.files[0].name;

    // Cria o ícone e adiciona a classe
    const iconCam = document.createElement('i');
    iconCam.classList.add('fa-solid', 'fa-camera', 'ms-2');
    iconCam.style.color = "#8C1523";
    
    label.appendChild(iconCam);
  } else {
    label.textContent = 'Envie uma Foto sua para se Cadastrar';

    const iconCam = document.createElement('i');
    iconCam.classList.add('fa-solid', 'fa-camera', 'ms-2');
    iconCam.style.color = "#8C1523";
    
    label.appendChild(iconCam);
  }
}

</script>

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



</body>
</html>
