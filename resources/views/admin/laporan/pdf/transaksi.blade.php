<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid black; padding: 6px; }
        th { background: #e2e2e2; }
    </style>
</head>
<body>

<h2>Laporan Transaksi Reservasi</h2>

<table>
    <thead>
        <tr>
            <th>Nama Tamu</th>
            <th>Kamar</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>

    <tbody>
        @foreach($reservasi as $r)
        <tr>
            <td>{{ $r->user->name ?? '-' }}</td>
            <td>{{ $r->kamar->tipe_kamar ?? '-' }}</td>
            <td>{{ $r->tgl_checkin }}</td>
            <td>{{ $r->tgl_checkout }}</td>
            <td>Rp {{ number_format($r->total_harga,0,',','.') }}</td>
            <td>{{ ucfirst($r->status_pembayaran) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
