# Panduan Setup Simpakda

## Persyaratan Sistem

### Software yang Harus Diinstall

1. **Herd** (Web Server)
   - Download: https://herd.laravel.com
   - Install seperti biasa

2. **MySQL Community Server** (Database)
   - Download: https://dev.mysql.com/downloads/mysql/
   - Pilih: Windows (x86, 64-bit), MSI Installer
   - Installasi: Typical → Next → Finish
   - Catat password root MySQL

3. **Git** (Untuk clone project)
   - Download: https://git-scm.com/download/win

---

## Langkah Setup

### 1. Install Software
Install semua software di atas di komputer baru.

### 2. Clone / Copy Project
```bash
git clone https://github.com/USERNAME/simpakda.git
cd simpakda
```

Atau copy folder project dari komputer lama.

### 3. Jalankan Setup Otomatis
**Double-click file `setup.bat`**

Script akan otomatis:
- ✅ Install PHP dependencies
- ✅ Install JavaScript dependencies
- ✅ Build assets
- ✅ Setup file .env
- ✅ Generate application key
- ✅ Clear cache

### 4. Setup Database

Buka **HeidiSQL**:
1. Klik **"New"** → isi:
   - Host: `127.0.0.1`
   - User: `root`
   - Password: *(password MySQL yang sudah dibuat saat install)*
2. Klik **"Open"**
3. Klik kanan → **"Create new"** → **"Database"**
4. Nama: `simpakda`
5. Klik database `simpakda`
6. Menu: **File** → **"Run SQL file..."**
7. Pilih file `database/simpakda.sql`
8. Tunggu sampai selesai

### 5. Update File .env

Buka file `.env` di folder project, update bagian ini:

```env
APP_NAME=Simpakda
APP_URL=http://simpakda.test
APP_ENV=local

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpakda
DB_USERNAME=root
DB_PASSWORD=  <-- isi password MySQL kamu
```

### 6. Buat Admin User

**Penting:** Registration sudah dinonaktifkan. Hanya admin yang sudah dibuat yang bisa login.

Buka terminal di folder project, ketik:

```bash
php artisan admin:create admin@perusahaan.com "Nama Admin"
```

Contoh:
```bash
php artisan admin:create admin@simpakda.id "Budi Santoso"
```

Akan muncul password yang digenerate otomatis. **Simpan password ini!**

### 7. Jalankan Aplikasi

1. Buka **Herd**
2. Project akan otomatis terdeteksi
3. Klik untuk membuka di browser
4. Login dengan email dan password admin

---

## Mengelola Admin

### Lihat daftar admin:
```bash
php artisan admin:list
```

### Reset password admin:
```bash
php artisan admin:reset admin@email.com
```

---

## Troubleshooting

### Error: "MySQL Server not found"
- Pastikan MySQL sudah running
- Buka **Services** → cari **MySQL** → Start

### Error: "Access denied for user 'root'"
- Password MySQL salah
- Update password di file `.env`

### Error: "Database 'simpakda' not found"
- Database belum di-import
- Ikuti langkah **4. Setup Database**

### Error: "Vite manifest not found"
- Jalankan ulang `setup.bat`
- Atau ketik manual:
  ```bash
  npm run build
  ```

### Error: "These credentials do not match our records"
- Pastikan email dan password admin benar
- Cek apakah email sudah dibuat dengan `admin:create`

---

## Keamanan

- Registration dinonaktifkan — hanya admin yang bisa login
- Password admin di-generate secara acak saat pembuatan
- Simpan password di tempat yang aman
- Jangan share credentials ke orang yang tidak berwenang

---

## Struktur Folder

```
simpakda/
├── app/
│   └── Console/
│       └── Commands/
│           └── CreateAdmin.php   # Command buat admin
├── database/
│   └── simpakda.sql             # File database untuk di-import
├── public/                      # Folder publik
├── resources/                  # View & assets
├── setup.bat                   # Script setup otomatis
├── .env                        # Environment (setelah setup)
└── SETUP-GUIDE.md             # Panduan ini
```

---

## Perlu Bantuan?

Hubungi developer untuk troubleshooting.
