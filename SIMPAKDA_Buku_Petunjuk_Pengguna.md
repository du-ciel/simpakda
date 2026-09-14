# Buku Petunjuk Pengguna (User Manual) SIMPAKDA
## Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor
**Versi Sistem:** 1.0 (Edisi Pembaruan 2026)  
**Klasifikasi Dokumen:** Buku Petunjuk Operasional & Administrasi Sistem  
**Target Pengguna:** Administrator Sistem, Pengelola Aset/Armada, Bagian Keuangan & Umum  

---

## Daftar Isi
1. [Bab 1: Pendahuluan](#bab-1-pendahuluan)
   - 1.1 [Latar Belakang & Deskripsi Sistem](#11-latar-belakang--deskripsi-sistem)
   - 1.2 [Tujuan & Manfaat SIMPAKDA](#12-tujuan--manfaat-simpakda)
   - 1.3 [Arsitektur & Teknologi (Tech Stack)](#13-arsitektur--teknologi-tech-stack)
   - 1.4 [Hak Akses & Pengguna Sasaran](#14-hak-akses--pengguna-sasaran)
2. [Bab 2: Persyaratan Sistem & Prosedur Instalasi](#bab-2-persyaratan-sistem--prosedur-instalasi)
   - 2.1 [Persyaratan Perangkat Keras (Hardware)](#21-persyaratan-perangkat-keras-hardware)
   - 2.2 [Persyaratan Perangkat Lunak (Software)](#22-persyaratan-perangkat-lunak-software)
   - 2.3 [Langkah Instalasi & Setup Cepat](#23-langkah-instalasi--setup-cepat)
   - 2.4 [Konfigurasi Database & Environment](#24-konfigurasi-database--environment)
   - 2.5 [Pembuatan Akun Administrator Awal via CLI](#25-pembuatan-akun-administrator-awal-via-cli)
3. [Bab 3: Otentikasi & Keamanan Pengguna](#bab-3-otentikasi--keamanan-pengguna)
   - 3.1 [Kebijakan Registrasi Tertutup](#31-kebijakan-registrasi-tertutup)
   - 3.2 [Prosedur Masuk Sistem (Login)](#32-prosedur-masuk-sistem-login)
   - 3.3 [Otentikasi Dua Faktor (Two-Factor Authentication / 2FA)](#33-otentikasi-dua-faktor-two-factor-authentication--2fa)
   - 3.4 [Masuk Tanpa Sandi dengan Kunci Sandi (Passkeys / WebAuthn)](#34-masuk-tanpa-sandi-dengan-kunci-sandi-passkeys--webauthn)
   - 3.5 [Pengaturan Profil Pengguna](#35-pengaturan-profil-pengguna)
   - 3.6 [Pengaturan Preferensi Tampilan (Light / Dark Mode)](#36-pengaturan-preferensi-tampilan-light--dark-mode)
   - 3.7 [Prosedur Keluar Sistem (Logout)](#37-prosedur-keluar-sistem-logout)
4. [Bab 4: Navigasi Antarmuka & Halaman Publik](#bab-4-navigasi-antarmuka--halaman-publik)
   - 4.1 [Halaman Depan Publik (Landing Page)](#41-halaman-depan-publik-landing-page)
   - 4.2 [Halaman Pusat Informasi Fitur (`/fitur`)](#42-halaman-pusat-informasi-fitur-fitur)
   - 4.3 [Struktur Menu Navigasi Utama (Sidebar & Header)](#43-struktur-menu-navigasi-utama-sidebar--header)
5. [Bab 5: Modul Dashboard (Pusat Kendali Operasional)](#bab-5-modul-dashboard-pusat-kendali-operasional)
   - 5.1 [Ringkasan Eksekutif & Header Waktu Lokal](#51-ringkasan-eksekutif--header-waktu-lokal)
   - 5.2 [4 Kartu Statistik Utama (KPI Armada)](#52-4-kartu-statistik-utama-kpi-armada)
   - 5.3 [Panel Rekapitulasi Komposisi Armada](#53-panel-rekapitulasi-komposisi-armada)
   - 5.4 [Akses Cepat (Quick Action Shortcuts)](#54-akses-cepat-quick-action-shortcuts)
6. [Bab 6: Modul Manajemen Kendaraan](#bab-6-modul-manajemen-kendaraan)
   - 6.1 [Melihat Daftar Kendaraan & Navigasi Data](#61-melihat-daftar-kendaraan--navigasi-data)
   - 6.2 [Pencarian & Multi-Filtering Lanjutan](#62-pencarian--multi-filtering-lanjutan)
   - 6.3 [Prosedur Menambah Kendaraan Baru](#63-prosedur-menambah-kendaraan-baru)
   - 6.4 [Struktur Field Formulir Kendaraan & Validasi](#64-struktur-field-formulir-kendaraan--validasi)
   - 6.5 [Melihat Detail Spesifikasi Kendaraan](#65-melihat-detail-spesifikasi-kendaraan)
   - 6.6 [Audit Trail: Riwayat Perubahan Data (Vehicle History)](#66-audit-trail-riwayat-perubahan-data-vehicle-history)
   - 6.7 [Prosedur Mengubah (Edit) Data Kendaraan](#67-prosedur-mengubah-edit-data-kendaraan)
   - 6.8 [Prosedur Menghapus (Delete) Kendaraan](#68-prosedur-menghapus-delete-kendaraan)
   - 6.9 [Ekspor Data Kendaraan (Excel, CSV, PDF)](#69-ekspor-data-kendaraan-excel-csv-pdf)
7. [Bab 7: Modul Monitoring Armada](#bab-7-modul-monitoring-armada)
   - 7.1 [Konsep Pemantauan Dokumen Legalitas](#71-konsep-pemantauan-dokumen-legalitas)
   - 7.2 [Panel Pajak Jatuh Tempo Tahun Berjalan](#72-panel-pajak-jatuh-tempo-tahun-berjalan)
   - 7.3 [Fitur Perpanjangan Cepat: Tombol "Sudah Dibayar"](#73-fitur-perpanjangan-cepat-tombol-sudah-dibayar)
   - 7.4 [Panel Peringatan Dini (Pajak Akan Jatuh Tempo 21 Hari)](#74-panel-peringatan-dini-pajak-akan-jatuh-tempo-21-hari)
   - 7.5 [Panel Pengawasan Kendaraan Non-Aktif & Perbaikan](#75-panel-pengawasan-kendaraan-non-aktif--perbaikan)
8. [Bab 8: Modul Anggaran Finansial](#bab-8-modul-anggaran-finansial)
   - 8.1 [Ringkasan Anggaran Finansial Armada](#81-ringkasan-anggaran-finansial-armada)
   - 8.2 [Pemfilteran Anggaran Berdasarkan Sumber & Kategori](#82-pemfilteran-anggaran-berdasarkan-sumber--kategori)
   - 8.3 [Tabel Rincian Anggaran per Unit Kendaraan](#83-tabel-rincian-anggaran-per-unit-kendaraan)
   - 8.4 [Ekspor Laporan Anggaran ke PDF](#84-ekspor-laporan-anggaran-ke-pdf)
   - 8.5 [Pengelolaan & Pembaruan Biaya](#85-pengelolaan--pembaruan-biaya)
9. [Bab 9: Modul Penyusutan Kendaraan (Asset Depreciation)](#bab-9-modul-penyusutan-kendaraan-asset-depreciation)
   - 9.1 [Dasar Akuntansi & Metode Garis Lurus (Straight-Line)](#91-dasar-akuntansi--metode-garis-lurus-straight-line)
   - 9.2 [Klasifikasi Kelompok Aset, Masa Manfaat & Tarif](#92-klasifikasi-kelompok-aset-masa-manfaat--tarif)
   - 9.3 [Formula Matematis Perhitungan Penyusutan](#93-formula-matematis-perhitungan-penyusutan)
   - 9.4 [Status Penyusutan Otomatis & Indikator Warna](#94-status-penyusutan-otomatis--indikator-warna)
   - 9.5 [Daftar Penyusutan & Multi-Filtering](#95-daftar-penyusutan--multi-filtering)
   - 9.6 [Formulir Input & Konfigurasi Penyusutan Kendaraan](#96-formulir-input--konfigurasi-penyusutan-kendaraan)
   - 9.7 [Ekspor Laporan Penyusutan ke Excel (.XLSX)](#97-ekspor-laporan-penyusutan-ke-excel-xlsx)
10. [Bab 10: Pemeliharaan Sistem & Perintah Administrator](#bab-10-pemeliharaan-sistem--perintah-administrator)
    - 10.1 [Manajemen Administrator via Artisan CLI](#101-manajemen-administrator-via-artisan-cli)
    - 10.2 [Prosedur Cadangan Database (Backup DB)](#102-prosedur-cadangan-database-backup-db)
    - 10.3 [Prosedur Pemulihan Database (Restore DB)](#103-prosedur-pemulihan-database-restore-db)
    - 10.4 [Panduan Penggunaan HeidiSQL](#104-panduan-penggunaan-heidisql)
11. [Bab 11: Pemecahan Masalah (Troubleshooting & FAQ)](#bab-11-pemecahan-masalah-troubleshooting--faq)
    - 11.1 [Masalah Koneksi MySQL & Hak Akses Root](#111-masalah-koneksi-mysql--hak-akses-root)
    - 11.2 [Masalah Kompilasi Asset ("Vite Manifest Not Found")](#112-masalah-kompilasi-asset-vite-manifest-not-found)
    - 11.3 [Gagal Masuk ("These Credentials Do Not Match")](#113-gagal-masuk-these-credentials-do-not-match)
    - 11.4 [Pembersihan Cache Aplikasi & Konfigurasi](#114-pembersihan-cache-aplikasi--konfigurasi)
12. [Bab 12: Glosarium Istilah](#bab-12-glosarium-istilah)

---

# Bab 1: Pendahuluan

### 1.1 Latar Belakang & Deskripsi Sistem
Pengelolaan aset bergerak seperti kendaraan dinas dan operasional pada instansi pemerintah maupun korporasi menuntut ketelitian tinggi, terutama menyangkut legalitas surat kendaraan (Pajak Tahunan dan STNK 5 Tahunan), peruntukan pemakai, alokasi anggaran, hingga perhitungan penyusutan nilai aset dalam neraca akuntansi keuangan. Keterlambatan pembayaran pajak berdampak pada denda administrasi, sedangkan hilangnya pencatatan nilai perolehan dan umur ekonomis aset menghambat penyusunan laporan pertanggungjawaban BPK atau audit internal.

**SIMPAKDA** (*Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor*) hadir sebagai platform komprehensif berbasis web untuk mengonsolidasikan seluruh data kendaraan secara terpusat, menyajikan peringatan dini (early warning system) jatuh tempo pajak secara real-time, merekapitulasi anggaran operasional, dan menghitung depresiasi aset secara otomatis dengan metode garis lurus.

### 1.2 Tujuan & Manfaat SIMPAKDA
* **Sentralisasi Data Armada:** Menghilangkan pencatatan manual berbasis kertas atau spreadsheet parsial.
* **Pencegahan Denda Pajak:** Memberikan notifikasi visual jelas untuk kendaraan yang pajaknya akan jatuh tempo dalam 21 hari ke depan maupun yang telah melewati batas waktu.
* **Penyelesaian Cepat Administrasi:** Fitur satu-klik untuk memperbarui masa berlaku pajak satu tahun ke depan secara otomatis.
* **Transparansi Keuangan & Anggaran:** Mengetahui beban biaya operasional dan biaya plat/STNK berdasarkan sumber pendanaan (APBD atau APBN).
* **Otomasi Akuntansi Aset:** Menyediakan kalkulasi penyusutan tahunan, akumulasi beban penyusutan, dan nilai buku saat ini tanpa rumus manual.
* **Audit Trail Lengkap:** Mencatat riwayat setiap perubahan data (siapa yang mengubah, kapan, dan nilai apa yang berubah).

### 1.3 Arsitektur & Teknologi (Tech Stack)
Aplikasi SIMPAKDA dibangun menggunakan standar arsitektur modern berkinerja tinggi:
* **Backend Framework:** Laravel 12 (PHP 8.2+) dengan arsitektur MVC (Model-View-Controller).
* **Frontend Engine:** Blade Template terintegrasi dengan Livewire 3 untuk reaktivitas dinamis tanpa reload halaman penuh.
* **Komponen UI:** Flux UI dengan utilitas Tailwind CSS, didukung palet modern *Deep Navy/Slate* serta ambient backdrop glow effects.
* **Basis Data:** MySQL Relational Database dengan pengindeksan optimal untuk query status pajak dan monitoring.
* **Pencetakan Dokumen (PDF):** `barryvdh/laravel-dompdf` menghasilkan dokumen PDF berstandar A4 Landscape resmi.
* **Ekspor Spreadsheet (Excel/CSV):** FastExcel (`rap2hpoutre/fast-excel` / OpenSpout) untuk ekspor data berkecepatan tinggi dengan penggunaan memori minimal.
* **Keamanan Otentikasi:** Laravel Fortify, WebAuthn Passkeys (FIDO2), dan Two-Factor Authentication (2FA TOTP).

### 1.4 Hak Akses & Pengguna Sasaran
1. **Administrator Sistem (Super Admin):** Memiliki hak penuh untuk mengelola pengguna, menjalankan perintah CLI, melakukan ekspor/backup basis data, dan mengonfigurasi pengaturan global.
2. **Pengelola Aset / Pengurus Barang:** Bertanggung jawab atas pendaftaran unit baru, pembaruan data pemakai, pemantauan fisik, serta pengawasan perbaikan kendaraan.
3. **Bagian Keuangan & Pajak:** Bertanggung jawab memonitor tanggal jatuh tempo pembayaran pajak/STNK, mengeksekusi aksi pajak terbayar, memantau realisasi anggaran APBD/APBN, dan mengunduh laporan penyusutan nilai aset.

---

# Bab 2: Persyaratan Sistem & Prosedur Instalasi

### 2.1 Persyaratan Perangkat Keras (Hardware)
* **Prosesor:** Minimal Dual-Core 2.0 GHz (Disarankan Quad-Core 2.5 GHz atau lebih tinggi).
* **Memori (RAM):** Minimal 4 GB (Disarankan 8 GB ke atas).
* **Penyimpanan (Disk):** Minimal 2 GB ruang kosong untuk aplikasi, dependensi vendor, dan basis data.
* **Resolusi Layar:** Minimal 1366 x 768 piksel (Optimal pada 1920 x 1080 piksel, antarmuka responsif pada perangkat tablet dan mobile).

### 2.2 Persyaratan Perangkat Lunak (Software)
* **Sistem Operasi:** Windows 10/11 (64-bit), Linux Ubuntu 20.04+, atau macOS Sonoma+.
* **Web Server & Runtime:** Laravel Herd (sangat direkomendasikan untuk Windows/Mac) atau PHP 8.2+ mandiri dengan ekstensi: `pdo_mysql`, `zip`, `mbstring`, `openssl`, `curl`, `gd`.
* **Database Server:** MySQL Community Server 8.0+ atau MariaDB 10.4+.
* **Dependency Manager:** Composer 2.7+ dan Node.js 18+ (dengan NPM).
* **Database Client GUI:** HeidiSQL, DBeaver, atau phpMyAdmin.
* **Peramban Web (Browser):** Google Chrome, Microsoft Edge, Mozilla Firefox, atau Safari versi terbaru.

### 2.3 Langkah Instalasi & Setup Cepat
Di lingkungan Windows menggunakan Laravel Herd:

1. **Unduh / Salin Berkas Proyek:**
   Tempatkan folder proyek pada direktori web server (contoh: `C:\Users\<User>\Herd\simpakdafix`).
2. **Jalankan Skrip Otomasi:**
   Buka folder proyek dan klik ganda pada berkas **`setup.bat`**, atau jalankan perintah manual berikut pada terminal:
   ```bash
   composer install
   npm install
   npm run build
   copy .env.example .env
   php artisan key:generate
   ```

### 2.4 Konfigurasi Database & Environment
Buka berkas `.env` yang berada di akar folder proyek, lalu sesuaikan parameter database MySQL Anda:
```env
APP_NAME=Simpakda
APP_URL=http://simpakda.test
APP_ENV=local

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpakda
DB_USERNAME=root
DB_PASSWORD=rahasia_anda
```

**Langkah Impor Basis Data via HeidiSQL:**
1. Buka HeidiSQL, buat sesi baru dengan Host `127.0.0.1`, User `root`, dan password Anda.
2. Klik kanan pada panel kiri -> **Create new** -> **Database** -> beri nama `simpakda`.
3. Klik database `simpakda`.
4. Buka menu **File** -> **Run SQL file...** -> arahkan ke berkas `database/simpakda.sql`.
5. Tunggu hingga proses impor selesai (tabel `vehicles`, `depreciations`, `vehicle_histories`, `users`, dll. akan terbentuk lengkap beserta data awal).

### 2.5 Pembuatan Akun Administrator Awal via CLI
Karena fitur pendaftaran publik dinonaktifkan demi keamanan integritas data, akun administrator dibuat menggunakan perintah Artisan:
```bash
php artisan admin:create admin@simpakda.id "Administrator Utama"
```
Sistem akan membuat user dengan email tersebut, menandainya sebagai terverifikasi, dan mencetak sandi acak berkekuatan tinggi di terminal. Catat dan simpan kredensial ini di tempat aman.

---

# Bab 3: Otentikasi & Keamanan Pengguna

### 3.1 Kebijakan Registrasi Tertutup
Halaman pendaftaran (`/register`) sengaja dinonaktifkan. Pengguna luar tidak dapat mendaftar sendiri. Akses ke dalam sistem hanya dapat diberikan oleh Administrator yang berwenang melalui CLI server. Hal ini menjamin bahwa seluruh data kendaraan dinas terlindungi dari akses publik yang tidak berhak.

### 3.2 Prosedur Masuk Sistem (Login)
1. Buka peramban dan akses alamat SIMPAKDA (misal: `http://simpakda.test` atau `http://localhost:8000`).
2. Di pojok kanan atas halaman beranda, klik tombol **"Masuk Sistem"** atau kunjungi langsung URL `/login`.
3. Masukkan **Alamat Email** dan **Kata Sandi**.
4. Centang kotak **"Ingat saya"** jika ingin mempertahankan sesi login di perangkat pribadi.
5. Klik tombol **"Masuk"**.
6. Sistem memvalidasi kredensial. Jika valid, pengguna akan langsung dialihkan ke **Dashboard**.

### 3.3 Otentikasi Dua Faktor (Two-Factor Authentication / 2FA)
Untuk menjamin keamanan akun tingkat tinggi, SIMPAKDA dilengkapi fitur 2FA berbasis standar TOTP:
1. Klik nama profil pengguna di sudut atas, pilih **Settings** -> tab **Security**.
2. Pada bagian **Two-Factor Authentication**, klik tombol **Enable 2FA**.
3. Sistem akan meminta konfirmasi sandi saat ini.
4. Buka aplikasi authenticator di ponsel Anda (seperti Google Authenticator, Microsoft Authenticator, atau Authy), lalu pindai **QR Code** yang tampil pada layar.
5. Masukkan 6 digit kode token dari ponsel untuk memverifikasi.
6. Simpan daftar **Recovery Codes** (Kode Pemulihan) darurat yang diberikan. Kode ini digunakan jika ponsel hilang atau rusak.

### 3.4 Masuk Tanpa Sandi dengan Kunci Sandi (Passkeys / WebAuthn)
Pengguna dapat mengaktifkan login biometrik (Windows Hello, sensor sidik jari, Touch ID, atau FIDO2 Security Key):
1. Pada menu **Settings** -> tab **Security**.
2. Di bagian **Passkeys**, klik tombol **Register New Passkey**.
3. Ikuti dialog keamanan bawaan sistem operasi / browser untuk memindai sidik jari atau PIN perangkat.
4. Setelah terdaftar, Anda dapat masuk ke SIMPAKDA dalam hitungan detik tanpa perlu mengetik kata sandi manual.

### 3.5 Pengaturan Profil Pengguna
1. Buka menu **Settings** -> tab **Profile**.
2. Anda dapat memperbarui:
   * **Nama Lengkap:** Nama yang ditampilkan pada kartu riwayat perubahan audit trail.
   * **Alamat Email:** Alamat email kedinasan akun Anda.
3. Klik **Save** untuk menyimpan perubahan.

### 3.6 Pengaturan Preferensi Tampilan (Light / Dark Mode)
1. Buka menu **Settings** -> tab **Appearance**.
2. Pilih mode yang diinginkan:
   * **Light (Terang):** Latar belakang bersih cerah dengan palet biru langit dan aksen cyan.
   * **Dark (Gelap):** Latar belakang *deep midnight navy* (`#020617` / `#111827`) yang nyaman bagi mata untuk penggunaan malam hari atau intensif.
   * **System:** Menyesuaikan secara otomatis dengan pengaturan tema sistem operasi komputer pengguna.

### 3.7 Prosedur Keluar Sistem (Logout)
1. Klik foto/avatar profil pengguna pada header kanan atas (atau bagian bawah sidebar).
2. Pilih opsi **"Log out"**.
3. Sesi otentikasi akan ditutup secara permanen dan pengguna diarahkan kembali ke halaman beranda/login.

---

# Bab 4: Navigasi Antarmuka & Halaman Publik

### 4.1 Halaman Depan Publik (Landing Page)
Dapat diakses di alamat utama `/`. Berisi pengantar mengenai SIMPAKDA, visualisasi mock-up antarmuka, statistik singkat keunggulan, serta tombol akses cepat:
* Tombol **"Buka Dashboard"** (jika sudah login) atau **"Masuk Sistem"** (jika belum login).
* Tombol **"Pelajari Fitur"** untuk membaca dokumentasi modul interaktif.

### 4.2 Halaman Pusat Informasi Fitur (`/fitur`)
Halaman interaktif publik yang memamerkan 4 pilar utama SIMPAKDA tanpa perlu login:
1. **Dashboard Eksekutif:** Pusat kendali statistik armada real-time.
2. **Monitoring Armada:** Radar peringatan jatuh tempo pajak dan STNK.
3. **Kelola Kendaraan:** CRUD armada komprehensif, multi-filtering, dan ekspor multi-format.
4. **Anggaran Finansial:** Visualisasi alokasi biaya per unit dan pencetakan laporan resmi.

### 4.3 Struktur Menu Navigasi Utama (Sidebar & Header)
Setelah pengguna masuk, navigasi utama terletak di bilah sisi kiri (Sidebar):
* **Menu Utama:**
  * 🏠 **Dashboard** (`/dashboard`): Statistik ringkasan kendaraan dan pintasan aksi.
  * 📊 **Monitoring** (`/monitoring`): Pengawasan jatuh tempo pajak dan eksekusi status pembayaran.
  * 🚚 **Kendaraan** (`/vehicles`): Basis data induk seluruh kendaraan bermotor.
  * 🧮 **Anggaran** (`/anggaran`): Rincian biaya pemeliharaan, plat/STNK, dan cetak PDF.
* **Menu Tambahan:**
  * 🥧 **Penyusutan Kendaraan** (`/penyusutan`): Modul perhitungan depresiasi aset metode garis lurus & ekspor Excel.
* **Menu Bawah / User Menu:**
  * Badge info status sistem armada.
  * Nama pengguna, avatar, tombol tautan **Settings**, dan tombol **Log out**.

---

# Bab 5: Modul Dashboard (Pusat Kendali Operasional)

Dashboard merupakan ruang kendali utama yang langsung menyambut pengguna saat pertama kali masuk ke dalam sistem.

### 5.1 Ringkasan Eksekutif & Header Waktu Lokal
Bagian atas Dashboard menampilkan kartu sambutan dengan ornamen grafis modern dan tanggal dinamis yang terformat otomatis dalam bahasa Indonesia baku (contoh: *Senin, 14 September 2026*).

### 5.2 4 Kartu Statistik Utama (KPI Armada)
Terdapat 4 kartu indikator utama yang dilengkapi ilustrasi grafis 3D khas:
1. **Total Kendaraan:** Jumlah kumulatif seluruh unit kendaraan yang tercatat di sistem.
2. **Kendaraan Aktif:** Jumlah unit armada yang berstatus operasional aktif dan siap digunakan.
3. **Pajak Belum Bayar:** Jumlah unit yang tanggal masa berlaku pajaknya telah melampaui hari ini (menunggak/kedaluwarsa).
4. **STNK Belum Bayar:** Jumlah unit yang masa berlaku plat nomor dan STNK 5 tahunannya telah habis.

### 5.3 Panel Rekapitulasi Komposisi Armada
Terletak di sisi kiri tengah Dashboard, menampilkan:
* **Persentase Rasio Aktif:** Dihitung dari `(Kendaraan Aktif / Total Kendaraan) * 100%`.
* **Animated Progress Bar:** Baris indikator visual bergradasi cyan-sky dengan efek pendaran cahaya (glow).
* **Kartu Rincian:** Membandingkan secara transparan antara armada **Aktif** dan armada **Belum Aktif** (gabungan non-aktif, perbaikan, atau proses lelang/dijual).

### 5.4 Akses Cepat (Quick Action Shortcuts)
Terletak di sisi kanan tengah Dashboard, menyediakan dua tombol pintasan utama:
* **"Lihat Daftar Kendaraan":** Melompat ke tabel data kendaraan di modul `/vehicles`.
* **"Tambah Kendaraan Baru":** Membuka langsung formulir pendaftaran unit baru di `/vehicles/create`.

---

# Bab 6: Modul Manajemen Kendaraan

Modul Kendaraan (`/vehicles`) adalah inti dari operasional SIMPAKDA yang menampung rekod induk spesifikasi teknis, dokumen, dan riwayat setiap kendaraan.

### 6.1 Melihat Daftar Kendaraan & Navigasi Data
* Menampilkan daftar seluruh unit kendaraan dalam bentuk tabel modern.
* Dilengkapi dengan pagination (10 kendaraan per halaman).
* Dilengkapi mekanisme **Query String Persistence**: saat berpindah halaman (`?page=2`), semua filter yang sedang aktif akan tetap dipertahankan.

### 6.2 Pencarian & Multi-Filtering Lanjutan
Sistem menyediakan **6 parameter filter** yang dapat dikombinasikan secara simultan:
1. **Pencarian Cepat (Search):** Mencari berdasarkan nomor polisi, merek kendaraan, tipe, atau nama pemakai secara fleksibel (*case-insensitive partial match*).
2. **Filter Kategori:** Memfilter tipe armada (contoh: *Roda 2*, *Roda 4*, *Kendaraan Laut*).
3. **Filter Status Operasional:** Pilihan status *Aktif*, *Non Aktif*, *Perbaikan*, atau *Dijual*.
4. **Filter Status Dokumen (Pajak / STNK):**
   * *Belum Bayar Pajak:* Menampilkan kendaraan dengan tanggal pajak < hari ini.
   * *Belum Bayar STNK:* Menampilkan kendaraan dengan tanggal STNK < hari ini.
5. **Filter Sumber Anggaran:** Memfilter berdasarkan sumber dana (*APBD*, *APBN*, dsb.).
6. **Filter Tahun Pemakaian:** Memfilter berdasarkan tahun perakitan/pemakaian kendaraan.
* **Tombol "Reset Filter":** Akan otomatis muncul di pojok kanan atas formulir saat ada minimal satu filter yang aktif untuk mengembalikan tabel ke tampilan awal seketika.

### 6.3 Prosedur Menambah Kendaraan Baru
1. Pada menu navigasi, klik **Kendaraan**, lalu klik tombol **"Tambah Kendaraan"** (ikon plus).
2. Formulir terbagi menjadi beberapa bagian logis. Isi seluruh kolom bertanda bintang (**\***) wajib:
3. Klik tombol **"Simpan Kendaraan"**.
4. Sistem memvalidasi keunikan nomor polisi, nomor rangka (chasis), dan nomor mesin.
5. Notifikasi sukses akan muncul dan data otomatis tercatat dalam tabel.

### 6.4 Struktur Field Formulir Kendaraan & Validasi
Berikut adalah rincian spesifikasi kolom data kendaraan:

| Kategori Data | Nama Kolom | Jenis Input | Wajib / Opsional | Keterangan & Validasi |
|---|---|---|---|---|
| **Spesifikasi** | Merek | Teks | Wajib (\*) | Nama pabrikan (misal: *Toyota*, *Honda*, *Mitsubishi*) |
| **Spesifikasi** | Tipe | Teks | Wajib (\*) | Seri model (misal: *Innova Venturer*, *Vario 160*) |
| **Spesifikasi** | Jenis | Teks | Wajib (\*) | Klasifikasi bentuk (misal: *Minibus*, *Sepeda Motor*, *Pickup*) |
| **Spesifikasi** | Bahan Bakar | Teks/Pilihan | Opsional | Pilihan: *Pertalite*, *Pertamax*, *Solar*, *Diesel*, *Listrik* |
| **Spesifikasi** | Nomor Polisi | Teks | Wajib (\*) | Nomor plat resmi. **Harus unik** di seluruh database. |
| **Spesifikasi** | Nomor Chasis | Teks | Wajib (\*) | Nomor rangka kendaraan. **Harus unik**. |
| **Spesifikasi** | Nomor Mesin | Teks | Wajib (\*) | Nomor blok mesin kendaraan. **Harus unik**. |
| **Spesifikasi** | Tahun Pemakaian | Angka (4 digit) | Wajib (\*) | Tahun perakitan/pemakaian (minimal 1990 s/d tahun berjalan) |
| **Legalitas** | Masa Berlaku Pajak | Tanggal (Datepicker) | Wajib (\*) | Tanggal batas akhir pembayaran pajak tahunan |
| **Legalitas** | Masa Berlaku STNK | Tanggal (Datepicker) | Wajib (\*) | Tanggal batas akhir masa berlaku plat & STNK 5 tahunan |
| **Pemakai** | Nama Pemakai | Teks | Wajib (\*) | Nama pejabat / staf pemegang kendaraan dinas |
| **Pemakai** | Jabatan Pemakai | Teks | Wajib (\*) | Jabatan dinas (misal: *Kepala Dinas*, *Driver Operasional*) |
| **Klasifikasi** | Kategori Utama | Pilihan | Wajib (\*) | Kategori armada: *Roda 2*, *Roda 4*, *Kendaraan Laut* |
| **Klasifikasi** | Sub Kategori | Teks | Opsional | Rincian khusus (misal: *Mobil Patroli*, *Ambulans*, *Motor Reaksi Cepat*) |
| **Keuangan** | Anggaran Biaya (Rp) | Angka | Opsional | Alokasi anggaran operasional/servis per unit (default: 0) |
| **Keuangan** | Biaya Plat/STNK (Rp) | Angka | Opsional | Alokasi estimasi biaya perpanjangan plat & STNK (default: 0) |
| **Keuangan** | Sumber Kendaraan | Pilihan/Teks | Wajib (\*) | Sumber pendanaan: *APBD*, *APBN*, *Hibah*, dll. |
| **Catatan** | Keterangan Pajak | Teks Panjang | Opsional | Catatan mengenai kendala berkas, nomor BPKB, dsb. |
| **Catatan** | Keterangan Kendaraan| Teks Panjang | Opsional | Catatan riwayat fisik, kerusakan, kelengkapan kunci, dll. |
| **Status** | Status Operasional | Pilihan | Wajib (\*) | Pilihan: `aktif`, `non_aktif`, `perbaikan`, `dijual` |

### 6.5 Melihat Detail Spesifikasi Kendaraan
1. Pada tabel kendaraan, klik tombol aksi ikon **Mata (Eye)**.
2. Halaman rincian menampilkan kartu-kartu terpisah yang memuat:
   * Kartu Spesifikasi Mesin & Rangka.
   * Kartu Kategori & Status (dengan badge warna visual).
   * Kartu Pejabat Pemegang Kendaraan.
   * Kartu Masa Berlaku Dokumen (dengan badge merah jika expired).
   * Kartu Rincian Alokasi Biaya & Sumber Dana.
   * Kartu Catatan Tambahan.
   * **Bagian Riwayat Perubahan (Audit Trail).**

### 6.6 Audit Trail: Riwayat Perubahan Data (Vehicle History)
SIMPAKDA memiliki subsistem audit trail independen di tabel `vehicle_histories`. Setiap kali terjadi pembuatan atau modifikasi data kendaraan:
* Sistem secara otomatis mendeteksi field apa saja yang berubah.
* Menyimpan siapa pengguna (**User**) yang melakukan aksi tersebut.
* Mencatat tanggal dan jam perubahan secara presisi.
* Menampilkan visual perbandingan: **[Nilai Lama] -> [Nilai Baru]** untuk setiap atribut.
* Hal ini mencegah manipulasi data tanpa jejak dan mendukung transparansi tata kelola aset pemerintah.

### 6.7 Prosedur Mengubah (Edit) Data Kendaraan
1. Klik tombol **Edit** (ikon pensil) pada tabel kendaraan atau halaman detail.
2. Ubah data yang dibutuhkan pada formulir.
3. *Ketentuan Khusus Pajak:* Jika Anda mengubah tanggal `masa_berlaku_pajak` secara manual, sistem akan otomatis mereset status stempel waktu `pajak_dibayar_at` menjadi kosong (null) agar kembali terdeteksi akurat oleh sistem monitoring.
4. Klik **"Update Kendaraan"**.
5. Setelah disimpan, sistem mengembalikan Anda ke halaman tabel dengan **seluruh kondisi filter dan halaman nomor sebelumnya tetap terjaga**.

### 6.8 Prosedur Menghapus (Delete) Kendaraan
1. Klik tombol **Hapus** (ikon tempat sampah merah) pada baris kendaraan.
2. Kotak dialog konfirmasi akan muncul: *"Apakah Anda yakin ingin menghapus data kendaraan ini?"*.
3. Klik **OK** untuk melanjutkan, atau **Batal** untuk membatalkan.
4. Data kendaraan beserta relasi penyusutan dan riwayatnya akan dibersihkan dari basis data.

### 6.9 Ekspor Data Kendaraan (Excel, CSV, PDF)
Terletak pada sudut kanan atas tabel kendaraan. Seluruh format ekspor **secara cerdas mematuhi filter yang sedang Anda terapkan**:
* **Excel (.XLSX):** Mengunduh spreadsheet lengkap menggunakan pustaka FastExcel. Sangat cocok untuk pengolahan tabel pivot atau arsip dinas.
* **CSV (.CSV):** Format teks terpisah koma berstandar internasional untuk interoperabilitas impor ke sistem aplikasi lain.
* **PDF (.PDF):** Menghasilkan dokumen cetak resmi berformat **A4 Landscape** dengan header tanggal cetak, nomor urut, nomor polisi, spesifikasi, nama pemakai, dan tanggal jatuh tempo dokumen.

---

# Bab 7: Modul Monitoring Armada

Modul Monitoring (`/monitoring`) berfungsi sebagai stasiun pengawas (radar) untuk memastikan seluruh armada memiliki dokumen pajak yang sah dan kendaraan rusak segera ditangani.

### 7.1 Konsep Pemantauan Dokumen Legalitas
Sistem mengelompokkan urgensi dokumen berdasarkan tanggal sistem saat ini (*today*):
* **Pajak Jatuh Tempo Tahun Ini:** Kendaraan yang kewajiban pajaknya jatuh tempo dalam tahun kalender berjalan.
* **Pajak Mendesak (Expiring Soon):** Kendaraan yang masa berlaku pajaknya akan habis dalam waktu **21 hari ke depan** (3 minggu).
* **Pajak Kedaluwarsa (Expired):** Kendaraan yang tanggal pajaknya telah lewat dari hari ini.
* **Non-Aktif / Perbaikan:** Kendaraan yang sedang tidak laik jalan atau dalam bengkel.

### 7.2 Panel Pajak Jatuh Tempo Tahun Berjalan
Menampilkan daftar seluruh armada yang pajaknya jatuh tempo pada tahun ini (misal: tahun 2026):
* Dilengkapi badge total unit kendaraan yang perlu diselesaikan.
* Menampilkan informasi ringkas: No. Polisi, Merek/Tipe, Nama Pemakai, serta tanggal persis jatuh tempo.
* Jika seluruh kendaraan di tahun ini telah terbayar, panel akan menampilkan pesan santai dan ikon centang hijau: *"Semua Pajak Aman!"*.

### 7.3 Fitur Perpanjangan Cepat: Tombol "Sudah Dibayar"
Ketika admin atau petugas selesai membayarkan pajak ke kantor SAMSAT:
1. Cari kendaraan terkait pada daftar monitoring.
2. Klik tombol hijau **"Sudah Dibayar"** di sebelah kanan baris kendaraan.
3. Dialog konfirmasi akan meminta persetujuan: *"Tandai pajak sudah dibayar?"*.
4. Klik **OK**.
5. **Aksi Otomatis Sistem:**
   * Tanggal masa berlaku pajak dimajukan **tepat 1 tahun ke depan** tanpa salah perhitungan tanggal akhir bulan (`addYearNoOverflow()`).
   * Stempel waktu pembayaran saat ini dicatat ke kolom `pajak_dibayar_at`.
   * Muncul notifikasi sukses yang menginformasikan tanggal jatuh tempo tahun berikutnya.
   * Status kendaraan di dashboard dan monitoring seketika berubah menjadi hijau/aman.

### 7.4 Panel Peringatan Dini (Pajak Akan Jatuh Tempo 21 Hari)
Menampilkan daftar kendaraan dengan masa berlaku pajak antara hari ini hingga 21 hari ke depan:
* Dilengkapi teks selisih waktu otomatis (contoh: *5 hari lagi*, *2 minggu lagi*).
* Memungkinkan bagian umum mempersiapkan anggaran dan berkas administrasi sebelum batas waktu terlampaui.

### 7.5 Panel Pengawasan Kendaraan Non-Aktif & Perbaikan
Menampilkan kendaraan yang statusnya adalah `perbaikan` (badge kuning), `non_aktif`, atau `dijual`:
* Memastikan pengurus barang memantau unit yang berada di bengkel rekanan.
* Mencegah kendaraan non-aktif disalahgunakan atau dicatat keliru dalam perhitungan rasio kesiapan armada.

---

# Bab 8: Modul Anggaran Finansial

Modul Anggaran (`/anggaran`) menyediakan rekapitulasi keuangan untuk memantau alokasi pembiayaan armada dinas.

### 8.1 Ringkasan Anggaran Finansial Armada
Bagian atas modul menyajikan 4 kartu ringkasan keuangan makro:
1. **Total Kendaraan:** Jumlah unit kendaraan yang masuk dalam perhitungan anggaran.
2. **Total Anggaran:** Total kumulatif biaya anggaran operasional/servis seluruh armada (dalam Rupiah).
3. **Biaya Plat / STNK:** Total estimasi biaya perpanjangan surat STNK dan plat nomor lima tahunan.
4. **Total Keseluruhan:** Penjumlahan total antara `Total Anggaran + Total Biaya Plat/STNK`.

### 8.2 Pemfilteran Anggaran Berdasarkan Sumber & Kategori
Dua dropdown filter responsif disediakan:
* **Filter Sumber Kendaraan:** Menampilkan biaya khusus armada dengan sumber dana **APBD** atau **APBN**.
* **Filter Jenis Kendaraan:** Menampilkan rincian biaya khusus armada jenis **Roda 2**, **Roda 4**, atau **Kendaraan Laut**.
* Tombol **"Reset Filter"** akan mereset tampilan kembali ke seluruh unit.

### 8.3 Tabel Rincian Anggaran per Unit Kendaraan
Tabel menampilkan data transparan per unit:
* Kolom Nomor Polisi, Merek & Tipe.
* Kolom Alokasi Anggaran (Rp).
* Kolom Biaya Plat/STNK (Rp).
* Tanggal Pajak Expires.
* Tombol pintas **"Edit"** untuk memperbarui nominal jika ada perubahan DPA/anggaran.
* **Baris Footer (Grand Total):** Otomatis menjumlahkan kolom anggaran dan plat/STNK secara dinamis sesuai baris kendaraan yang tersaring.

### 8.4 Ekspor Laporan Anggaran ke PDF
1. Terapkan filter sumber atau jenis kendaraan yang diinginkan (jika ada).
2. Klik tombol **"Cetak PDF"** di bagian header kanan atas.
3. Sistem membuat berkas `laporan-anggaran-kendaraan-[timestamp].pdf` dengan tata letak **A4 Landscape**.
4. Laporan memuat judul resmi, keterangan filter yang aktif, tabel rincian lengkap, baris total biaya, serta tanggal dan jam pencetakan.

### 8.5 Pengelolaan & Pembaruan Biaya
Untuk mengubah anggaran atau biaya plat suatu unit:
1. Klik tombol **Edit** pada baris kendaraan di tabel anggaran.
2. Anda akan dialihkan ke form edit kendaraan.
3. Perbarui nilai pada field **Anggaran Biaya (Rp)** atau **Biaya Plat/STNK (Rp)**.
4. Klik **Update**. Nilai pada modul anggaran akan langsung terakumulasi ulang.

---

# Bab 9: Modul Penyusutan Kendaraan (Asset Depreciation)

Modul Penyusutan (`/penyusutan`) merupakan modul akuntansi aset untuk menghitung penurunan nilai ekonomis kendaraan secara berkala sesuai ketentuan perundang-undangan perpajakan dan akuntansi barang milik daerah/negara.

### 9.1 Dasar Akuntansi & Metode Garis Lurus (Straight-Line)
SIMPAKDA menerapkan **Metode Garis Lurus** (*Straight-Line Method*). Pada metode ini, beban penyusutan bernilai tetap setiap tahunnya selama masa manfaat aset, sepanjang nilai perolehan tidak berubah.

Data penyusutan disimpan pada tabel independen bernama `depreciations` yang terhubung secara relasional satu-ke-satu (`HasOne`) dengan tabel kendaraan. Pemisahan ini menjaga integritas data kendaraan operasional tetap murni dari modifikasi parameter akuntansi.

### 9.2 Klasifikasi Kelompok Aset, Masa Manfaat & Tarif
Berdasarkan regulasi umum perpajakan dan aset daerah, penyusutan kendaraan terbagi menjadi:

| Kelompok Aset | Masa Manfaat | Tarif per Tahun (%) | Tarif Desimal | Deskripsi Umum |
|---|---|---|---|---|
| **Kelompok 1** | **10 Tahun** | **6.25%** | `0.0625` | Standar aset kendaraan dinas operasional umum |
| **Kelompok 2** | **10 Tahun** | **1.5625%** | `0.015625` | Aset kendaraan kategori khusus / aset berumur ekonomis panjang |

> *Catatan:* Nilai masa manfaat dan tarif telah dikunci di sisi server (controller) untuk menghindari kesalahan manipulasi manual dari peramban.

### 9.3 Formula Matematis Perhitungan Penyusutan
Berikut adalah algoritma kalkulasi yang dijalankan secara otomatis oleh SIMPAKDA:

1. **Umur Aset (Tahun):**
   $$\text{Umur Aset} = \max(0, \text{Tahun Berjalan} - \text{Tahun Perolehan})$$
2. **Beban Penyusutan per Tahun:**
   $$\text{Penyusutan Tahunan} = \text{Nilai Perolehan} \times \text{Tarif}$$
3. **Tahun yang Disusutkan:**
   $$\text{Tahun Disusutkan} = \min(\text{Umur Aset}, \text{Masa Manfaat}, 10)$$
   *(Nilai tidak boleh melebihi batas masa manfaat 10 tahun).*
4. **Akumulasi Penyusutan:**
   $$\text{Akumulasi Penyusutan} = \min(\text{Nilai Perolehan}, \text{Penyusutan Tahunan} \times \text{Tahun Disusutkan})$$
   *(Akumulasi penyusutan tidak akan pernah melebihi nilai perolehan).*
5. **Nilai Buku Bersih (Book Value):**
   $$\text{Nilai Buku} = \max(0, \text{Nilai Perolehan} - \text{Akumulasi Penyusutan})$$
   *(Nilai buku minimal adalah Rp 0 apabila aset telah habis masa manfaatnya).*

### 9.4 Status Penyusutan Otomatis & Indikator Warna
Sistem secara otomatis menyematkan label status evaluasi aset:
* 🟢 **Penyusutan Maksimal (Green):** Umur aset telah mencapai atau melewati masa manfaat (10 tahun). Akumulasi penyusutan penuh dan nilai buku Rp 0.
* 🔵 **Dalam Penyusutan (Cyan):** Aset sedang aktif dalam periode penyusutan tahunan normal.
* 🟡 **Belum Mulai (Yellow):** Kendaraan baru diperoleh pada tahun berjalan (umur 0 tahun).
* 🔴 **Tidak Ada Nilai (Red):** Nilai perolehan belum diisi atau bernilai Rp 0.
* 🟠 **Tahun/Masa Manfaat Tidak Valid (Orange):** Input tahun atau masa manfaat di luar batas wajar.
* ⚪ **Belum Ada Data (Zinc):** Kendaraan belum memiliki data konfigurasi penyusutan.

### 9.5 Daftar Penyusutan & Multi-Filtering
Tabel pada `/penyusutan` menampilkan ringkasan makro:
* Kartu **Total Kendaraan Terdaftar**.
* Kartu **Total Nilai Perolehan** seluruh armada.
* Kartu **Total Akumulasi Penyusutan** yang telah dibukukan.
* Kartu **Total Nilai Buku** saat ini.

Dilengkapi filter dropdown:
* Sumber Kendaraan (APBD/APBN).
* Kategori Kendaraan.
* Tahun Pemakaian.
* Tombol Reset Filter & Pagination 15 data per halaman dengan persistensi query URL.

### 9.6 Formulir Input & Konfigurasi Penyusutan Kendaraan
Untuk mengisi atau mengubah nilai buku kendaraan:
1. Pada tabel penyusutan, klik tombol **"Edit"** di baris kendaraan yang dipilih.
2. Halaman formulir edit penyusutan menampilkan:
   * **Informasi Kendaraan (Read-only):** Nomor polisi, merek, tipe, jenis, kategori, dan tahun pemakaian yang diambil dari master kendaraan.
   * **Nilai Perolehan (Rp):** Masukkan harga beli atau nilai perolehan awal aset (misal: `15000000` untuk Rp 15.000.000). Sistem mendukung input angka murni maupun format bertitik.
   * **Tahun Perolehan:** Tahun awal unit menjadi aset dinas (otomatis terisi dari tahun pemakaian).
   * **Kelompok Penyusutan:** Pilih dari dropdown (*Kelompok 1* atau *Kelompok 2*).
   * **Masa Manfaat & Tarif:** Terisi secara **otomatis oleh skrip JavaScript** saat dropdown kelompok dipilih.
   * **Informasi Data Tersimpan:** Kartu pratinjau yang memperlihatkan nilai saat ini sebelum Anda menyetujui perubahan.
3. Klik **"Simpan Data Penyusutan"**.
4. Data tersimpan di tabel `depreciations` dan Anda diarahkan kembali ke tabel penyusutan dengan filter halaman sebelumnya tetap terjaga.

### 9.7 Ekspor Laporan Penyusutan ke Excel (.XLSX)
1. Di bagian header kanan atas modul penyusutan, klik tombol **"Excel"** (ikon tabel).
2. Sistem mengekspor seluruh data hasil filter ke berkas spreadsheet berstandar Excel.
3. Kolom ekspor mencakup: *Nomor Polisi, Merek, Tipe, Tahun Perolehan, Kelompok Penyusutan, Nilai Perolehan (Rp), Umur Aset (Tahun), Penyusutan per Tahun (Rp), Akumulasi Penyusutan (Rp), Nilai Buku (Rp),* dan *Status Penyusutan*.

---

# Bab 10: Pemeliharaan Sistem & Perintah Administrator

### 10.1 Manajemen Administrator via Artisan CLI
Untuk mengelola akun admin secara aman tanpa antarmuka registrasi terbuka:
* **Membuat Admin Baru:**
  ```bash
  php artisan admin:create nama_admin@email.com "Nama Petugas"
  ```
  Opsi tambahan: `--password="PasswordKustom123!"` jika tidak ingin menggunakan sandi acak otomatis.

### 10.2 Prosedur Cadangan Database (Backup DB)
SIMPAKDA menyediakan perintah bawaan untuk mencadangkan seluruh struktur dan isi data basis data ke dalam format berkas SQL:
```bash
php artisan db:export
```
Perintah ini mengekspor seluruh tabel penting (mengabaikan tabel sementara seperti cache dan jobs) langsung ke berkas `database/simpakda.sql`.

Anda juga dapat menentukan nama berkas keluaran secara khusus:
```bash
php artisan db:export backup-simpakda-2026.sql
```

### 10.3 Prosedur Pemulihan Database (Restore DB)
Jika terjadi kendala pada server atau ingin memindahkan data ke komputer baru:
1. Buat database baru bernama `simpakda` di MySQL.
2. Jalankan perintah impor melalui MySQL CLI:
   ```bash
   mysql -u root -p simpakda < database/simpakda.sql
   ```
3. Atau gunakan menu **"Run SQL file..."** pada aplikasi HeidiSQL seperti dijelaskan pada Bab 2.4.

### 10.4 Panduan Penggunaan HeidiSQL
HeidiSQL disertakan sebagai alat manajemen basis data visual yang sangat ringan dan mudah digunakan:
* **Melihat Isi Tabel:** Buka sesi `127.0.0.1`, klik database `simpakda`, pilih tabel `vehicles` lalu buka tab **Data**.
* **Ekspor Cepat:** Klik kanan database `simpakda` -> **Export database as SQL**.

---

# Bab 11: Pemecahan Masalah (Troubleshooting & FAQ)

### 11.1 Masalah Koneksi MySQL & Hak Akses Root
* **Gejala:** Muncul pesan error *"SQLSTATE[HY000] [2002] Connection refused"* atau *"Access denied for user 'root'@'localhost'"*.
* **Solusi:**
  1. Buka aplikasi **Services** di Windows (`services.msc`).
  2. Cari layanan **MySQL** atau **MySQL80**, klik kanan lalu pilih **Start**.
  3. Buka file `.env`, pastikan `DB_PASSWORD=` telah diisi sesuai dengan kata sandi root MySQL Anda.

### 11.2 Masalah Kompilasi Asset ("Vite Manifest Not Found")
* **Gejala:** Tampilan peramban blank putih dengan pesan *"Vite manifest not found at [...]/public/build/manifest.json"*.
* **Solusi:**
  Aset CSS dan JavaScript belum dikompilasi ke folder publik. Buka terminal di folder aplikasi dan jalankan:
  ```bash
  npm run build
  ```

### 11.3 Gagal Masuk ("These Credentials Do Not Match")
* **Gejala:** Muncul peringatan *"These credentials do not match our records"* di halaman login.
* **Solusi:**
  1. Pastikan penulisan email dan password tidak menyertakan spasi ekstra di awal atau akhir.
  2. Buat user admin baru menggunakan perintah `php artisan admin:create email_baru@simpakda.id "Nama Baru"`.

### 11.4 Pembersihan Cache Aplikasi & Konfigurasi
* **Gejala:** Perubahan konfigurasi di file `.env` tidak berdampak pada aplikasi, atau rute menu baru tidak terbaca.
* **Solusi:**
  Jalankan perintah pembersihan menyeluruh pada terminal proyek:
  ```bash
  php artisan optimize:clear
  ```
  Perintah ini membersihkan cache konfigurasi, cache rute web, cache view blade, dan cache event dalam satu langkah cepat.

---

# Bab 12: Glosarium Istilah

* **SIMPAKDA:** Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor.
* **Masa Berlaku Pajak:** Batas tanggal pembayaran Pajak Kendaraan Bermotor (PKB) tahunan yang tertera pada lembar SKPD (Surat Ketetapan Pajak Daerah).
* **Masa Berlaku STNK:** Batas akhir berlakunya Surat Tanda Nomor Kendaraan dan plat tanda nomor kendaraan bermotor (periode 5 tahun sekali).
* **Pajak Jatuh Tempo:** Kondisi di mana tanggal kewajiban pembayaran pajak berada pada rentang tahun berjalan atau mendekati batas akhir pembayaran.
* **APBD / APBN:** Anggaran Pendapatan dan Belanja Daerah / Negara; sumber pembiayaan resmi pengadaan dan pemeliharaan armada dinas.
* **Audit Trail (Vehicle History):** Catatan log otomatis yang merekam riwayat seluruh perubahan atribut data, termasuk nama pelaku dan timestamp.
* **Metode Garis Lurus (Straight-Line):** Metode depresiasi akuntansi di mana nilai aset dikurangi secara merata setiap tahun selama taksiran masa manfaat ekonomisnya.
* **Nilai Perolehan:** Total biaya yang dikeluarkan untuk memperoleh aset hingga aset siap digunakan secara operasional.
* **Akumulasi Penyusutan:** Jumlah total pembebanan penyusutan yang telah terjadi sejak tahun perolehan hingga tahun berjalan.
* **Nilai Buku (Book Value):** Nilai bersih aset yang masih tercatat di neraca, diperoleh dari `Nilai Perolehan - Akumulasi Penyusutan`.
* **2FA (Two-Factor Authentication):** Mekanisme keamanan berlapis yang memverifikasi identitas pengguna menggunakan kombinasi kata sandi dan kode token dinamis dari aplikasi authenticator.
* **Passkeys:** Standar otentikasi FIDO/WebAuthn modern yang menggantikan sandi konvensional dengan kriptografi kunci publik menggunakan biometrik perangkat.

---
*Buku Petunjuk Pengguna SIMPAKDA v1.0 — Terakhir diperbarui: September 2026.*  
*Hak Cipta Terpelihara © 2026 Tim Pengembang SIMPAKDA.*
