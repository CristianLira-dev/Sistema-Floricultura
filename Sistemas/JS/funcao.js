document.getElementById("nome").addEventListener("blur", function () {
  const nome = this.value.trim();
  const temEspaco = nome.includes(" ");
  document.getElementById("mensagem-nome").textContent = temEspaco
    ? ""
    : "Digite seu NOME COMPLETO!";
});

document.addEventListener("DOMContentLoaded", function () {
  function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, "");
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
    let soma = 0;
    let resto;
    for (let i = 1; i <= 9; i++)
      soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;
    soma = 0;
    for (let i = 1; i <= 10; i++)
      soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.substring(10, 11));
  }

  document.getElementById("rg").addEventListener("blur", function () {
    const rg = this.value.replace(/\D/g, "");
    document.getElementById("mensagem-rg").textContent =
      rg.length >= 8 && rg.length <= 9 ? "" : "RG inválido!";
  });

  document.getElementById("buscar-cep").addEventListener("click", function () {
    const cep = document.getElementById("cep").value.replace(/[^0-9]+/g, "");
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)
      .then((response) => response.json())
      .then((json) => {
        if (json.erro) {
          document.getElementById("mensagem-cep").textContent =
            "CEP não encontrado!";
          document.getElementById("rua").value = "";
          document.getElementById("bairro").value = "";
          document.getElementById("cidade").value = "";
          document.getElementById("uf").value = "";
        } else {
          document.getElementById("rua").value = json.logradouro;
          document.getElementById("bairro").value = json.bairro;
          document.getElementById("cidade").value = json.localidade;
          document.getElementById("uf").value = json.uf;
          document.getElementById("mensagem-cep").textContent = "";
        }
      })
      .catch((error) => {
        console.error("Erro ao buscar CEP:", error);
        document.getElementById("mensagem-cep").textContent =
          "Erro ao buscar CEP!";
      });
  });
});

(function formatarTelefone() {
  const telefoneInput = document.querySelector("input[id=telefone]");

  telefoneInput.addEventListener("input", (e) => {
    let telefone = e.target.value.replace(/\D/g, "");

    if (telefone.length <= 10) {
      telefone = telefone.replace(/(\d{2})(\d{0,4})/, "($1) $2");
      telefone = telefone.replace(/(\d{4})(\d{0,4})/, "$1-$2");
    } else {
      telefone = telefone.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
    }

    e.target.value = telefone;
  });
})();

document.getElementById("buscar-cep").addEventListener("click", function () {
  const cep = document.getElementById("cep").value.replace(/[^0-9]+/g, "");
  const url = `https://viacep.com.br/ws/${cep}/json/`;

  fetch(url)
    .then((response) => response.json())
    .then((json) => {
      if (json.erro) {
        document.getElementById("mensagem-cep").textContent =
          "CEP não encontrado!";
        document.getElementById("rua").value = "";
        document.getElementById("bairro").value = "";
        document.getElementById("cidade").value = "";
        document.getElementById("uf").value = "";
      } else {
        document.getElementById("rua").value = json.logradouro;
        document.getElementById("bairro").value = json.bairro;
        document.getElementById("cidade").value = json.localidade;
        document.getElementById("uf").value = json.uf;
        document.getElementById("mensagem-cep").textContent = "";
      }
    })
    .catch((error) => {
      console.error("Erro ao buscar CEP:", error);
      document.getElementById("mensagem-cep").textContent =
        "Erro ao buscar CEP!";
    });
});
