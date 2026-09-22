<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 8px; }
        .meta { margin-bottom: 12px; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #d1d5db; padding: 6px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Laporan STT Dwi Putra</h1>
    <div class="meta">Dicetak pada {{ now()->translatedFormat('d F Y H:i') }}</div>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tipe</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporan->judul }}</td>
                    <td>{{ ucfirst($laporan->tipe) }}</td>
                    <td>{{ $laporan->tanggal_laporan?->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($laporan->status) }}</td>
                    <td>{{ $laporan->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
