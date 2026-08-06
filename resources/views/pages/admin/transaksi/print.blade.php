<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Transaksi - Bank Sampah</title>
    <style>
        @page {
            size: auto;
            margin: 0mm;
            /* Menghilangkan header & footer bawaan browser (URL, Tanggal, Halaman) */
        }

        @media print {
            body {
                background-color: #fff;
                font-size: 12px;
                padding: 20mm;
                /* Beri padding agar isi struk tidak menempel di tepi kertas karena margin diset 0 */
            }

            .container {
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                width: 100%;
            }
        }

        /* Base Styling */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        /* Header Styling */
        .header {
            text-align: center;
            border-bottom: 2px dashed #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
        }

        /* Detail Nasabah & Petugas */
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info-section p {
            margin: 5px 0;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #fcfcfc;
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        /* Alignment Helpers */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row td {
            font-size: 16px;
            font-weight: bold;
            border-top: 2px solid #333;
            border-bottom: none;
        }

        /* Footer Styling */
        .footer {
            text-align: center;
            border-top: 2px dashed #ccc;
            padding-top: 20px;
            margin-top: 10px;
        }

        .footer p {
            margin: 5px 0;
            font-style: italic;
            color: #666;
        }

        /* Optimasi Print */
        @media print {
            body {
                background-color: #fff;
                font-size: 12px;
            }

            .container {
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>BANK SAMPAH DESA PULOSARI</h1>
            {{-- Mengubah format tanggal menjadi DD Bulan YYYY --}}
            <p>Tanggal Transaksi:
                <strong>{{ \Carbon\Carbon::parse($tanggal_transaksi)->translatedFormat('d F Y') }}</strong></p>
        </div>

        <div class="info-section">
            <div>
                <p><strong>Nasabah:</strong> {{ $nasabah->nama_lengkap }}</p>
            </div>
            <div class="text-right">
                <p><strong>Petugas:</strong> {{ $petugas->nama }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Jenis Sampah</th>
                    <th class="text-center">Berat (kg)</th>
                    <th class="text-right">Harga / kg</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->sampah->nama_sampah }}</td>
                        <td class="text-center">{{ $detail->berat_kg }}</td>
                        <td class="text-right">Rp {{ number_format($detail->harga_per_kg, 0, ',', '.') }}</td>
                        <td class="text-right">Rp
                            {{ number_format($detail->berat_kg * $detail->harga_per_kg, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="3" class="text-right">Total Transaksi</td>
                    <td class="text-right">
                        Rp {{ number_format($total_transaksi, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Terima kasih telah berkontribusi dalam menjaga lingkungan.</p>
            <p>"Sampahmu, Masa Depan Kita"</p>
        </div>
    </div>

    <script>
        // Pastikan halaman sudah termuat sepenuhnya sebelum mencetak
        window.onload = function() {
            window.print();

            // Redirect setelah dialog print ditutup atau setelah 3 detik
            setTimeout(function() {
                window.location.href = "{{ route('admin.transaksi.index') }}";
            }, 3000);
        }
    </script>
</body>

</html>
