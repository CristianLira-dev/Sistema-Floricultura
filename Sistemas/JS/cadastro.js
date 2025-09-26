
  document.getElementById('buscar-cep').addEventListener('click', function() {
    const cep = document.getElementById('cep').value.replace(/[^0-9]+/g, '');
    const url = `https://viacep.com.br/ws/${cep}/json/`;
  
    fetch(url)
      .then(response => response.json())
      .then(json => {
        if (json.erro) {
          document.getElementById('mensagem-cep').textContent = "CEP não encontrado!";
          document.getElementById('rua').value = '';
          document.getElementById('bairro').value = '';
          document.getElementById('cidade').value = '';
          document.getElementById('uf').value = '';
        } else {
          document.getElementById('rua').value = json.logradouro;
          document.getElementById('bairro').value = json.bairro;
          document.getElementById('cidade').value = json.localidade;
          document.getElementById('uf').value = json.uf;
          document.getElementById('mensagem-cep').textContent = "";
        }
      })
      .catch(error => {
        console.error("Erro ao buscar CEP:", error);
        document.getElementById('mensagem-cep').textContent = "Erro ao buscar CEP!";
      });
  });

  document.getElementById('data-nascimento').addEventListener('change', function() {
    const dataNascimento = new Date(this.value);
    const hoje = new Date();
    const idade = hoje.getFullYear() - dataNascimento.getFullYear();
    const mes = hoje.getMonth() - dataNascimento.getMonth();
    
    // Verifica se a data de nascimento ainda não teve aniversário este ano
    if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
        idade--;
    }

    if (idade < 18) {
        document.getElementById('mensagem-data').textContent = "Você precisa ter pelo menos 18 anos.";
        this.classList.add('is-invalid'); // Adiciona classe Bootstrap para exibir a borda vermelha
    } else {
        document.getElementById('mensagem-data').textContent = "";
        this.classList.remove('is-invalid'); // Remove a classe Bootstrap se a validação for bem-sucedida
    }
}); 

