 Sistema de Agendamento para Pet Shop 1 VERSÃO

Sistema completo de agendamento para pet shops e clínicas veterinárias desenvolvido em PHP puro e MySQL, focado em organização operacional, controle de clientes e gestão eficiente de atendimentos.

Este projeto simula um sistema real utilizado por estabelecimentos do setor pet, demonstrando boas práticas de desenvolvimento backend, segurança web e modelagem de banco de dados relacional.

---

🚀 Demonstração do Sistema

<p align="center">
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp1.PNG?raw=true" width="45%">
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp2.PNG?raw=true" width="45%"><br>
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp3.PNG?raw=true" width="45%">
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp4.PNG?raw=true" width="45%"><br>
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp5.PNG?raw=true" width="45%">
  <img src="https://github.com/NatanLuz/AgendamentoPetShop/blob/main/assets/Projetophp6.PNG?raw=true" width="45%">
</p>

---

📌 Problema que o projeto resolve

Pet shops e clínicas veterinárias frequentemente enfrentam dificuldades na organização de atendimentos, controle de clientes e gerenciamento de agenda.

Este sistema foi desenvolvido para:

- Centralizar agendamentos
- Organizar dados de clientes e pets
- Evitar conflitos de horários
- Facilitar a visualização dos atendimentos diários
- Melhorar o fluxo operacional do estabelecimento

---

✨ Funcionalidades

🔐 Autenticação Segura

- Login e logout com controle de sessão
- Proteção contra acessos não autorizados

👥 Gestão de Clientes

- Cadastro completo de clientes
- Consulta e busca de registros
- Atualização de dados
- Remoção de clientes

🐶 Gestão de Pets

- Cadastro de pets vinculados aos clientes
- Registro de espécie, raça e idade
- Organização do histórico dos animais

📅 Sistema de Agendamentos

- Criação e gerenciamento de horários
- Associação do atendimento ao pet
- Classificação por tipo de serviço
- Prevenção de conflitos de horários

📊 Dashboard Diário

- Visualização rápida dos atendimentos do dia
- Monitoramento operacional em tempo real

---

🛠️ Tecnologias Utilizadas

**Backend**

- PHP 7.4+
- MySQL / MariaDB
- mysqli

**Frontend**

- HTML5
- CSS3
- JavaScript

**Segurança**

- Prepared Statements
- CSRF Tokens
- Escapamento de saída
- Hash seguro de senhas

---

🧱 Estrutura do Projeto

```bash
AgendamentoPetShop/
├── index.php
├── login.php
├── logout.php
├── clientes.php
├── pets.php
├── agendamentos.php
├── dashboard.php
│
├── db/
│   ├── conexao.php
│   └── criar_tabelas.sql
│
├── helpers/
│   ├── auth.php
│   ├── csrf.php
│   └── flash.php
│
└── scripts/
    ├── create_db.php
    ├── reset_admin_password.php
    ├── run_smoke_suite.php
    └── setup-dev.ps1
```

---

⚙️ Como Executar o Projeto

📋 Pré-requisitos

- PHP 7.4 ou superior
- MySQL ou MariaDB
- XAMPP, WAMP ou ambiente similar

📥 Clonar o Repositório

```bash
git clone https://github.com/NatanLuz/AgendamentoPetShop.git
cd AgendamentoPetShop
```

🗄️ Criar o Banco de Dados

**Método automático**

```bash
php scripts/create_db.php
```

**Método manual**

```bash
mysql -u root -p < db/criar_tabelas.sql
```

▶️ Executar o Servidor Local

```bash
php -S localhost:8080
```

🌐 Acessar o Sistema

Abra no navegador:

```text
http://localhost:8080/login.php
```

🔑 Credenciais padrão

Usuário:

```text
admin
```

Senha:

```text
admin123
```

⚠️ Recomenda-se alterar a senha após o primeiro acesso.

---

🗃️ Estrutura do Banco de Dados

O sistema utiliza quatro tabelas principais:

**usuarios**  
Responsável pelo controle de acesso ao sistema.

**clientes**  
Armazena informações dos clientes.

**pets**  
Registro dos animais vinculados aos clientes.

**agendamentos**  
Controle dos atendimentos agendados.

---

🔒 Recursos de Segurança

- Hash seguro de senhas com `password_hash()`
- Proteção contra SQL Injection com Prepared Statements
- Proteção CSRF em formulários
- Escapamento de saída com `htmlspecialchars()`
- Autenticação baseada em sessão

---

🧪 Testes

Executar testes básicos do sistema:

```bash
php scripts/run_smoke_suite.php
```

🔧 Resetar Senha do Administrador

```bash
php scripts/reset_admin_password.php novasenha
```

---

📚 Aprendizados Técnicos

Durante o desenvolvimento deste projeto foram aplicados conceitos importantes como:

- Estruturação de aplicações web em PHP puro
- Modelagem de banco de dados relacional
- Implementação de autenticação segura
- Proteção contra vulnerabilidades comuns
- Organização modular de código
- Desenvolvimento de CRUD completo

---

📄 Licença

Este projeto está sob licença MIT.  
