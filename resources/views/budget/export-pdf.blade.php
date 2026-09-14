<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Anggaran Kendaraan</title>

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
        margin-bottom: 15px;
        padding: 15px 10px;
        border-radius: 6px;
        border-bottom: 3px solid #1d4ed8;
    }

    .header h1 {
        font-size: 16px;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .header p {
        font-size: 9px;
        color: #cbd5e1;
    }

    /* =========================
       FILTER
    ========================= */

    .filter-box {
        width: 100%;
        margin-bottom: 12px;
        padding: 8px 10px;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-left: 3px solid #1d4ed8;
        border-radius: 4px;
    }

    .filter-title {
        font-size: 8px;
        font-weight: bold;
        color: #0f172a;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .filter-table {
        width: 100%;
        border-collapse: collapse;
    }

    .filter-table td {
        border: none;
        padding: 2px 5px 2px 0;
        font-size: 8px;
    }

    .filter-label {
        font-weight: bold;
        color: #475569;
    }

    .filter-value {
        color: #1d4ed8;
        font-weight: bold;
    }

    /* =========================
       SUMMARY
    ========================= */

    .summary {
        width: 100%;
        margin-bottom: 15px;
        border-collapse: separate;
        border-spacing: 5px;
    }

    .summary td {
        width: 25%;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-top: 3px solid #1d4ed8;
        padding: 9px 10px;
        vertical-align: middle;
        border-radius: 4px;
    }

    .summary-label {
        font-size: 7px;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 4px;
        font-weight: bold;
    }

    .summary-value {
        font-size: 12px;
        color: #0f172a;
        font-weight: bold;
    }

    .summary-value-money {
        font-size: 11px;
        color: #1e3a8a;
        font-weight: bold;
    }

    /* =========================
       TABLE
    ========================= */

    table.data {
        width: 100%;
        border-collapse: collapse;
        font-size: 7.5px;
        table-layout: fixed;
    }

    table.data thead {
        display: table-header-group;
    }

    table.data tr {
        page-break-inside: avoid;
    }

    /* =========================
       TABLE HEADER
    ========================= */

    table.data thead th {
        background-color: #1e3a8a;
        color: #ffffff;
        padding: 6px 4px;
        text-align: center;
        font-weight: bold;
        border: 1px solid #172554;
        text-transform: uppercase;
        font-size: 7px;
        vertical-align: middle;
    }

    /* =========================
       TABLE BODY
    ========================= */

    table.data tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }

    table.data tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    table.data tbody td {
        padding: 6px 4px;
        border: 1px solid #cbd5e1;
        vertical-align: middle;
        word-wrap: break-word;
    }

    table.data tbody td:first-child {
        text-align: center;
        font-weight: bold;
        color: #475569;
    }

    /* =========================
       TOTAL
    ========================= */

    .total-row td {
        background-color: #e2e8f0 !important;
        color: #0f172a;
        font-weight: bold;
        border: 1px solid #94a3b8 !important;
        border-top: 2px solid #64748b !important;
        padding: 7px 4px !important;
    }

    /* =========================
       TEXT
    ========================= */

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    /* =========================
       BADGE
    ========================= */

    .badge {
        display: inline-block;
        padding: 2px 5px;
        border-radius: 3px;
        font-size: 6.5px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .badge-teal {
        background-color: #dbeafe;
        color: #1e40af;
        border: 1px solid #93c5fd;
    }

    .badge-cyan {
        background-color: #e0e7ff;
        color: #3730a3;
        border: 1px solid #a5b4fc;
    }

    .badge-zinc {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    /* =========================
       EMPTY DATA
    ========================= */

    .empty {
        text-align: center;
        padding: 15px !important;
        color: #64748b;
        font-style: italic;
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

    /* =========================
       MONEY
    ========================= */

    .money {
        color: #1e3a8a;
        font-weight: bold;
    }
</style>
```

</head>

<body>

```
<!-- =========================
     HEADER
========================= -->

<div class="header">

    <h1>
        Laporan Anggaran Kendaraan
    </h1>

    <p>
        Rincian anggaran dan biaya kendaraan SIMPAKDA
        <br>
        Dicetak pada: {{ $printedAt }}
    </p>

</div>


<!-- =========================
     FILTER
========================= -->

<div class="filter-box">

    <div class="filter-title">
        Informasi Filter Laporan
    </div>

    <table class="filter-table">

        <tr>

            <td style="width: 18%;">
                <span class="filter-label">
                    Sumber Kendaraan
                </span>
            </td>

            <td style="width: 32%;">
                <span class="filter-value">
                    {{ $filterSumber ?: 'Semua Sumber' }}
                </span>
            </td>

            <td style="width: 18%;">
                <span class="filter-label">
                    Kategori Kendaraan
                </span>
            </td>

            <td style="width: 32%;">
                <span class="filter-value">
                    {{ $filterKategori ?: 'Semua Kategori' }}
                </span>
            </td>

        </tr>

    </table>

</div>


<!-- =========================
     SUMMARY
========================= -->

<table class="summary">

    <tr>

        <!-- TOTAL KENDARAAN -->

        <td>

            <div class="summary-label">
                Total Kendaraan
            </div>

            <div class="summary-value">
                {{ $totalKendaraan }}
            </div>

        </td>


        <!-- TOTAL ANGGARAN -->

        <td>

            <div class="summary-label">
                Total Anggaran
            </div>

            <div class="summary-value-money">
                Rp {{ number_format((float) $totalAnggaran, 0, ',', '.') }}
            </div>

        </td>


        <!-- TOTAL PLAT STNK -->

        <td>

            <div class="summary-label">
                Total Biaya Plat / STNK
            </div>

            <div class="summary-value-money">
                Rp {{ number_format((float) $totalPlatStnk, 0, ',', '.') }}
            </div>

        </td>


        <!-- TOTAL KESELURUHAN -->

        <td>

            <div class="summary-label">
                Total Keseluruhan
            </div>

            <div class="summary-value-money">
                Rp {{ number_format((float) $totalBiaya, 0, ',', '.') }}
            </div>

        </td>

    </tr>

</table>


<!-- =========================
     DATA TABLE
========================= -->

<table class="data">

    <thead>

        <tr>

            <th style="width: 4%;">
                No
            </th>

            <th style="width: 10%;">
                No. Polisi
            </th>

            <th style="width: 20%;">
                Merek / Tipe
            </th>

            <th style="width: 10%;">
                Tahun
            </th>

            <th style="width: 10%;">
                Sumber
            </th>

            <th style="width: 10%;">
                Kategori
            </th>

            <th style="width: 14%;">
                Anggaran
                <br>
                (Rp)
            </th>

            <th style="width: 12%;">
                Plat / STNK
                <br>
                (Rp)
            </th>

            <th style="width: 10%;">
                Pajak Berlaku
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse ($vehicles as $index => $vehicle)

            <tr>

                <!-- NO -->

                <td>
                    {{ $index + 1 }}
                </td>


                <!-- NO POLISI -->

                <td class="text-center">

                    <strong>
                        {{ $vehicle->nomor_polisi }}
                    </strong>

                </td>


                <!-- MEREK / TIPE -->

                <td>

                    <strong>
                        {{ $vehicle->merek }}
                    </strong>

                    @if ($vehicle->tipe)
                        <span style="display:block; color:#64748b;">
                            {{ $vehicle->tipe }}
                        </span>
                    @endif

                </td>


                <!-- TAHUN -->

                <td class="text-center">

                    {{ $vehicle->tahun_pemakaian ?: '-' }}

                </td>


                <!-- SUMBER -->

                <td class="text-center">

                    @if ($vehicle->sumber_kendaraan)

                        <span class="badge badge-teal">
                            {{ $vehicle->sumber_kendaraan }}
                        </span>

                    @else

                        -

                    @endif

                </td>


                <!-- KATEGORI -->

                <td class="text-center">

                    @if ($vehicle->kategori)

                        <span class="badge badge-cyan">
                            {{ $vehicle->kategori }}
                        </span>

                    @else

                        -

                    @endif

                </td>


                <!-- ANGGARAN -->

                <td class="text-right">

                    Rp
                    {{ number_format((float) $vehicle->anggaran_biaya, 0, ',', '.') }}

                </td>


                <!-- PLAT / STNK -->

                <td class="text-right">

                    Rp
                    {{ number_format((float) $vehicle->biaya_plat_stnk, 0, ',', '.') }}

                </td>


                <!-- PAJAK -->

                <td class="text-center">

                    @if ($vehicle->masa_berlaku_pajak)

                        {{ \Carbon\Carbon::parse($vehicle->masa_berlaku_pajak)->format('d/m/Y') }}

                    @else

                        -

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="9"
                    class="empty"
                >
                    Tidak ada data kendaraan berdasarkan
                    filter yang dipilih.
                </td>

            </tr>

        @endforelse


        <!-- =========================
             TOTAL ROW
        ========================= -->

        @if ($vehicles->count() > 0)

            <tr class="total-row">

                <td
                    colspan="6"
                    class="text-right"
                >
                    TOTAL
                    ({{ $totalKendaraan }} Kendaraan)
                </td>

                <td class="text-right">

                    Rp
                    {{ number_format((float) $totalAnggaran, 0, ',', '.') }}

                </td>

                <td class="text-right">

                    Rp
                    {{ number_format((float) $totalPlatStnk, 0, ',', '.') }}

                </td>

                <td></td>

            </tr>

        @endif

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

        Generated by
        <strong>SIMPAKDA</strong>

    </div>

</div>

</body>

</html>
