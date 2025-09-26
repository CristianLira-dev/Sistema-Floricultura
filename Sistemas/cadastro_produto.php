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
    <title>Cadastro Produtos</title>
    <script src="JS/cadastro_produto.js" defer></script>
    <script src="JS/cadastro.js" defer></script>
    <script src="JS/funcao.js" defer></script>
    <link rel="shortcut icon" type="image/png" href="IMG/icon-nav.png">
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
        <form id="formulario" class="form" method="POST" action="config/InsertDataProdutos.php" enctype="multipart/form-data">
            <div class="title">Cadastro de Produto 🌹<br><span>Preencha os dados abaixo</span></div>

            <div class="input-container">
                <input class="input" placeholder="Descrição Produto" name="nome" id="nome" type="text" required>
            </div>

            <div class="input-container">
                <input class="input" placeholder="Peso" id="peso" name="peso" type="text" oninput="gramas()" required>
            </div>

            <div class="input-container">
                <input class="input" placeholder="Código de Barras" name="codigo" id="codigo" type="number" required>
                <div id="mensagem-codigo" class="text-danger mt-1"></div>
            </div>

            <div class="input-container">
                <input class="input" placeholder="Preço Custo" name="custo" id="preco1" oninput="formatarPreco1()" type="text" required>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="Preço Venda" name="venda" id="preco2" oninput="formatarPreco2()" type="text"
                    required>
                <input class="input" placeholder="Estoque" id="estoque" name="estoque" type="number" required>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <input class="input" placeholder="Estoque Máx" name="etq_max" id="etq_max" type="number">
                <input class="input" placeholder="Marca" id="marca" name="marca" type="text" required>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center input-container">
                <select class="form-select input" id="fornecedor" name="fornecedor" style="background-color: #FFF5E6; border: solid 3px #8C1523" required>
                    <option value="" disabled selected>Fornecedor</option>
                    <option value="florinha">Florinha</option>
                    <option value="petalas_e_mimos">Pétalas e Mimos</option>
                    <option value="jardim_encantado">Jardim Encantado</option>
                    <option value="flor_de_prata">Flor de Prata</option>
                    <option value="rosa_dourada">Rosa Dourada</option>
                    <option value="verde_vivo">Verde Vivo</option>
                    <option value="aroma_floral">Aroma Floral</option>
                    <option value="canto_das_flores">Canto das Flores</option>
                    <option value="flor_do_ceu">Flor do Céu</option>
                    <option value="bela_flor">Bela Flor</option>
                </select>
                <input class="input" placeholder="Setor" id="setor" name="setor" type="number" required>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const codigoInput = document.getElementById('codigo');
            const mensagemCodigo = document.getElementById('mensagem-codigo');

            codigoInput.addEventListener('input', function () {
                const codigo = codigoInput.value;
                validarCodigoBarras(codigo);
            });

            function validarCodigoBarras(codigo) {
                const padrao = /^\d{13}$/;

                if (padrao.test(codigo)) {
                    mensagemCodigo.textContent = "";
                    codigoInput.classList.remove('is-invalid');
                } else {
                    mensagemCodigo.textContent = "Código de barras inválido!";
                    codigoInput.classList.add('is-invalid');
                }
            }
        });

        function formatarPreco1() {
            var preco = document.getElementById('preco1');
            var valor = preco.value.replace(/[^\d,]/g, '');

            if (valor) {
                preco.value = `${valor} R$`;
            } else {
                preco.value = '';
            }
        }


        function formatarPreco2() {
            var preco = document.getElementById('preco2');
            var valor = preco.value.replace(/[^\d,]/g, '');

            if (valor) {
                preco.value = `${valor} R$`;
            } else {
                preco.value = '';
            }
        }

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
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
