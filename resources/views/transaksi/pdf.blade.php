<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th { background-color: #f2f2f2; padding: 8px; text-align: left; font-weight: bold; }
        td { padding: 8px; }
        .text-right { text-align: right; }
        .footer { text-align: right; margin-top: 50px; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Transaksi Penjualan</h2>
        <p>Aplikasi Monitoring Transaksi Perusahaan - Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th>Kode Toko</th>
                <th class="text-right">Nominal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>Toko #{{ $transaksi->kode_toko }}</td>
                    <td class="text-right">Rp {{ number_format($transaksi->nominal_transaksi, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis oleh sistem web Laravel.</p>
    </div>
</body>
</html>