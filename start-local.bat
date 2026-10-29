@echo off
setlocal
cd /d "%~dp0"
set "JVC_PHP="
if exist "C:\xampp\php\php.exe" set "JVC_PHP=C:\xampp\php\php.exe"
if exist "D:\xampp\php\php.exe" set "JVC_PHP=D:\xampp\php\php.exe"
if exist "D:\P\php\php.exe" set "JVC_PHP=D:\P\php\php.exe"
if exist "D:\P\xampp\php\php.exe" set "JVC_PHP=D:\P\xampp\php\php.exe"
if not defined JVC_PHP (
  where php.exe >nul 2>nul
  if not errorlevel 1 set "JVC_PHP=php.exe"
)
if not defined JVC_PHP (
  echo PHP could not be found. Run XAMPP and place this folder under htdocs.
  echo Then open http://localhost/disciple-vision-site/
  pause
  exit /b 1
)
echo Starting Jeja Vision Church local site on http://127.0.0.1:8777
start "JVC Local Server" "%JVC_PHP%" -S 127.0.0.1:8777 -t "%~dp0"
timeout /t 2 /nobreak >nul
start "" "http://127.0.0.1:8777/"
endlocal
