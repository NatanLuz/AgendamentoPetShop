# Setup dev environment: create database, create dev user, import schema and create .env
Param()

Write-Host "Setup dev: criando banco de dados 'petshop_db' e usuário 'dev'"

$mysqlExe = "mysql"
if (-not (Get-Command $mysqlExe -ErrorAction SilentlyContinue)) {
    Write-Host "Cliente 'mysql' não encontrado no PATH. Instale MySQL client (mysql.exe) e tente novamente." -ForegroundColor Yellow
    exit 1
}

$rootUser = Read-Host "Usuário MySQL com privilégios (ex: root)"
$rootPass = Read-Host "Senha do usuário MySQL (será usada para executar os comandos)"

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Definition
$sqlFile = Join-Path -Path $scriptDir -ChildPath "..\db\criar_tabelas.sql"
try { $sqlFile = Resolve-Path $sqlFile } catch { Write-Host "Arquivo SQL não encontrado em: $sqlFile" -ForegroundColor Red; exit 1 }

Write-Host "Importando schema a partir de: $sqlFile"

# Importa schema
& $mysqlExe -u $rootUser -p$rootPass < $sqlFile
if ($LASTEXITCODE -ne 0) {
    Write-Host "Erro ao executar o script SQL. Verifique usuário/senha/serviço MySQL." -ForegroundColor Red
    exit 1
}

Write-Host "Schema importado. Criando usuário 'dev' e concedendo privilégios..."

$createUserSql = "CREATE USER IF NOT EXISTS 'dev'@'127.0.0.1' IDENTIFIED BY 'DevPass123!'; GRANT ALL PRIVILEGES ON petshop_db.* TO 'dev'@'127.0.0.1'; FLUSH PRIVILEGES;"
& $mysqlExe -u $rootUser -p$rootPass -e $createUserSql
if ($LASTEXITCODE -ne 0) {
    Write-Host "Erro ao criar usuário 'dev'. Verifique permissões do usuário root." -ForegroundColor Red
    exit 1
}

Write-Host "Usuário 'dev' criado com senha 'DevPass123!' (se preferir outra senha, edite .env manualmente)."

# Cria .env na raiz do projeto

$envPath = Join-Path -Path $scriptDir -ChildPath "..\..\.env"
$envPath = (Resolve-Path $envPath -ErrorAction SilentlyContinue).Path
if (-not $envPath) { $envPath = Join-Path -Path $scriptDir -ChildPath "..\..\.env" }

$envContent = @"
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petshop_db
DB_USER=dev
DB_PASSWORD=DevPass123!
"@

Set-Content -Path $envPath -Value $envContent -Encoding UTF8
Write-Host ".env criado em: $envPath" -ForegroundColor Green
Write-Host "Setup concluído. Inicie o servidor com: powershell -NoProfile -ExecutionPolicy Bypass -File .\scripts\start-dev.ps1" -ForegroundColor Green
