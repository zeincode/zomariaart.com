@echo off
echo ================================================
echo   RESTART APACHE TO FIX CSS ISSUE
echo ================================================
echo.
echo The CSS wasn't loading because the assets folder
echo is outside the public directory.
echo.
echo I've updated the Apache virtual host configuration
echo to add an Alias for /assets directory.
echo.
echo NOW YOU MUST RESTART APACHE:
echo.
echo 1. Open XAMPP Control Panel
echo 2. Click STOP for Apache
echo 3. Click START for Apache
echo.
echo After restart, refresh your browser!
echo Your site design will appear!
echo.
pause
