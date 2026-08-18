@echo off
chcp 65001 >nul
title Setup Simpakda

echo ========================================
echo   Setup Simpakda - Otomatis
echo ========================================
echo.

REM Check if running as administrator
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo [INFO] Disarankan menjalankan sebagai Administrator.
    echo.
)

REM Get current directory
set PROJECT_DIR=%~dp0
cd /d "%PROJECT_DIR%"

echo [1/7] Memeriksa dependencies...
echo.

REM Check PHP
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] PHP tidak ditemukan. Pastikan Herd sudah terinstall.
    echo.
    pause
    exit /b 1
)
echo [OK] PHP terdeteksi

REM Check Composer
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Composer tidak ditemukan. Pastikan Composer sudah terinstall.
    echo.
    pause
    exit /b 1
)
echo [OK] Composer terdeteksi

REM Check Node
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Node.js tidak ditemukan. Pastikan Node.js sudah terinstall.
    echo.
    pause
    exit /b 1
)
echo [OK] Node.js terdeteksi

echo.
echo ========================================
echo.

REM Step 1: Composer Install
echo [2/7] Menginstall dependencies PHP...
composer install --no-interaction --prefer-dist
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Gagal install PHP dependencies.
    pause
    exit /b 1
)
echo [OK] PHP dependencies terinstall

echo.
echo [3/7] Menginstall dependencies JavaScript...
call npm install
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Gagal install JavaScript dependencies.
    pause
    exit /b 1
)
echo [OK] JavaScript dependencies terinstall

echo.
echo [4/7] Building assets...
call npm run build
if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Gagal build assets.
    pause
    exit /b 1
)
echo [OK] Assets ter-build

echo.
echo [5/7] Setup environment file...
if not exist ".env" (
    copy " .env.example" ".env" >nul
    echo [OK] File .env dibuat dari .env.example
) else (
    echo [SKIP] File .env sudah ada
)

echo.
echo [6/7] Generate application key...
php artisan key:generate --force
echo [OK] Application key tergenerate

echo.
echo [7/7] Clear cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo [OK] Cache dibersihkan

echo.
echo ========================================
echo.
echo   SETUP BERHASIL!
echo.
echo   Langkah selanjutnya:
echo   1. Buat database "simpakda" di MySQL
echo   2. Import file database dari folder "database\"
echo   3. Update file .env sesuai konfigurasi MySQL
echo   4. Buka aplikasi di browser
echo.
echo   Tekan tombol apapun untuk keluar...
echo ========================================
pause >nul
