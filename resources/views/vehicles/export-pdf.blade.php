<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 9px;
            color: #334155;
            padding: 15px;
            background-color: #ffffff;
            line-height: 1.3;
        }

        /* =========================
           HEADER
        ========================= */
        .header {
            background-color: #0f172a;
            text-align: center;
            margin-bottom: 20px;
            padding: 15px 10px;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 16px;
            color: #22d3ee;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 9px;
            color: #cbd5e1;
        }

        /* =========================
           META
        ========================= */
        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 9px;
            font-weight: bold;
            color: #334155;
        }

        .meta-left {
            text-align: left;
        }

        .meta-right {
            text-align: right;
        }

        .meta-value {
            color: #0f766e;
            font-weight: bold;
        }

        /* =========================
           TABLE
        ========================= */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5px;
            table-layout: fixed;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        /* Header utama */
        thead th {
            background-color: #22d3ee;
            color: #0f172a;
            padding: 5px 3px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #06b6d4;
            text-transform: uppercase;
            font-size: 7px;
            vertical-align: middle;
        }

        /* Header sub */
        thead .sub-head {
            background-color: #67e8f9;
            font-size: 6.5px;
            padding: 4px 2px;
        }

        /* Isi tabel */
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody td {
            padding: 5px 3px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            word-wrap: break-word;
        }

        tbody td:first-child {
            text-align: center;
            font-weight: bold;
            color: #475569;
        }

        /* =========================
           TEXT
        ========================= */
        .text-sub {
            display: block;
            color: #64748b;
            font-size: 6.5px;
            margin-top: 2px;
        }

        /* =========================
           BADGE
        ========================= */
        .badge {
            display: inline-block;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 6.5px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-red {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .badge-teal {
            background-color: #ccfbf1;
            color: #0f766e;
            border: 1px solid #5eead4;
        }

        .badge-cyan {
            background-color: #cffafe;
            color: #0369a1;
            border: 1px solid #67e8f9;
        }

        .badge-zinc {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        /* =========================
           FOOTER
        ========================= */
        .footer-wrapper {
            margin-top: 15px;
            display: table;
            width: 100%;
            font-size: 8px;
            color: #64748b;
        }

        .footer-left {
            display: table-cell;
            text-align: left;
        }

        .footer-right {
            display: table-cell;
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- =========================
         HEADER
    ========================= -->
    <div class="header">
        <h1>Data Kendaraan</h1>
        <p>Dicetak pada: {{ $printedAt }}</p>
    </div>

    <!-- =========================
         JUMLAH & KATEGORI
    ========================= -->
    <div class="meta">

        <div class="meta-left">
            Jumlah Kendaraan:
            <span class="meta-value">
                {{ $vehicles->count() }}
            </span>
        </div>

        <div class="meta-right">
            Kategori Kendaraan:
            <span class="meta-value">
                {{ $vehicles->pluck('kategori')->unique()->implode(', ') }}
            </span>
        </div>

    </div>

    <!-- =========================
         TABEL
    ========================= -->
    <table>

        <thead>

            <!-- HEADER UTAMA -->
            <tr>
                <th rowspan="2" style="width: 3%;">No</th>

                <th rowspan="2" style="width: 5%;">
                    Merek
                </th>

                <th rowspan="2" style="width: 5%;">
                    Tipe
                </th>

                <th rowspan="2" style="width: 9%;">
                    No Chasis
                </th>

                <th rowspan="2" style="width: 8%;">
                    No Mesin
                </th>

                <th rowspan="2" style="width: 7%;">
                    No Polisi
                </th>

                <th rowspan="2" style="width: 5%;">
                    Tahun
                </th>

                <th rowspan="2" style="width: 7%;">
                    Masa Berlaku<br>
                    Pajak Tahunan
                </th>

                <th rowspan="2" style="width: 7%;">
                    Masa Berlaku<br>
                    STNK
                </th>

                <th rowspan="2" style="width: 6%;">
                    Bahan Bakar
                </th>

                <!-- PEMAKAI -->
                <th colspan="2" style="width: 12%;">
                    Pemakai
                </th>

                <th rowspan="2" style="width: 7%;">
                    Keterangan Kendaraan
                </th>

                <th rowspan="2" style="width: 7%;">
                    Sumber
                </th>

                <th rowspan="2" style="width: 7%;">
                    Anggaran
                </th>
            </tr>

            <!-- SUB HEADER PEMAKAI -->
            <tr>
                <th class="sub-head" style="width: 10%;">
                    Nama
                </th>

                <th class="sub-head" style="width: 10%;">
                    Jabatan
                </th>
            </tr>

        </thead>

        <tbody>

            @foreach ($vehicles as $index => $v)

                <tr>

                    <!-- 1. NO -->
                    <td>
                        {{ $index + 1 }}
                    </td>

                    <!-- 2. MEREK -->
                    <td>
                        {{ $v->merek }}
                    </td>

                    <!-- 3. TIPE -->
                    <td>
                        {{ $v->tipe }}
                    </td>

                    <!-- 4. NO CHASIS -->
                    <td style="font-size: 6.5px; word-break: break-all;">
                        {{ $v->nomor_chasis }}
                    </td>

                    <!-- 5. NO MESIN -->
                    <td style="font-size: 6.5px; word-break: break-all;">
                        {{ $v->nomor_mesin }}
                    </td>

                    <!-- 6. NO POLISI -->
                    <td style="font-weight: bold; text-align: center;">
                        {{ $v->nomor_polisi }}
                    </td>

                    <!-- 7. TAHUN -->
                    <td style="text-align: center;">
                        {{ $v->tahun_pemakaian }}
                    </td>

                    <!-- 8. PAJAK TAHUNAN -->
                    <td style="text-align: center;">

                        @if ($v->isPajakExpired())

                            <span class="badge badge-red">
                                Belum bayar
                            </span>

                        @else

                            {{ $v->masa_berlaku_pajak->format('d/m/Y') }}

                        @endif

                    </td>

                    <!-- 9. STNK -->
                    <td style="text-align: center;">

                        @if ($v->isStnkExpired())

                            <span class="badge badge-red">
                                Belum bayar
                            </span>

                        @else

                            {{ $v->masa_berlaku_stnk->format('d/m/Y') }}

                        @endif

                    </td>

                    <!-- 10. BAHAN BAKAR -->
                    <td style="text-align: center;">
                        {{ $v->bahan_bakar }}
                    </td>

                    <!-- 11A. PEMAKAI - NAMA -->
                    <td>
                        {{ $v->nama_pemakai }}
                    </td>

                    <!-- 11B. PEMAKAI - JABATAN -->
                    <td>
                        {{ $v->jabatan_pemakai }}
                    </td>

                    <!-- 12. JATUH TEMPO / KETERANGAN BAYAR -->
                    <td style="font-size: 6.5px;">

                        @if ($v->keterangan_kendaraan)

                            {{ $v->keterangan_kendaraan }}

                        @else

                            -

                        @endif

                    </td>

                    <!-- 13. SUMBER -->
                    <td style="text-align: center;">
                        {{ $v->sumber_kendaraan }}
                    </td>

                    <!-- 14. ANGGARAN -->
                    <td style="text-align: right;">
                        {{ number_format($v->anggaran_biaya, 0, ',', '.') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <!-- =========================
         FOOTER
    ========================= -->
    <div class="footer-wrapper">

        <div class="footer-left">
            Total {{ $vehicles->count() }} Data
        </div>

        <div class="footer-right">
            Generated by <strong>SIMPAKDA</strong>
        </div>

    </div>

</body>
</html>