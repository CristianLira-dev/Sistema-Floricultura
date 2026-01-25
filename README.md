# 🌻 Sistema de Gestão - Floricultura (ERP)

<img width="1919" height="909" alt="image" src="https://github.com/user-attachments/assets/2dc601f7-ad36-4912-9bf9-f169e8c88ffe" />
> *Solução completa de gerenciamento comercial: Controle de estoque, clientes, RH e automação de endereços.*

## 💻 Sobre o Projeto

Este projeto é um **Sistema de Gestão Empresarial (ERP)** desenvolvido para informatizar os processos de uma floricultura. O objetivo foi criar uma solução centralizada para substituir planilhas manuais.

A aplicação foca em **CRUDs relacionais** (Create, Read, Update, Delete), permitindo o controle total sobre as operações da loja. O sistema foi projetado para rodar em ambiente portátil utilizando o **USBwebServer**, facilitando a implantação e testes.

---

## ✨ Funcionalidades Principais

### 📦 Gestão de Estoque & Produtos
- [x] **Cadastro de Produtos:** Registro detalhado com preço, quantidade e fornecedor vinculado.
- [x] **Controle de Fornecedores:** Base de dados para gestão de parceiros comerciais.

### 👥 Gestão de Pessoas (CRM & RH)
- [x] **Cadastro de Clientes:** Armazenamento histórico de compradores.
- [x] **Gestão de Funcionários:** Cadastro de equipe e atribuição de cargos.
- [x] **Automação de Endereço:** Integração com a **API ViaCep** para preenchimento automático de logradouro, bairro e cidade apenas digitando o CEP.

### 🔐 Administração do Sistema
- [x] **Controle de Acesso:** Gestão de usuários do sistema (Login/Senha).
- [x] **Relatórios:** Visualização rápida de dados em tabelas organizadas.

---

## 🛠️ Tecnologias Utilizadas

- **Front-End:** HTML5, CSS3, JavaScript (Consumo de API ViaCep).
- **Back-End:** PHP (Nativo/Estruturado).
- **Banco de Dados:** MySQL.
- **Ambiente:** USBwebServer (Apache + PHPMyAdmin).

---

## 📸 Galeria do Sistema

| Dashboard / Home | Cadastro de Clientes (ViaCep) |
| :---: | :---: |
| <img width="1919" height="910" alt="image" src="https://github.com/user-attachments/assets/95a346f8-b34d-4945-bf0b-c85f43a7ec11" /> | <img width="1919" height="911" alt="image" src="https://github.com/user-attachments/assets/9f85229c-1781-490e-9e0c-11b4850cb2a9" /> |

| Listagem de Produtos | Cadastro de Usuários |
| :---: | :---: |
| <img width="1919" height="911" alt="image" src="https://github.com/user-attachments/assets/c5136b10-8b5a-4e5c-83b1-ddcaa443fb4c" /> | <img width="1919" height="911" alt="image" src="https://github.com/user-attachments/assets/cdd22643-428e-487d-9b64-be55ca899d72" /> W|

---

## 🚀 Como rodar o projeto (Instalação)

Este projeto foi otimizado para execução via **USBwebServer**.

### Passo a Passo

1. **Baixe o Projeto:**
   - Clone este repositório ou baixe o ZIP.

2. **Configuração do Servidor:**
   - Abra a pasta do seu **USBwebServer**.
   - Coloque a pasta do projeto `Sistema-Floricultura` dentro da pasta `root` (ou `www`) do USBwebServer.

3. **Iniciando o Ambiente:**
   - Execute o arquivo `USBWebserver.exe`.
   - Verifique se **Apache** e **MySQL** estão rodando (ícone verde).

4. **Banco de Dados:**
   - Clique em **PhpMyAdmin** no painel do USBwebServer.
   - Crie um banco de dados (ex: `floricultura_jardim`).
   - Importe o arquivo `.sql` que está na raiz deste projeto.
   - *Atenção:* Verifique se o arquivo `conexao.php` está com as credenciais corretas (No USBwebServer, geralmente o usuário é `root` e a senha é `usbw`).

5. **Acessar:**
   - Abra o navegador e digite:
   `http://localhost:8080/sistema/Sistemas/`
