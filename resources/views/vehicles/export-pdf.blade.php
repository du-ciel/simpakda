<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9px;
            color: #1e293b;
            padding: 15px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #0d9488;
        }

        .header h1 {
            font-size: 16px;
            color: #0d9488;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 8px;
            color: #64748b;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .meta-info {
            font-size: 8px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }

        thead th {
            background-color: #0d9488;
            color: #ffffff;
            padding: 5px 4px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #0d9488;
        }

        tbody tr:nth-child(even) {
            background-color: #f0fdfa;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody td {
            padding: 4px 3px;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        tbody td:first-child {
            text-align: center;
            font-weight: bold;
            color: #64748b;
        }

        .badge {
            display: inline-block;
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
        }

        .badge-red {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .badge-teal {
            background-color: #ccfbf1;
            color: #0d9488;
        }

        .badge-cyan {
            background-color: #cffafe;
            color: #0891b2;
        }

        .badge-zinc {
            background-color: #f4f4f5;
            color: #71717a;
        }

        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 8px;
            color: #94a3b8;
        }

        .summary {
            margin-top: 10px;
            font-size: 8px;
            color: #64748b;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA KENDARAAN</h1>
        <p>Dicetak pada: {{ $printedAt }}</p>
    </div>

    <div class="meta">
        <div class="meta-info">
            <strong>Total:</strong> {{ $vehicles->count() }} kendaraan
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:3%">No</th>
                <th style="width:6%">No Polisi</th>
                <th style="width:8%">Merek / Tipe</th>
                <th style="width:5%">Jenis</th>
                <th style="width:6%">Kategori</th>
                <th style="width:7%">Pemakai</th>
                <th style="width:5%">Tahun</th>
                <th style="width:5%">Pajak</th>
                <th style="width:5%">STNK</th>
                <th style="width:5%">Status</th>
                <th style="width:7%">Sumber Dana</th>
                <th style="width:7%">No Chasis</th>
                <th style="width:7%">No Mesin</th>
                <th style="width:5%">Anggaran</th>
                <th style="width:6%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $index => $v)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight:bold;">{{ $v->nomor_polisi }}</td>
                    <td>
                        <strong>{{ $v->merek }}</strong><br>
                        <span style="color:#64748b">{{ $v->tipe }}</span>
                    </td>
                    <td>{{ $v->jenis }}</td>
                    <td>{{ $v->kategori }}</td>
                    <td>
                        <strong>{{ $v->nama_pemakai }}</strong><br>
                        <span style="color:#64748b">{{ $v->jabatan_pemakai }}</span>
                    </td>
                    <td style="text-align:center;">{{ $v->tahun_pemakaian }}</td>
                    <td style="text-align:center;">
                        @if ($v->isPajakExpired())
                            <span class="badge badge-red">Expired</span>
                        @else
                            {{ $v->masa_berlaku_pajak->format('d/m/Y') }}
                        @endif
                    </td>
                    <td style="text-align:center;">
                        @if ($v->isStnkExpired())
                            <span class="badge badge-red">Expired</span>
                        @else
                            {{ $v->masa_berlaku_stnk->format('d/m/Y') }}
                        @endif
                    </td>
                    <td style="text-align:center;">
                        @if ($v->status === 'aktif')
                            <span class="badge badge-teal">Aktif</span>
                        @elseif ($v->status === 'perbaikan')
                            <span class="badge badge-cyan">Perbaikan</span>
                        @elseif ($v->status === 'dijual')
                            <span class="badge badge-red">Dijual</span>
                        @else
                            <span class="badge badge-zinc">Non Aktif</span>
                        @endif
                    </td>
                    <td>{{ $v->sumber_dana }}</td>
                    <td style="font-size:7px;">{{ $v->nomor_chasis }}</td>
                    <td style="font-size:7px;">{{ $v->nomor_mesin }}</td>
                    <td style="text-align:right;">Rp {{ number_format($v->anggaran_biaya, 0, ',', '.') }}</td>
                    <td style="font-size:7px;">
                        @if ($v->keterangan_kendaraan)
                            {{ Str::limit($v->keterangan_kendaraan, 30) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        Total {{ $vehicles->count() }} kendaraan
    </div>

    <div class="footer">
        Generated by Sistem Informasi Kendaraan
    </div>
</body>
</html>
