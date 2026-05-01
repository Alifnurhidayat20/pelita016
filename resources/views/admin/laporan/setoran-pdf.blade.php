<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Setoran Sampah</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; color: #065f46; }
        .subtitle { color: #666; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #22c55e; color: white; }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; color: #666; }
        .total { font-weight: bold; background-color: #f0fdf4; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PELITA 016</div>
        <div class="subtitle">Laporan Setoran Sampah</div>
        <div class="subtitle">Periode: {{ $request->tanggal_mulai }} s/d {{ $request->tanggal_selesai }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Jenis Sampah</th>
                <th>Berat (kg)</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($item->tanggal_setor)) }}</td>
                <td>{{ $item->nasabah->user->name }}</td>
                <td>{{ $item->hargaSampah->jenis_sampah }}</td>
                <td>{{ number_format($item->berat, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <th colspan="5" style="text-align: right">Total:</th>
                <th>Rp {{ number_format($data->sum('total_harga'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>