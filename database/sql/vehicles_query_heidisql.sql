-- Create vehicles table
CREATE TABLE `vehicles` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `merek` VARCHAR(50) NOT NULL,
  `tipe` VARCHAR(50) NOT NULL,
  `jenis` VARCHAR(50) NOT NULL,
  `nomor_polisi` VARCHAR(20) NOT NULL UNIQUE,
  `nomor_chasis` VARCHAR(50) NOT NULL UNIQUE,
  `nomor_mesin` VARCHAR(50) NOT NULL UNIQUE,
  `tahun_pemakaian` YEAR NOT NULL,
  `masa_berlaku_pajak` DATE NOT NULL,
  `masa_berlaku_stnk` DATE NOT NULL,
  `nama_pemakai` VARCHAR(100) NOT NULL,
  `jabatan_pemakai` VARCHAR(100) NOT NULL,
  `keterangan_pajak` TEXT NULL,
  `keterangan_kendaraan` TEXT NULL,
  `anggaran_biaya` DECIMAL(15,0) NOT NULL DEFAULT 0,
  `biaya_plat_stnk` DECIMAL(15,0) NOT NULL DEFAULT 0,
  `sumber_kendaraan` VARCHAR(100) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL,
  `sub_kategori` VARCHAR(50) NULL,
  `status` ENUM('aktif', 'non_aktif', 'perbaikan', 'dijual') NOT NULL DEFAULT 'aktif',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert dummy data RODA 2 (5 data)
INSERT INTO `vehicles` (`merek`, `tipe`, `jenis`, `nomor_polisi`, `nomor_chasis`, `nomor_mesin`, `tahun_pemakaian`, `masa_berlaku_pajak`, `masa_berlaku_stnk`, `nama_pemakai`, `jabatan_pemakai`, `keterangan_pajak`, `keterangan_kendaraan`, `anggaran_biaya`, `biaya_plat_stnk`, `sumber_kendaraan`, `kategori`, `sub_kategori`, `status`) VALUES
('Honda', 'Beat Street', 'Motor Bebek', 'B 1234 ABC', 'MH1FC1135NK123456', 'NC12E11012345', 2022, '2025-01-15', '2026-01-15', 'Ahmad Fauzi', 'Sopir', 'Lunas tahun 2024', 'Kondisi baik, service rutin', 1500000, 250000, 'APBD', 'roda_2', 'Patroli', 'aktif'),
('Yamaha', 'Nmax', 'Skuter Matik', 'B 5678 DEF', 'MH1FC2135NK789012', 'NC13E21098765', 2023, '2025-03-20', '2026-03-20', 'Budi Santoso', 'Staff TU', 'Belum lunas', 'Ban depan sudah aus', 1800000, 250000, 'BLUD', 'roda_2', 'Operasional', 'aktif'),
('Suzuki', 'Satria FU', 'Motor Sport', 'D 9012 GHI', 'MH1FC3135NK111222', 'NC14E31033333', 2020, '2024-06-10', '2025-06-10', 'Clara Dewi', 'Keamanan', 'Expired, akan diperpanjang', 'Mesin halus, body lecet', 1200000, 250000, 'APBD', 'roda_2', 'Keamanan', 'aktif'),
('Honda', 'Vario 125', 'Motor Matik', 'F 3456 JKL', 'MH1FC1136NK333444', 'NC15E11044444', 2021, '2025-09-25', '2026-09-25', 'Dewi Lestari', 'Admin', 'Lunas', 'Kondisi prima', 1400000, 250000, 'APBD', 'roda_2', 'Operasional', 'aktif'),
('Yamaha', 'Vixion', 'Motor Sport', 'G 7890 MNO', 'MH1FC2135NK555666', 'NC16E21055555', 2019, '2024-12-01', '2025-12-01', 'Eko Prasetyo', 'Sopir', 'Menunggu verifikasi', 'Accu lemah', 1100000, 250000, 'BLUD', 'roda_2', NULL, 'perbaikan');

