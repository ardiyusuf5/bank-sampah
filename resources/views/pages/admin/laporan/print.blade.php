<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan_{{ $jenisLaporan }}_{{ \Carbon\Carbon::now()->format('Ymd_His') }}</title>
    <style>
        /* CSS Reset & Page Setting */
        @page {
            size: A4 portrait;
            margin: 15mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        /* Kop Surat Header */
        .header {
            text-align: center;
            padding-bottom: 8px;
            margin-bottom: 12px;
            border-bottom: 3px solid #000;
            position: relative;
        }

        .header::after {
            content: "";
            display: block;
            border-bottom: 1px solid #000;
            margin-top: 2px;
        }

        .header h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0 0 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header p {
            font-size: 9.5pt;
            margin: 0;
            color: #333;
        }

        /* Metadata Laporan */
        .report-info {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .report-info td {
            padding: 3px 0;
            font-size: 10pt;
            vertical-align: top;
        }

        .report-title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0 15px 0;
            text-decoration: underline;
        }

        /* Tabel Data */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 10pt;
        }

        table.data-table th {
            background-color: #f2f2f2 !important;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
            text-align: center;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Helper Alignment Class */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        /* Area Tanda Tangan */
        .signature-section {
            margin-top: 30px;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-box {
            float: right;
            width: 220px;
            text-align: center;
            font-size: 10pt;
        }

        .signature-space {
            height: 65px;
        }

        /* Handling Print State */
        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        {{-- Header / Kop Surat --}}
        <div class="header">
            <h1>Bank Sampah Desa Pulosari</h1>
            <p>Jl. Pulosari, Kecamatan Telagasari, Kabupaten Karawang, Jawa Barat</p>
        </div>

        <div class="report-title">
            {{ $jenisLaporan === 'transaksi' ? 'Laporan Transaksi Setoran Sampah' : 'Laporan Transaksi Pencairan Saldo' }}
        </div>

        {{-- Meta Data Laporan --}}
        <table class="report-info">
            <tr>
                <td style="width: 130px;"><strong>Periode Laporan</strong></td>
                <td style="width: 15px;">:</td>
                <td>
                    {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}
                    s/d
                    {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Cetak</strong></td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} WIB</td>
            </tr>
        </table>

        {{-- Tabel Utama Data --}}
        <table class="data-table">
            <thead>
                @if ($jenisLaporan === 'transaksi')
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Kode Transaksi</th>
                        <th style="width: 30%;">Nama Nasabah</th>
                        <th style="width: 20%;">Petugas</th>
                        <th style="width: 20%;">Tanggal Setoran</th>
                    </tr>
                @else
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 37%;">Nama Nasabah</th>
                        <th style="width: 30%;">Jumlah Pencairan</th>
                        <th style="width: 25%;">Tanggal Pencairan</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        @if ($jenisLaporan === 'transaksi')
                            <td class="text-center">{{ $item->kode_transaksi }}</td>
                            <td class="text-left">{{ $item->nasabah->nama_lengkap ?? '-' }}</td>
                            <td class="text-left">{{ $item->petugas->nama ?? '-' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}</td>
                        @else
                            <td class="text-left">{{ $item->nasabah->nama_lengkap ?? '-' }}</td>
                            <td class="text-right">Rp {{ number_format($item->jumlah_pencairan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_proses ?? $item->tanggal_pengajuan)->translatedFormat('d F Y H:i') }}</td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $jenisLaporan === 'transaksi' ? 5 : 4 }}" class="text-center" style="padding: 15px;">
                            <em>Tidak ada data laporan pada periode ini.</em>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Area Tanda Tangan Admin / Pengurus --}}
        <div class="signature-section">
            <div class="signature-box">
                <p>Karawang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Pengurus Bank Sampah,</p>
                <div class="signature-space"></div>
                <p><strong>( ________________________ )</strong></p>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>
