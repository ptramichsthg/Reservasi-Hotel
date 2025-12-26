<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kamar</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .summary p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background-color: #e2e2e2;
            text-align: left;
        }

        th, td {
            padding: 6px;
            vertical-align: top;
        }
    </style>
</head>
<body>

<h2>Laporan Data Kamar</h2>

{{-- =======================
     RINGKASAN STATISTIK
======================= --}}
<div class="summary">
    <p><strong>Total Kamar:</strong> {{ $stat['total_kamar'] ?? 0 }}</p>
    <p><strong>Available:</strong> {{ $stat['available'] ?? 0 }}</p>
    <p><strong>Booked:</strong> {{ $stat['booked'] ?? 0 }}</p>
    <p><strong>Maintenance:</strong> {{ $stat['maintenance'] ?? 0 }}</p>
    <p><strong>Unavailable:</strong> {{ $stat['unavailable'] ?? 0 }}</p>
</div>

{{-- =======================
     TABEL DATA KAMAR
======================= --}}
<table>
    <thead>
        <tr>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Kapasitas</th>
            <th>Fasilitas</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kamar_list as $k)
            <tr>
                <td>{{ $k->tipe_kamar }}</td>
                <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($k->status) }}</td>
                <td>{{ $k->kapasitas ?? 0 }} orang</td>
                <td>
                    @if(is_array($k->fasilitas) && count($k->fasilitas) > 0)
                        {{ implode(', ', $k->fasilitas) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;">
                    Tidak ada data kamar
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