-- Insert dummy data RODA 4 (5 data)
INSERT INTO `vehicles` (`merek`, `tipe`, `jenis`, `nomor_polisi`, `nomor_chasis`, `nomor_mesin`, `tahun_pemakaian`, `masa_berlaku_pajak`, `masa_berlaku_stnk`, `nama_pemakai`, `jabatan_pemakai`, `keterangan_pajak`, `keterangan_kendaraan`, `anggaran_biaya`, `biaya_plat_stnk`, `sumber_kendaraan`, `kategori`, `sub_kategori`, `status`) VALUES
('Toyota', 'Avanza', 'Minibus', 'B 1111 AA', 'MH1YZ71G5NK123456', '1NR123456789', 2022, '2025-01-10', '2026-01-10', 'Kurniawan Adi', 'Sopir Utama', 'Lunas', 'Kilometer 80.000, service besar', 25000000, 1000000, 'APBD', 'roda_4', 'Angkutan Umum', 'aktif'),
('Honda', 'Brio', 'City Car', 'D 2222 BB', 'MH1YZ71G6NK789012', '1NR234567890', 2023, '2025-02-28', '2026-02-28', 'Lina Marlina', 'Kabag Keuangan', 'Lunas', 'Kilometer 45.000, kondisi bagus', 22000000, 1000000, 'BLUD', 'roda_4', 'Dinas', 'aktif'),
('Mitsubishi', 'Xpander', 'MPV', 'F 3333 CC', 'MH1YZ71G7NK111213', '1NR345678901', 2021, '2024-08-15', '2025-08-15', 'Made Sunarta', 'Kabag Umum', 'Expired, proses perpanjangan', 'AC dingin, body mulus', 28000000, 1000000, 'APBD', 'roda_4', 'Angkutan Umum', 'aktif'),
('Toyota', 'Kijang Innova', 'SUV', 'G 4444 DD', 'MH1YZ71G8NK141516', '1NR456789012', 2019, '2025-04-20', '2026-04-20', 'Nur Hasanah', 'Direktur', 'Lunas', 'Kilometer 120.000, terawat', 35000000, 1000000, 'APBD', 'roda_4', 'Dinas', 'aktif'),
('Suzuki', 'Ertiga', 'MPV', 'H 5555 EE', 'MH1YZ71G9NK171819', '1NR567890123', 2022, '2024-12-10', '2025-12-10', 'Oscar Pratama', 'Sopir Cadangan', 'Menunggu pembayaran', 'Velg alloy, audio standard', 26000000, 1000000, 'BLUD', 'roda_4', 'Operasional', 'perbaikan');

-- Insert dummy data NON AKTIF / DIJUAL (2 data)
INSERT INTO `vehicles` (`merek`, `tipe`, `jenis`, `nomor_polisi`, `nomor_chasis`, `nomor_mesin`, `tahun_pemakaian`, `masa_berlaku_pajak`, `masa_berlaku_stnk`, `nama_pemakai`, `jabatan_pemakai`, `keterangan_pajak`, `keterangan_kendaraan`, `anggaran_biaya`, `biaya_plat_stnk`, `sumber_kendaraan`, `kategori`, `sub_kategori`, `status`) VALUES
('Daihatsu', 'Luxio', 'Minibus', 'K 6666 FF', 'MH1YZ71H0NK202122', '1NR678901234', 2018, '2023-06-01', '2024-06-01', '-', '-', 'Tidak diperpanjang', 'Mesin mati, body karatan', 8000000, 0, 'APBD', 'roda_4', 'Cadangan', 'dijual'),
('Kawasaki', 'Ninja 250', 'Motor Sport', 'L 7777 GG', 'MH1FC4135NK777888', 'NC17E41088888', 2017, '2023-03-15', '2024-03-15', '-', '-', 'Sudah dijual', 'Dijual ke warga lokal', 5000000, 0, 'APBD', 'roda_2', NULL, 'dijual');
