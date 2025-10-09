@echo off
"C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe" -NoProfile -ExecutionPolicy Bypass -File "C:\xampp\htdocs\sitec\scripts\site_smoke_tests.ps1" -BaseUrl http://localhost/sitec/ -MaxPages 200 -MaxDepth 6 -OutDir "C:\xampp\htdocs\sitec\scripts\reports" -RequestTimeoutSec 12 -TestContactForm -ContactPath /contacto/
exit /b 0



