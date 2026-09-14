<?php

/**
 * Simpakda User Manual DOCX Generator
 * Creates a complete and valid .docx file without external dependencies.
 */

function createDocx($filename)
{
    $zip = new ZipArchive();

    if ($zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die("Cannot create ZIP: $filename\n");
    }

    // --- [Content_Types].xml ---
    $contentTypes = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
    <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
    <Default Extension="xml" ContentType="application/xml"/>
    <Override PartName="/word/document.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml"/>
    <Override PartName="/word/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.styles+xml"/>
    <Override PartName="/word/settings.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.settings+xml"/>
</Types>
XML;
    $zip->addFromString('[Content_Types].xml', $contentTypes);

    // --- _rels/.rels ---
    $rels = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="word/document.xml"/>
</Relationships>
XML;
    $zip->addFromString('_rels/.rels', $rels);

    // --- word/_rels/document.xml.rels ---
    $docRels = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
</Relationships>
XML;
    $zip->addFromString('word/_rels/document.xml.rels', $docRels);

    // --- word/settings.xml ---
    $settings = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<w:settings xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">
    <w:defaultTabStop w:val="720"/>
</w:settings>
XML;
    $zip->addFromString('word/settings.xml', $settings);

    // --- word/styles.xml ---
    $styles = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<w:styles xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">
    <w:docDefaults>
        <w:rPrDefault>
            <w:rPr>
                <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri"/>
                <w:sz w:val="22"/>
                <w:szCs w:val="22"/>
            </w:rPr>
        </w:rPrDefault>
        <w:pPrDefault>
            <w:pPr>
                <w:spacing w:after="160" w:line="276" w:lineRule="auto"/>
            </w:pPr>
        </w:pPrDefault>
    </w:docDefaults>

    <w:style w:type="paragraph" w:styleId="Normal" w:default="1">
        <w:name w:val="Normal"/>
        <w:rPr>
            <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri"/>
            <w:sz w:val="22"/>
        </w:rPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Heading1">
        <w:name w:val="heading 1"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:spacing w:before="480" w:after="120"/>
        </w:pPr>
        <w:rPr>
            <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri"/>
            <w:b/>
            <w:color w:val="0B334D"/>
            <w:sz w:val="34"/>
        </w:rPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Heading2">
        <w:name w:val="heading 2"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:spacing w:before="360" w:after="80"/>
        </w:pPr>
        <w:rPr>
            <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri"/>
            <w:b/>
            <w:color w:val="0284C7"/>
            <w:sz w:val="26"/>
        </w:rPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Heading3">
        <w:name w:val="heading 3"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:spacing w:before="240" w:after="60"/>
        </w:pPr>
        <w:rPr>
            <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri"/>
            <w:b/>
            <w:color w:val="0369A1"/>
            <w:sz w:val="23"/>
        </w:rPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Centered">
        <w:name w:val="Centered"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:jc w:val="center"/>
            <w:spacing w:after="120"/>
        </w:pPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Caption">
        <w:name w:val="caption"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:jc w:val="center"/>
        </w:pPr>
        <w:rPr>
            <w:i/>
            <w:color w:val="64748B"/>
            <w:sz w:val="18"/>
        </w:rPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Bullet">
        <w:name w:val="List Bullet"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:ind w:left="720"/>
            <w:spacing w:after="60"/>
        </w:pPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="SubBullet">
        <w:name w:val="List Bullet 2"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:ind w:left="1440"/>
            <w:spacing w:after="40"/>
        </w:pPr>
    </w:style>

    <w:style w:type="paragraph" w:styleId="Callout">
        <w:name w:val="Callout Box"/>
        <w:basedOn w:val="Normal"/>
        <w:pPr>
            <w:ind w:left="720" w:right="720"/>
            <w:spacing w:before="120" w:after="120"/>
        </w:pPr>
        <w:rPr>
            <w:color w:val="0F172A"/>
            <w:sz w:val="20"/>
        </w:rPr>
    </w:style>
</w:styles>
XML;
    $zip->addFromString('word/styles.xml', $styles);

    // --- HELPER FUNCTIONS ---
    function wPara($text, $style = 'Normal', $bold = false, $color = null, $center = false, $size = null)
    {
        $rpr = '';
        if ($bold) $rpr .= '<w:b/>';
        if ($color) $rpr .= "<w:color w:val=\"$color\"/>";
        if ($size) $rpr .= "<w:sz w:val=\"$size\"/><w:szCs w:val=\"$size\"/>";
        $jc = $center ? '<w:jc w:val="center"/>' : '';
        $cleanText = htmlspecialchars($text, ENT_XML1);
        return "<w:p><w:pPr><w:pStyle w:val=\"$style\"/>$jc</w:pPr>" .
            "<w:r><w:rPr>$rpr</w:rPr><w:t xml:space=\"preserve\">$cleanText</w:t></w:r></w:p>";
    }

    function wPageBreak()
    {
        return "<w:p><w:r><w:br w:type=\"page\"/></w:r></w:p>";
    }

    function wTable(array $headers, array $rows)
    {
        $tbl = '<w:tbl>';
        $tbl .= '<w:tblPr>';
        $tbl .= '<w:tblW w:w="0" w:type="auto"/>';
        $tbl .= '<w:tblBorders>';
        $tbl .= '<w:top w:val="single" w:sz="6" w:space="0" w:color="CBD5E1"/>';
        $tbl .= '<w:left w:val="none"/>';
        $tbl .= '<w:bottom w:val="single" w:sz="10" w:space="0" w:color="0B334D"/>';
        $tbl .= '<w:right w:val="none"/>';
        $tbl .= '<w:insideH w:val="single" w:sz="4" w:space="0" w:color="E2E8F0"/>';
        $tbl .= '<w:insideV w:val="none"/>';
        $tbl .= '</w:tblBorders>';
        $tbl .= '<w:tblCellMar><w:top w:w="120" w:type="dxa"/><w:bottom w:w="120" w:type="dxa"/><w:left w:w="160" w:type="dxa"/><w:right w:w="160" w:type="dxa"/></w:tblCellMar>';
        $tbl .= '</w:tblPr>';

        if (!empty($headers)) {
            $tbl .= '<w:tr><w:trPr><w:tblHeader/></w:trPr>';
            foreach ($headers as $h) {
                $tbl .= '<w:tc><w:tcPr><w:shd w:val="clear" w:color="auto" w:fill="F1F5F9"/><w:tcBorders><w:bottom w:val="single" w:sz="8" w:space="0" w:color="0B334D"/></w:tcBorders></w:tcPr>';
                $tbl .= '<w:p><w:pPr><w:spacing w:after="60" w:before="60"/></w:pPr><w:r><w:rPr><w:b/><w:sz w:val="20"/><w:szCs w:val="20"/><w:color w:val="0B334D"/></w:rPr><w:t xml:space="preserve">' . htmlspecialchars($h, ENT_XML1) . '</w:t></w:r></w:p></w:tc>';
            }
            $tbl .= '</w:tr>';
        }

        foreach ($rows as $row) {
            $tbl .= '<w:tr>';
            foreach ($row as $cell) {
                $tbl .= '<w:tc>';
                $tbl .= '<w:p><w:pPr><w:spacing w:after="60" w:before="60"/></w:pPr><w:r><w:rPr><w:sz w:val="20"/><w:szCs w:val="20"/></w:rPr><w:t xml:space="preserve">' . htmlspecialchars($cell, ENT_XML1) . '</w:t></w:r></w:p></w:tc>';
            }
            $tbl .= '</w:tr>';
        }

        $tbl .= '</w:tbl>';
        return $tbl;
    }

    $sections = [];

    // ---- COVER PAGE ----
    $cover = '';
    $cover .= wPara('', 'Normal');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('SIMPAKDA', 'Centered', true, '0B334D', true, '72');
    $cover .= wPara('Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor', 'Centered', false, '0284C7', true, '30');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('BUKU PETUNJUK PENGGUNA (USER MANUAL)', 'Centered', true, '334155', true, '26');
    $cover .= wPara('Panduan Operasional, Administrasi Armada, Monitoring & Penyusutan Aset', 'Centered', false, '64748B', true, '22');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('[LOGO SISTEM SIMPAKDA]', 'Caption');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('', 'Normal');
    $cover .= wPara('Edisi Pembaruan 2026  |  Versi Sistem 1.0', 'Centered', true, '0284C7', true, '22');
    $cover .= wPara('Hak Cipta Terpelihara © 2026 Tim Pengembang SIMPAKDA', 'Centered', false, '64748B', true, '18');

    $sections[] = $cover;
    $sections[] = wPageBreak();

    // ---- TABLE OF CONTENTS ----
    $toc = '';
    $toc .= wPara('DAFTAR ISI', 'Heading1', true, '0B334D');
    $toc .= wPara('', 'Normal');
    $tocItems = [
        ['Bab 1', 'Pendahuluan & Gambaran Umum Sistem'],
        ['  1.1', 'Latar Belakang & Deskripsi SIMPAKDA'],
        ['  1.2', 'Tujuan & Manfaat Sistem'],
        ['  1.3', 'Arsitektur & Teknologi (Tech Stack)'],
        ['  1.4', 'Hak Akses & Pengguna Sasaran'],
        ['Bab 2', 'Persyaratan Sistem & Prosedur Instalasi'],
        ['  2.1', 'Persyaratan Perangkat Keras & Lunak'],
        ['  2.2', 'Langkah Instalasi Otomatis (setup.bat)'],
        ['  2.3', 'Konfigurasi Database & Environment (.env)'],
        ['  2.4', 'Pembuatan Akun Admin Awal via CLI'],
        ['Bab 3', 'Otentikasi & Keamanan Pengguna'],
        ['  3.1', 'Kebijakan Registrasi Tertutup'],
        ['  3.2', 'Prosedur Masuk Sistem (Login)'],
        ['  3.3', 'Otentikasi Dua Faktor (2FA TOTP)'],
        ['  3.4', 'Masuk Tanpa Sandi dengan Kunci Sandi (Passkeys)'],
        ['  3.5', 'Pengaturan Profil & Preferensi Tampilan'],
        ['  3.6', 'Prosedur Keluar Sistem (Logout)'],
        ['Bab 4', 'Navigasi Antarmuka & Halaman Publik'],
        ['  4.1', 'Halaman Beranda Publik (Landing Page)'],
        ['  4.2', 'Halaman Pusat Informasi Fitur (/fitur)'],
        ['  4.3', 'Struktur Menu Sidebar & Mobile Header'],
        ['Bab 5', 'Modul Dashboard (Pusat Kendali Operasional)'],
        ['  5.1', 'Ringkasan Eksekutif & Widget Waktu Dinamis'],
        ['  5.2', '4 Kartu Statistik Utama (KPI Armada)'],
        ['  5.3', 'Panel Rekapitulasi Komposisi Armada'],
        ['  5.4', 'Pintasan Akses Cepat (Quick Shortcuts)'],
        ['Bab 6', 'Modul Manajemen Kendaraan'],
        ['  6.1', 'Melihat Daftar Kendaraan & Navigasi Data'],
        ['  6.2', 'Pencarian & Multi-Filtering Lanjutan'],
        ['  6.3', 'Prosedur Menambah Kendaraan Baru'],
        ['  6.4', 'Struktur Field Formulir Kendaraan & Validasi'],
        ['  6.5', 'Melihat Detail Spesifikasi Kendaraan'],
        ['  6.6', 'Audit Trail: Riwayat Perubahan Data (Vehicle History)'],
        ['  6.7', 'Prosedur Mengedit Data Kendaraan'],
        ['  6.8', 'Prosedur Menghapus Data Kendaraan'],
        ['  6.9', 'Ekspor Data Kendaraan (Excel, CSV, PDF)'],
        ['Bab 7', 'Modul Monitoring Armada'],
        ['  7.1', 'Konsep Pemantauan Dokumen Legalitas'],
        ['  7.2', 'Panel Pajak Jatuh Tempo Tahun Berjalan'],
        ['  7.3', 'Fitur Perpanjangan Cepat: Tombol "Sudah Dibayar"'],
        ['  7.4', 'Panel Peringatan Dini (Jatuh Tempo 21 Hari)'],
        ['  7.5', 'Panel Pengawasan Kendaraan Non-Aktif & Perbaikan'],
        ['Bab 8', 'Modul Anggaran Finansial'],
        ['  8.1', 'Ringkasan Anggaran Finansial Armada'],
        ['  8.2', 'Pemfilteran Anggaran Sumber & Kategori'],
        ['  8.3', 'Tabel Rincian Biaya per Kendaraan & Grand Total'],
        ['  8.4', 'Ekspor Laporan Anggaran ke PDF A4 Landscape'],
        ['Bab 9', 'Modul Penyusutan Kendaraan (Asset Depreciation)'],
        ['  9.1', 'Dasar Akuntansi & Metode Garis Lurus'],
        ['  9.2', 'Klasifikasi Kelompok Aset, Masa Manfaat & Tarif'],
        ['  9.3', 'Formula Matematis Perhitungan Penyusutan'],
        ['  9.4', 'Status Penyusutan Otomatis & Indikator Warna'],
        ['  9.5', 'Daftar Penyusutan & Multi-Filtering'],
        ['  9.6', 'Formulir Input & Konfigurasi Nilai Aset'],
        ['  9.7', 'Ekspor Laporan Penyusutan ke Excel (.xlsx)'],
        ['Bab 10', 'Pemeliharaan Sistem & Perintah Administrator'],
        ['  10.1', 'Manajemen Administrator via Artisan CLI'],
        ['  10.2', 'Prosedur Backup Database Otomatis (db:export)'],
        ['  10.3', 'Prosedur Pemulihan (Restore) Database'],
        ['  10.4', 'Panduan Manajemen Basis Data via HeidiSQL'],
        ['Bab 11', 'Pemecahan Masalah (Troubleshooting & FAQ)'],
        ['Bab 12', 'Glosarium Istilah Sistem'],
    ];

    foreach ($tocItems as [$no, $title]) {
        $bold = (strlen(trim($no)) <= 6 && !str_starts_with($no, '  '));
        $dots = str_repeat('.', max(1, 60 - strlen($no) - strlen($title)));
        $text = str_pad($no, 10) . ' ' . $title . ' ' . $dots;
        $toc .= wPara($text, 'Normal', $bold, $bold ? '0B334D' : null);
    }
    $sections[] = $toc;
    $sections[] = wPageBreak();

    // ---- BAB 1: PENDAHULUAN ----
    $s1 = '';
    $s1 .= wPara('BAB 1: PENDAHULUAN', 'Heading1', true, '0B334D');
    $s1 .= wPara('1.1  Latar Belakang & Deskripsi Sistem', 'Heading2', true, '0284C7');
    $s1 .= wPara('SIMPAKDA (Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor) dirancang untuk mengintegrasikan tata kelola armada dinas, pengawasan legalitas surat-surat kendaraan, penganggaran biaya operasional, serta akuntansi depresiasi aset dalam satu platform web modern.', 'Normal');
    $s1 .= wPara('', 'Normal');
    $s1 .= wPara('1.2  Tujuan & Manfaat Utama', 'Heading2', true, '0284C7');
    $s1 .= wPara('1.  Sentralisasi data kendaraan dinas secara akurat dan transparan.', 'Bullet');
    $s1 .= wPara('2.  Sistem peringatan dini (Early Warning System) untuk mencegah denda keterlambatan pajak.', 'Bullet');
    $s1 .= wPara('3.  Kemudahan perpanjangan jatuh tempo pajak satu tahun ke depan secara otomatis dalam satu klik.', 'Bullet');
    $s1 .= wPara('4.  Pengawasan alokasi anggaran operasional dan biaya plat/STNK berdasarkan sumber dana (APBD/APBN).', 'Bullet');
    $s1 .= wPara('5.  Perhitungan penyusutan nilai aset secara otomatis menggunakan metode garis lurus untuk kepatuhan audit aset.', 'Bullet');
    $s1 .= wPara('6.  Audit trail lengkap untuk mencatat seluruh riwayat perubahan spesifikasi kendaraan.', 'Bullet');
    $s1 .= wPara('', 'Normal');
    $s1 .= wPara('1.3  Arsitektur & Teknologi (Tech Stack)', 'Heading2', true, '0284C7');
    $s1 .= wPara('Aplikasi dibangun di atas fondasi teknologi mutakhir:', 'Normal');
    $s1 .= wPara('• Backend: Laravel 12 (PHP 8.2+) dengan arsitektur MVC yang kokoh.', 'Normal');
    $s1 .= wPara('• Frontend: Livewire 3 dan Flux UI dengan styling Tailwind CSS yang responsif.', 'Normal');
    $s1 .= wPara('• Database: MySQL Community Server 8.0+ dengan indexing performa tinggi.', 'Normal');
    $s1 .= wPara('• Laporan PDF: DomPDF (barryvdh/laravel-dompdf) untuk dokumen A4 landscape resmi.', 'Normal');
    $s1 .= wPara('• Spreadsheet: FastExcel untuk unduhan file Excel dan CSV instan.', 'Normal');
    $s1 .= wPara('• Keamanan: Fortify, Otentikasi Dua Faktor (2FA TOTP), dan Passkeys (WebAuthn).', 'Normal');
    $sections[] = $s1;
    $sections[] = wPageBreak();

    // ---- BAB 2: SETUP & INSTALASI ----
    $s2 = '';
    $s2 .= wPara('BAB 2: PERSYARATAN SISTEM & PROSEDUR INSTALASI', 'Heading1', true, '0B334D');
    $s2 .= wPara('2.1  Persyaratan Perangkat Keras & Lunak', 'Heading2', true, '0284C7');
    $s2 .= wPara('Kebutuhan Perangkat Keras:', 'Normal', true);
    $s2 .= wPara('• Prosesor: Minimal Dual Core 2.0 GHz (Disarankan Quad Core 2.5 GHz ke atas)', 'Bullet');
    $s2 .= wPara('• RAM: Minimal 4 GB (Disarankan 8 GB)', 'Bullet');
    $s2 .= wPara('• Penyimpanan: Ruang kosong minimal 2 GB', 'Bullet');
    $s2 .= wPara('Kebutuhan Perangkat Lunak:', 'Normal', true);
    $s2 .= wPara('• Server/Runtime: Laravel Herd (rekomendasi Windows/Mac) atau PHP 8.2+', 'Bullet');
    $s2 .= wPara('• Database: MySQL Community Server 8.0+ / MariaDB 10.4+', 'Bullet');
    $s2 .= wPara('• Browser: Google Chrome, Microsoft Edge, Mozilla Firefox versi terbaru', 'Bullet');
    $s2 .= wPara('', 'Normal');
    $s2 .= wPara('2.2  Langkah Instalasi Otomatis (setup.bat)', 'Heading2', true, '0284C7');
    $s2 .= wPara('1.  Salin atau clone direktori proyek SIMPAKDA.', 'Normal');
    $s2 .= wPara('2.  Jalankan file setup.bat dengan mengklik ganda berkas tersebut.', 'Normal');
    $s2 .= wPara('3.  Skrip akan otomatis memasang dependensi Composer, NPM, mengompilasi aset, dan menyiapkan berkas .env.', 'Normal');
    $s2 .= wPara('', 'Normal');
    $s2 .= wPara('2.3  Konfigurasi Basis Data & Impor', 'Heading2', true, '0284C7');
    $s2 .= wPara('Buka HeidiSQL, buat database simpakda, lalu jalankan menu File -> Run SQL file... ke arah database/simpakda.sql.', 'Normal');
    $s2 .= wPara('Perbarui berkas .env dengan kredensial MySQL yang benar.', 'Normal');
    $s2 .= wPara('', 'Normal');
    $s2 .= wPara('2.4  Pembuatan Akun Admin Awal via CLI', 'Heading2', true, '0284C7');
    $s2 .= wPara('Jalankan perintah berikut pada terminal proyek:', 'Normal');
    $s2 .= wPara('php artisan admin:create admin@simpakda.id "Administrator Utama"', 'Callout', true, '0B334D');
    $s2 .= wPara('Sistem akan mencetak password berkekuatan tinggi di layar. Simpan kata sandi ini untuk login pertama kali.', 'Normal');
    $sections[] = $s2;
    $sections[] = wPageBreak();

    // ---- BAB 3: OTENTIKASI & KEAMANAN ----
    $s3 = '';
    $s3 .= wPara('BAB 3: OTENTIKASI & KEAMANAN PENGGUNA', 'Heading1', true, '0B334D');
    $s3 .= wPara('3.1  Kebijakan Registrasi Tertutup', 'Heading2', true, '0284C7');
    $s3 .= wPara('Pendaftaran publik (/register) dinonaktifkan demi melindungi data inventaris dinas. Akun hanya bisa dibuat oleh Super Admin melalui baris perintah CLI.', 'Normal');
    $s3 .= wPara('', 'Normal');
    $s3 .= wPara('3.2  Prosedur Masuk Sistem (Login)', 'Heading2', true, '0284C7');
    $s3 .= wPara('Kunjungi alamat aplikasi (misal: http://simpakda.test/login). Masukkan alamat email dan password yang terdaftar, lalu klik tombol Masuk.', 'Normal');
    $s3 .= wPara('', 'Normal');
    $s3 .= wPara('3.3  Otentikasi Dua Faktor (2FA TOTP)', 'Heading2', true, '0284C7');
    $s3 .= wPara('Buka menu Settings -> Security. Klik tombol Enable 2FA, konfirmasi password Anda, lalu pindai QR Code menggunakan aplikasi Google Authenticator atau Authy. Simpan Recovery Codes yang disediakan untuk situasi darurat.', 'Normal');
    $s3 .= wPara('', 'Normal');
    $s3 .= wPara('3.4  Masuk Tanpa Sandi dengan Kunci Sandi (Passkeys / WebAuthn)', 'Heading2', true, '0284C7');
    $s3 .= wPara('Di tab Security, klik Register New Passkey untuk mengaktifkan login biometrik (Windows Hello, sidik jari, atau Touch ID) sehingga Anda dapat masuk secara cepat tanpa mengetik kata sandi.', 'Normal');
    $s3 .= wPara('', 'Normal');
    $s3 .= wPara('3.5  Pengaturan Profil & Tampilan', 'Heading2', true, '0284C7');
    $s3 .= wPara('• Tab Profile: Mengubah nama lengkap dan alamat email kedinasan.', 'Bullet');
    $s3 .= wPara('• Tab Appearance: Memilih tema tampilan Light (Terang), Dark (Gelap Navy), atau System (Mengikuti OS).', 'Bullet');
    $sections[] = $s3;
    $sections[] = wPageBreak();

    // ---- BAB 4 & 5: NAVIGASI & DASHBOARD ----
    $s4 = '';
    $s4 .= wPara('BAB 4: NAVIGASI ANTARMUKA & HALAMAN PUBLIK', 'Heading1', true, '0B334D');
    $s4 .= wPara('Aplikasi menyediakan Landing Page modern di rute utama (/), halaman informasi fitur interaktif (/fitur) yang dapat diakses publik, serta sidebar menu utama yang mencakup Dashboard, Monitoring, Kendaraan, Anggaran, dan Penyusutan Kendaraan.', 'Normal');
    $s4 .= wPara('', 'Normal');
    $s4 .= wPara('BAB 5: MODUL DASHBOARD (PUSAT KENDALI OPERASIONAL)', 'Heading1', true, '0B334D');
    $s4 .= wPara('5.1  4 Kartu Statistik Utama (KPI Armada)', 'Heading2', true, '0284C7');
    $s4 .= wPara('• Total Kendaraan: Jumlah seluruh armada yang tercatat di database.', 'Bullet');
    $s4 .= wPara('• Kendaraan Aktif: Jumlah unit dengan status operasional aktif.', 'Bullet');
    $s4 .= wPara('• Pajak Belum Bayar: Jumlah kendaraan dengan masa berlaku pajak < hari ini.', 'Bullet');
    $s4 .= wPara('• STNK Belum Bayar: Jumlah kendaraan dengan masa berlaku STNK < hari ini.', 'Bullet');
    $s4 .= wPara('', 'Normal');
    $s4 .= wPara('5.2  Panel Rekapitulasi & Akses Cepat', 'Heading2', true, '0284C7');
    $s4 .= wPara('• Progress bar persentase rasio armada aktif terhadap total unit.', 'Bullet');
    $s4 .= wPara('• Tombol Lihat Daftar Kendaraan dan Tambah Kendaraan Baru untuk efisiensi navigasi harian.', 'Bullet');
    $sections[] = $s4;
    $sections[] = wPageBreak();

    // ---- BAB 6: MANAJEMEN KENDARAAN ----
    $s6 = '';
    $s6 .= wPara('BAB 6: MODUL MANAJEMEN KENDARAAN', 'Heading1', true, '0B334D');
    $s6 .= wPara('Modul Kendaraan (/vehicles) adalah pusat pengelolaan seluruh armada dinas.', 'Normal');
    $s6 .= wPara('', 'Normal');
    $s6 .= wPara('6.1  Fitur Pencarian & Multi-Filtering', 'Heading2', true, '0284C7');
    $s6 .= wPara('Tabel dilengkapi 6 filter simultan yang mempertahankan nilai query string antar halaman:', 'Normal');
    $s6 .= wPara('1.  Pencarian kata kunci: Nomor Polisi, Merek, Tipe, dan Nama Pemakai.', 'Bullet');
    $s6 .= wPara('2.  Filter Kategori: Dropdown otomatis dari basis data (Roda 2, Roda 4, Kendaraan Laut).', 'Bullet');
    $s6 .= wPara('3.  Filter Status: Aktif, Non Aktif, Perbaikan, Dijual.', 'Bullet');
    $s6 .= wPara('4.  Filter Dokumen: Belum Bayar Pajak, Belum Bayar STNK.', 'Bullet');
    $s6 .= wPara('5.  Filter Sumber Kendaraan: APBD atau APBN.', 'Bullet');
    $s6 .= wPara('6.  Filter Tahun: Tahun pemakaian kendaraan.', 'Bullet');
    $s6 .= wPara('', 'Normal');
    $s6 .= wPara('6.2  Struktur Kolom Formulir Kendaraan', 'Heading2', true, '0284C7');

    $headersVehicle = ['Kelompok', 'Nama Kolom', 'Wajib/Opsional', 'Deskripsi'];
    $rowsVehicle = [
        ['Spesifikasi', 'Merek, Tipe, Jenis', 'Wajib (*)', 'Contoh: Toyota Innova Minibus'],
        ['Spesifikasi', 'Bahan Bakar', 'Opsional', 'Pertalite, Pertamax, Solar, Listrik'],
        ['Spesifikasi', 'No. Polisi, Chasis, Mesin', 'Wajib (*)', 'Identitas resmi unik (tidak boleh duplikat)'],
        ['Spesifikasi', 'Tahun Pemakaian', 'Wajib (*)', 'Tahun perakitan/pemakaian (4 digit)'],
        ['Legalitas', 'Masa Berlaku Pajak', 'Wajib (*)', 'Batas waktu pembayaran pajak tahunan'],
        ['Legalitas', 'Masa Berlaku STNK', 'Wajib (*)', 'Batas waktu masa berlaku plat 5 tahunan'],
        ['Pemakai', 'Nama & Jabatan Pemakai', 'Wajib (*)', 'Pejabat/staf yang memegang unit'],
        ['Kategori', 'Kategori & Sub Kategori', 'Wajib (*)', 'Roda 2 / Roda 4 / Patroli / Ambulans'],
        ['Keuangan', 'Anggaran Biaya (Rp)', 'Opsional', 'Alokasi anggaran operasional/servis'],
        ['Keuangan', 'Biaya Plat/STNK (Rp)', 'Opsional', 'Estimasi biaya perpanjangan plat & STNK'],
        ['Keuangan', 'Sumber Kendaraan', 'Wajib (*)', 'Pilihan: APBD atau APBN'],
        ['Catatan', 'Keterangan Pajak & Unit', 'Opsional', 'Catatan berkas BPKB atau kondisi fisik'],
        ['Status', 'Status Operasional', 'Wajib (*)', 'Aktif, Non Aktif, Perbaikan, Dijual'],
    ];
    $s6 .= wTable($headersVehicle, $rowsVehicle);
    $s6 .= wPara('', 'Normal');
    $s6 .= wPara('6.3  Audit Trail: Riwayat Perubahan (Vehicle History)', 'Heading2', true, '0284C7');
    $s6 .= wPara('Setiap perubahan pada master kendaraan direkam otomatis pada tabel vehicle_histories. Halaman detail kendaraan menyajikan perbandingan komprehensif nilai lama -> nilai baru beserta nama user dan waktu aksi dilakukan.', 'Normal');
    $s6 .= wPara('', 'Normal');
    $s6 .= wPara('6.4  Ekspor Data (Excel, CSV, PDF)', 'Heading2', true, '0284C7');
    $s6 .= wPara('Tiga tombol ekspor di sudut kanan atas memungkinkan pengunduhan data dalam format XLSX, CSV, atau PDF (A4 Landscape resmi) yang sepenuhnya mengikuti kondisi filter yang sedang Anda aktifkan.', 'Normal');
    $sections[] = $s6;
    $sections[] = wPageBreak();

    // ---- BAB 7: MONITORING ARMADA ----
    $s7 = '';
    $s7 .= wPara('BAB 7: MODUL MONITORING ARMADA', 'Heading1', true, '0B334D');
    $s7 .= wPara('Modul Monitoring (/monitoring) menyajikan pengawasan dokumen kendaraan secara real-time.', 'Normal');
    $s7 .= wPara('', 'Normal');
    $s7 .= wPara('7.1  Panel Pajak Jatuh Tempo Tahun Berjalan', 'Heading2', true, '0284C7');
    $s7 .= wPara('Menampilkan daftar unit yang jatuh tempo pada tahun kalender saat ini. Dilengkapi tombol aksi hijau "Sudah Dibayar".', 'Normal');
    $s7 .= wPara('', 'Normal');
    $s7 .= wPara('7.2  Mekanisme Otomatis Tombol "Sudah Dibayar"', 'Heading2', true, '0284C7');
    $s7 .= wPara('Saat petugas mengeklik tombol Sudah Dibayar:', 'Normal');
    $s7 .= wPara('1.  Sistem otomatis memajukan masa_berlaku_pajak tepat 1 tahun ke depan (addYearNoOverflow).', 'Bullet');
    $s7 .= wPara('2.  Stempel waktu pembayaran saat ini dicatat ke kolom pajak_dibayar_at.', 'Bullet');
    $s7 .= wPara('3.  Status kendaraan seketika berubah menjadi aman di monitoring dan dashboard.', 'Bullet');
    $s7 .= wPara('', 'Normal');
    $s7 .= wPara('7.3  Peringatan Dini 21 Hari & Kendaraan Non-Aktif', 'Heading2', true, '0284C7');
    $s7 .= wPara('• Panel Pajak Akan Jatuh Tempo: Mengawasi armada dengan jatuh tempo dalam 3 minggu ke depan.', 'Bullet');
    $s7 .= wPara('• Panel Kendaraan Non Aktif: Mengawasi unit yang sedang dalam perbaikan bengkel atau tidak digunakan.', 'Bullet');
    $sections[] = $s7;
    $sections[] = wPageBreak();

    // ---- BAB 8: ANGGARAN FINANSIAL ----
    $s8 = '';
    $s8 .= wPara('BAB 8: MODUL ANGGARAN FINANSIAL', 'Heading1', true, '0B334D');
    $s8 .= wPara('Modul Anggaran (/anggaran) menyajikan transparansi alokasi pembiayaan kendaraan.', 'Normal');
    $s8 .= wPara('', 'Normal');
    $s8 .= wPara('8.1  Kartu Ringkasan Keuangan', 'Heading2', true, '0284C7');
    $s8 .= wPara('Menampilkan Total Kendaraan, Total Anggaran Biaya, Total Biaya Plat/STNK, dan Total Keseluruhan (Anggaran + Plat/STNK).', 'Normal');
    $s8 .= wPara('', 'Normal');
    $s8 .= wPara('8.2  Tabel Rincian Anggaran & Cetak PDF', 'Heading2', true, '0284C7');
    $s8 .= wPara('Tabel menyajikan alokasi biaya per unit kendaraan beserta Grand Total di baris footer.', 'Normal');
    $s8 .= wPara('Tombol "Cetak PDF" menghasilkan dokumen formal A4 Landscape yang memuat rincian biaya, filter sumber APBD/APBN, jenis kendaraan, dan waktu cetak.', 'Normal');
    $sections[] = $s8;
    $sections[] = wPageBreak();

    // ---- BAB 9: PENYUSUTAN KENDARAAN ----
    $s9 = '';
    $s9 .= wPara('BAB 9: MODUL PENYUSUTAN KENDARAAN (ASSET DEPRECIATION)', 'Heading1', true, '0B334D');
    $s9 .= wPara('Modul Penyusutan (/penyusutan) menghitung depresiasi aset kendaraan berdasarkan metode garis lurus (Straight-Line Method) untuk keperluan akuntansi aset dan pelaporan audit.', 'Normal');
    $s9 .= wPara('', 'Normal');
    $s9 .= wPara('9.1  Klasifikasi Kelompok Aset & Tarif', 'Heading2', true, '0284C7');

    $headersDepr = ['Kelompok', 'Masa Manfaat', 'Tarif per Tahun', 'Deskripsi'];
    $rowsDepr = [
        ['Kelompok 1', '10 Tahun', '6.25% (0.0625)', 'Kendaraan operasional dinas standar'],
        ['Kelompok 2', '10 Tahun', '1.5625% (0.015625)', 'Kendaraan khusus / aset berumur ekonomis panjang'],
    ];
    $s9 .= wTable($headersDepr, $rowsDepr);
    $s9 .= wPara('', 'Normal');
    $s9 .= wPara('9.2  Rumus & Formula Perhitungan', 'Heading2', true, '0284C7');
    $s9 .= wPara('1.  Umur Aset = max(0, Tahun Berjalan - Tahun Perolehan)', 'Bullet');
    $s9 .= wPara('2.  Penyusutan Tahunan = Nilai Perolehan × Tarif Desimal', 'Bullet');
    $s9 .= wPara('3.  Tahun Disusutkan = min(Umur Aset, Masa Manfaat, 10)', 'Bullet');
    $s9 .= wPara('4.  Akumulasi Penyusutan = min(Nilai Perolehan, Penyusutan Tahunan × Tahun Disusutkan)', 'Bullet');
    $s9 .= wPara('5.  Nilai Buku (Book Value) = max(0, Nilai Perolehan - Akumulasi Penyusutan)', 'Bullet');
    $s9 .= wPara('', 'Normal');
    $s9 .= wPara('9.3  Status Penyusutan Otomatis', 'Heading2', true, '0284C7');
    $s9 .= wPara('• Penyusutan Maksimal (Hijau): Umur aset >= 10 tahun, nilai buku Rp 0.', 'Bullet');
    $s9 .= wPara('• Dalam Penyusutan (Cyan): Aset sedang aktif mengalami penyusutan tahunan.', 'Bullet');
    $s9 .= wPara('• Belum Mulai (Kuning): Tahun perolehan sama dengan tahun berjalan (umur 0).', 'Bullet');
    $s9 .= wPara('• Tidak Ada Nilai (Merah): Nilai perolehan belum dikonfigurasi / bernilai Rp 0.', 'Bullet');
    $s9 .= wPara('', 'Normal');
    $s9 .= wPara('9.4  Pengisian Data & Ekspor Excel', 'Heading2', true, '0284C7');
    $s9 .= wPara('Data penyusutan disimpan pada tabel terpisah (depreciations). Form edit menyediakan pengisian Nilai Perolehan dengan auto-fill tarif dan masa manfaat saat kelompok dipilih. Laporan lengkap dapat diunduh ke Excel (.xlsx) melalui tombol Excel di pojok kanan atas.', 'Normal');
    $sections[] = $s9;
    $sections[] = wPageBreak();

    // ---- BAB 10, 11, 12 ----
    $s10 = '';
    $s10 .= wPara('BAB 10: PEMELIHARAAN SISTEM & PERINTAH ADMINISTRATOR', 'Heading1', true, '0B334D');
    $s10 .= wPara('• Perintah Buat Admin: php artisan admin:create email@domain.com "Nama"', 'Bullet');
    $s10 .= wPara('• Perintah Backup Database: php artisan db:export (otomatis menyimpan ke database/simpakda.sql)', 'Bullet');
    $s10 .= wPara('• Restore Database: Eksekusi berkas simpakda.sql melalui HeidiSQL atau MySQL CLI.', 'Bullet');
    $s10 .= wPara('', 'Normal');

    $s10 .= wPara('BAB 11: PEMECAHAN MASALAH (TROUBLESHOOTING)', 'Heading1', true, '0B334D');
    $s10 .= wPara('1.  Error "Vite manifest not found": Jalankan npm run build di terminal.', 'Bullet');
    $s10 .= wPara('2.  Error "Access denied for user root": Periksa password MySQL di berkas .env.', 'Bullet');
    $s10 .= wPara('3.  Error "Credentials do not match": Pastikan penulisan email dan sandi benar, atau buat admin baru via CLI.', 'Bullet');
    $s10 .= wPara('4.  Perubahan tidak muncul: Jalankan php artisan optimize:clear untuk menghapus cache.', 'Bullet');
    $s10 .= wPara('', 'Normal');

    $s10 .= wPara('BAB 12: GLOSARIUM ISTILAH SISTEM', 'Heading1', true, '0B334D');
    $s10 .= wPara('• SIMPAKDA: Sistem Informasi Manajemen Armada Pajak Kendaraan Bermotor.', 'Bullet');
    $s10 .= wPara('• Nilai Perolehan: Harga awal perolehan unit aset.', 'Bullet');
    $s10 .= wPara('• Nilai Buku (Book Value): Sisa nilai bersih aset setelah dikurangi akumulasi penyusutan.', 'Bullet');
    $s10 .= wPara('• Audit Trail: Rekod kronologis otomatis yang melacak pihak dan jenis perubahan data.', 'Bullet');
    $s10 .= wPara('• 2FA / Passkeys: Standar keamanan otentikasi ganda dan biometrik modern.', 'Bullet');
    $sections[] = $s10;

    // ---- ASSEMBLE DOCUMENT ----
    $allContent = implode('', $sections);

    $document = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<w:document xmlns:wpc="http://schemas.microsoft.com/office/word/2010/wordprocessingCanvas"
    xmlns:cx="http://schemas.microsoft.com/office/drawing/2014/chartex"
    xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006"
    xmlns:aink="http://schemas.microsoft.com/office/drawing/2016/ink"
    xmlns:am3d="http://schemas.microsoft.com/office/drawing/2017/model3d"
    xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:oel="http://schemas.microsoft.com/office/2019/extlst"
    xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
    xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
    xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:wp14="http://schemas.microsoft.com/office/word/2010/wordprocessingDrawing"
    xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
    xmlns:w10="urn:schemas-microsoft-com:office:word"
    xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
    xmlns:w14="http://schemas.microsoft.com/office/word/2010/wordml"
    xmlns:w15="http://schemas.microsoft.com/office/word/2012/wordml"
    xmlns:w16cex="http://schemas.microsoft.com/office/word/2018/wordml/cex"
    xmlns:w16cid="http://schemas.microsoft.com/office/word/2016/wordml/cid"
    xmlns:w16="http://schemas.microsoft.com/office/word/2018/wordml"
    xmlns:w16se="http://schemas.microsoft.com/office/word/2015/wordml/symex"
    xmlns:wpg="http://schemas.microsoft.com/office/word/2010/wordprocessingGroup"
    xmlns:wpi="http://schemas.microsoft.com/office/word/2010/wordprocessingInk"
    xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml"
    xmlns:wps="http://schemas.microsoft.com/office/word/2010/wordprocessingShape"
    mc:Ignorable="w14 w15 w16se w16cid w16 w16cex wp14">
<w:body>
$allContent
<w:sectPr>
    <w:pgSz w:w="12240" w:h="15840"/>
    <w:pgMar w:top="1440" w:right="1440" w:bottom="1440" w:left="1440" w:header="720" w:footer="720" w:gutter="0"/>
</w:sectPr>
</w:body>
</w:document>
XML;
    $zip->addFromString('word/document.xml', $document);
    $zip->close();

    echo "SUCCESS: $filename created (" . number_format(filesize($filename)) . " bytes)\n";
}

createDocx(__DIR__ . '/SIMPAKDA_Buku_Petunjuk_Pengguna.docx');
