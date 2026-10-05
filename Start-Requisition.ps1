$ErrorActionPreference = 'Stop'
$root = $PSScriptRoot
function Test-LocalPort($port) {
    $client = New-Object Net.Sockets.TcpClient
    try { $client.Connect('127.0.0.1', $port); return $true } catch { return $false } finally { $client.Dispose() }
}
if (!(Test-LocalPort 3307)) {
    Start-Process -FilePath "$root\runtime\mariadb-10.11.10-winx64\bin\mysqld.exe" -ArgumentList "`"--defaults-file=$root\runtime\db-data\my.ini`"", '--bind-address=127.0.0.1', '--sql-mode=', '--console' -WindowStyle Hidden -RedirectStandardOutput "$root\runtime\logs\database.out.log" -RedirectStandardError "$root\runtime\logs\database.err.log"
    for ($attempt=0; $attempt -lt 30 -and !(Test-LocalPort 3307); $attempt++) { Start-Sleep -Milliseconds 500 }
    if (!(Test-LocalPort 3307)) { throw 'Database did not start. See runtime\logs\database.err.log.' }
}
if (!(Test-LocalPort 8080)) {
    Start-Process -FilePath "$root\runtime\php\php.exe" -ArgumentList '-c', "`"$root\runtime\php\php.ini`"", '-S', '127.0.0.1:8080', '-t', "`"$root\CBRMS_AIBL`"" -WindowStyle Hidden -RedirectStandardOutput "$root\runtime\logs\web.out.log" -RedirectStandardError "$root\runtime\logs\web.err.log"
    for ($attempt=0; $attempt -lt 20 -and !(Test-LocalPort 8080); $attempt++) { Start-Sleep -Milliseconds 500 }
    if (!(Test-LocalPort 8080)) { throw 'Website did not start. See runtime\logs\web.err.log.' }
}
try { Start-Process 'http://127.0.0.1:8080/net/net_signin.php' } catch {
    Write-Host 'Open http://127.0.0.1:8080/net/net_signin.php in your browser.'
}
Write-Host 'Requisition software is running at http://127.0.0.1:8080'
