<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penarikan Saldo</title>
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
        <div class="subtitle">Laporan Penarikan Saldo</div>
        <div class="subtitle">Periode: {{ $request->tanggal_mulai }} s/d {{ $request->tanggal_selesai }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->nasabah->user->name }}</td>
                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->metode_penarikan }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <th colspan="3" style="text-align: right">Total:</th>
                <th colspan="3">Rp {{ number_format($data->sum('jumlah'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>