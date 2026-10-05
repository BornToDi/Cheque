$ErrorActionPreference = 'Stop'
$root = $PSScriptRoot
& "$root\runtime\mariadb-10.11.10-winx64\bin\mysqladmin.exe" --host=127.0.0.1 --port=3307 --user=root shutdown
$phpPath = [IO.Path]::GetFullPath("$root\runtime\php\php.exe")
foreach ($process in @(Get-Process php -ErrorAction SilentlyContinue)) {
    if ($process.Path -eq $phpPath) {
        $process.Kill()
        $process.WaitForExit(5000) | Out-Null
    }
}
Write-Host 'Local requisition servers stopped.'
