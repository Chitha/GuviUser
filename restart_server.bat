@echo off
taskkill /F /IM php.exe
php -S localhost:8000
