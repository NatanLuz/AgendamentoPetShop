# Sistema de Agendamento para PetShop (V1)

## 📖 Sobre o projeto

O **Sistema de Agendamento para PetShop** é uma aplicação web desenvolvida em PHP e MySQL para gerenciar clientes, pets e atendimentos em petshops e clínicas veterinárias.

Esta é a primeira versão do sistema. Ela foi criada para automatizar o fluxo básico de agendamentos e serviu como base para versões posteriores, nas quais a arquitetura, os controles de segurança e as funcionalidades foram ampliados.

O projeto demonstra o desenvolvimento de uma aplicação web com autenticação, controle de sessão, operações de cadastro, consulta, atualização e exclusão, persistência relacional e separação de responsabilidades.

### Organização da aplicação

- **Aplicação:** páginas e fluxo principal;
- **banco de dados:** conexão e criação das tabelas;
- **helpers:** autenticação, proteção CSRF e mensagens flash;
- **scripts:** configuração, manutenção e verificações do ambiente.

## ✨ Funcionalidades

### Acesso

- Autenticação de usuários;
- controle de sessão;
- encerramento da sessão por logout;
- bloqueio de páginas protegidas para usuários não autenticados.

### Gestão operacional

- CRUD de clientes;
- cadastro e gerenciamento de pets;
- associação dos pets aos respectivos clientes;
- criação de agendamentos;
- associação de serviços aos atendimentos;
- dashboard com visão diária;
- prevenção de conflitos de horários;
- acompanhamento operacional dos atendimentos.

### Segurança

- Senhas protegidas com `password_hash()`;
- Prepared Statements com `mysqli` para mitigar SQL Injection;
- tokens CSRF nos formulários;
- escape de saída com `htmlspecialchars()`;
- controle de acesso baseado em sessão.

## 🖼️ Screenshots

As imagens abaixo apresentam as principais telas da aplicação:

<p align="center">
  <img src="assets/Projetophp1.PNG" alt="Tela 1 do Sistema de Agendamento para PetShop" width="45%">
  <img src="assets/Projetophp2.PNG" alt="Tela 2 do Sistema de Agendamento para PetShop" width="45%"><br>
  <img src="assets/Projetophp3.PNG" alt="Tela 3 do Sistema de Agendamento para PetShop" width="45%">
  <img src="assets/Projetophp4.PNG" alt="Tela 4 do Sistema de Agendamento para PetShop" width="45%"><br>
  <img src="assets/Projetophp5.PNG" alt="Tela 5 do Sistema de Agendamento para PetShop" width="45%">
  <img src="assets/Projetophp6.PNG" alt="Tela 6 do Sistema de Agendamento para PetShop" width="45%">
</p>

## 🚀 Tecnologias

- **PHP 7.4+:** regras da aplicação e processamento das requisições;
- **MySQL ou MariaDB:** persistência dos dados;
- **mysqli:** conexão com o banco e execução de consultas preparadas;
- **HTML5:** estrutura das páginas;
- **CSS3:** apresentação visual;
- **JavaScript:** interações no navegador.

## ⚙️ Como executar

### Pré-requisitos

- Git;
- PHP 7.4 ou superior;
- MySQL ou MariaDB;
- extensão `mysqli` habilitada.

### Clonar o repositório

```bash
git clone https://github.com/NatanLuz/AgendamentoPetShop.git

cd AgendamentoPetShop
```

### Criar e preparar o banco

Com o MySQL ou MariaDB em execução, utilize o script de configuração:

```bash
php scripts/create_db.php
```

O projeto também inclui o arquivo `db/criar_tabelas.sql`, responsável pela definição das tabelas. Quando necessário, ele pode ser executado no banco configurado para a aplicação.

As credenciais de conexão devem ser conferidas em `db/conexao.php` e ajustadas ao ambiente local.

### Iniciar a aplicação

```bash
php -S localhost:8080
```

Acesse:

```text
http://localhost:8080/login.php
```

### Credenciais de demonstração

```text
Usuário: admin
Senha: admin123
```

> Essas credenciais são destinadas apenas ao ambiente demonstrativo. Altere a senha após o primeiro acesso.

### Verificação funcional

1. Entre com as credenciais de demonstração;
2. cadastre um cliente;
3. associe um pet ao cliente;
4. crie um agendamento;
5. verifique o atendimento no dashboard;
6. encerre a sessão;
7. confirme o bloqueio de acesso sem autenticação.

O diretório `scripts/` também possui `run_smoke_suite.php` para verificações rápidas e `setup-dev.ps1` para auxiliar na preparação do ambiente de desenvolvimento.

## 📂 Estrutura do projeto

A aplicação organiza suas páginas, acesso ao banco, helpers e scripts de suporte da seguinte forma:

```text
AgendamentoPetShop/
├── index.php
├── login.php
├── logout.php
├── clientes.php
├── pets.php
├── agendamentos.php
├── dashboard.php
├── db/
│   ├── conexao.php
│   └── criar_tabelas.sql
├── helpers/
│   ├── auth.php
│   ├── csrf.php
│   └── flash.php
└── scripts/
    ├── create_db.php
    ├── reset_admin_password.php
    ├── run_smoke_suite.php
    └── setup-dev.ps1
```

- Arquivos PHP da raiz: páginas e fluxos principais;
- `db/`: conexão e estrutura do banco;
- `helpers/`: autenticação, CSRF e mensagens temporárias;
- `scripts/`: criação do banco, manutenção da conta administrativa, smoke tests e configuração de desenvolvimento.

## 🌐 Deploy

O projeto é uma aplicação PHP tradicional e pode ser hospedado em qualquer servidor compatível com PHP 7.4+, MySQL ou MariaDB.

Para execução local, podem ser utilizados XAMPP, Laragon, WAMP ou o servidor embutido do PHP. Em uma hospedagem remota, é necessário publicar os arquivos, criar as tabelas e configurar em `db/conexao.php` as credenciais fornecidas pelo servidor.

Antes de disponibilizar a aplicação publicamente, substitua as credenciais demonstrativas e revise as configurações do ambiente.

## 👤 Autor

**Natan Da Luz**

- LinkedIn: [linkedin.com/in/natandaluz](https://www.linkedin.com/in/natandaluz/)
- Portfólio: [portfolionatan.vercel.app](https://portfolionatan.vercel.app/)
- E-mail: [natandaluz01@gmail.com](mailto:natandaluz01@gmail.com)

## 📄 Licença

Este projeto está sem uma licença definida no momento.
