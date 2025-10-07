# Agendamento PetShop

Este é um projeto de exemplo em PHP puro (sem frameworks) com MySQL para demonstrar um sistema simples de agendamento para PetShop / clínica veterinária.

Funcionalidades principais

- Autenticação básica (login/logout)
- CRUD de clientes
- CRUD de pets (cada pet vinculado a um cliente)
- CRUD de agendamentos (data, horário, tipo de serviço)
- Dashboard que mostra os agendamentos do dia
- Proteções básicas: prepared statements (mysqli), CSRF tokens e escape de saída (htmlspecialchars)

Estrutura do projeto

- `index.php` — página inicial (requer login)
- `login.php`, `logout.php` — autenticação
- `clientes.php`, `pets.php`, `agendamentos.php` — interfaces CRUD
- `dashboard.php` — agendamentos do dia
- `db/conexao.php` — conexão com MySQL (usa variáveis de ambiente: DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_DATABASE)
- `db/criar_tabelas.sql` — script para criar o schema e um usuário `admin` de exemplo
- `helpers/` — helpers para autenticação, CSRF e flash messages
- `scripts/` — utilitários: `setup-dev.ps1`, `run_smoke_suite.php`, `create_db.php`, `reset_admin_password.php`

Requisitos

- PHP 7.4+ com extensão `mysqli` habilitada
- MySQL (ou MariaDB) acessível
- (opcional) XAMPP/WAMP para quem preferir instalar via pacote

Como executar localmente (opção rápida — PHP embutido + MySQL local)

1. Abra PowerShell e entre na pasta do projeto:

```powershell
cd 'C:\Users\User\Desktop\AgendamentoPetShop\agendamento-petshop'
```

2. Crie o banco e as tabelas (script incluído):

```powershell
php scripts/create_db.php
```

Esse script tenta conectar ao MySQL em `127.0.0.1:3306` usando as variáveis de ambiente (ou `root` sem senha por padrão) e importa `db/criar_tabelas.sql`.

Se preferir usar o PowerShell helper incluído (cria usuário `dev` e `.env`):

```powershell
.\scripts\setup-dev.ps1
```

3. Inicie o servidor PHP embutido:

```powershell
php -S 127.0.0.1:8080
```

4. Acesse no navegador:

http://127.0.0.1:8080/login.php

Credenciais de exemplo (criadas pelo script SQL):

- Usuário: `admin`
- Senha: `admin123`

Se o login não funcionar, use `scripts/reset_admin_password.php` para redefinir a senha do admin:

```powershell
php scripts/reset_admin_password.php admin123
```

Testes rápidos (smoke tests)

Execute o runner simples que faz inserts/selects/deletes básicos:

```powershell
php scripts/run_smoke_suite.php
```

Publicando no GitHub

1. Inicialize git se ainda não estiver versionado:

```powershell
git init
git add .
git commit -m "Initial commit - Agendamento PetShop"
```

2. Crie um repositório no GitHub e empurre:

```powershell
git remote add origin https://github.com/SEU_USUARIO/SEU_REPO.git
git branch -M main
git push -u origin main
```

3. (Opcional) Configure secrets no GitHub para permitir que o workflow execute os smoke tests no CI:

- Vá em Settings → Secrets → Actions e adicione `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USER`, `DB_PASSWORD`.

Arquivos úteis no repositório

- `.env.example` — exemplo de variáveis de ambiente
- `.gitignore` — arquivos a ignorar
- `.github/workflows/php.yml` — workflow que faz lint de PHP e opcionalmente executa smoke tests quando os secrets estiverem configurados

Segurança e notas finais

- Não comite credenciais reais (arquivo `.env` não deve ser versionado).
- Em produção, use conexões TLS, usuários com permissões limitadas e políticas de senha seguras.

Se quiser, eu posso:

- Gerar badges (CI, licença) e melhorar o README com screenshots.
- Converter o projeto para usar SQLite (para não depender de MySQL) — útil se você quiser distribuir só com um arquivo.

Obrigado por usar o projeto! Se quiser que eu ajuste o README com mais detalhes (ex.: endpoints, esquema das tabelas ou screenshots), diga o que adicionar e eu atualizo.

Como publicar no GitHub

1. Inicialize o repositório local (se ainda não faz parte de um git):

```powershell
git init
git add .
git commit -m "Initial commit - Agendamento PetShop"
```

2. Crie um repositório no GitHub (via site) e adicione o remoto, por exemplo:

```powershell
git remote add origin https://github.com/SEU_USUARIO/SEU_REPO.git
git branch -M main
git push -u origin main
```

3. (Opcional) Configure secrets no GitHub (Settings → Secrets) se quiser que o workflow execute os smoke tests na CI:

   - DB_HOST, DB_PORT, DB_DATABASE, DB_USER, DB_PASSWORD

4. Não comite o arquivo `.env` com credenciais reais; use `.env.example` como referência.

Pronto — após o push, o workflow definido em `.github/workflows/php.yml` fará lint dos arquivos PHP e (se você configurar os secrets) tentará executar o script de smoke tests.
