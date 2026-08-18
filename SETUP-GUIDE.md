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

3. **HeidiSQL** (Tool Database) - Optional
   - Download: https://www.heidisql.com/download.php
   - Untuk import database (lebih mudah)

4. **Git** (Untuk clone project)
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

#### Pakai HeidiSQL (Recommended):
1. Buka **HeidiSQL**
2. Klik **"New"** → isi:
   - Host: `127.0.0.1`
   - User: `root`
   - Password: *(password MySQL yang sudah dibuat saat install)*
3. Klik **"Open"**
4. Klik kanan → **"Create new"** → **"Database"**
5. Nama: `simpakda`
6. Klik database `simpakda`
7. Menu: **File** → **"Run SQL file..."**
8. Pilih file `database/simpakda.sql`
9. Tunggu sampai selesai

#### Pakai Command Line:
```bash
mysql -u root -p
CREATE DATABASE simpakda;
EXIT;

mysql -u root -p simpakda < database/simpakda.sql
```

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

### 6. Jalankan Aplikasi

1. Buka **Herd**
2. Project akan otomatis terdeteksi
3. Klik untuk membuka di browser

---

## Struktur Folder

```
simpakda/
├── app/              # Kode aplikasi
├── database/
│   └── simpakda.sql  # File database untuk di-import
├── public/           # Folder publik
├── resources/        # View & assets
├── setup.bat        # Script setup otomatis
├── .env             # Environment (setelah setup)
└── README.md        # Panduan ini
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

---

## Perlu Bantuan?

Hubungi developer untuk troubleshooting.
