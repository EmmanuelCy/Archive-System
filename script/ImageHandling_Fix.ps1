# Fix by Emmanuel Cy Coyoca

(Get-Content C:\xampp\php\php.ini) -replace ';extension=gd', 'extension=gd' | Set-Content C:\xampp\php\php.ini -ErrorAction Stop
Write-Output "php.ini file updated successfully."

Copy-Item "C:\xampp\php\ext\php_gd.dll" -Destination "C:\Windows\System32" -ErrorAction Stop
Write-Output "php_gd.dll file copied successfully."

Read-Host -Prompt "Press any key to exit"