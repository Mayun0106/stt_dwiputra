<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #0f172a;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 11px;
            color: #475569;
            margin-top: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #e2e8f0;
            font-size: 10px;
            text-transform: uppercase;
        }
        td {
            font-size: 10px;
        }
        .status {
            font-weight: bold;
        }
        .status.aktif {
            color: #15803d;
        }
        .status.nonaktif {
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Data Anggota</div>
        <div class="subtitle">STT Dwi Putra</div>
        <div class="subtitle">Dicetak pada: {{ $printedAt }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggotas as $index => $anggota)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->jabatan ?? '-' }}</td>
                    <td>{{ $anggota->email ?? '-' }}</td>
                    <td>{{ $anggota->nomor_hp ?? '-' }}</td>
                    <td>{{ $anggota->alamat ?? '-' }}</td>
                    <td>{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                    <td class="status {{ $anggota->status ?? 'nonaktif' }}">
                        {{ ucfirst($anggota->status ?? 'nonaktif') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
