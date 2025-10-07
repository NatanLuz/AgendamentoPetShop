Param()

$projectRoot = Resolve-Path (Join-Path -Path (Split-Path -Parent $MyInvocation.MyCommand.Definition) -ChildPath "..")
Write-Host "Iniciando servidor PHP embutido em 127.0.0.1:8000 (document root = $projectRoot)"

if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    Write-Host "PHP não encontrado no PATH. Instale PHP 7.4+ e certifique-se que 'php' esteja disponível." -ForegroundColor Red
    exit 1
}

Push-Location $projectRoot
php -S 127.0.0.1:8000 -t .
Pop-Location
