<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 24px;
        }
        h1 {
            margin: 0 0 8px;
            font-size: 22px;
            color: #111827;
        }
        .subtitle {
            margin: 0 0 18px;
            color: #4b5563;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f3f4f6;
            font-size: 10px;
            text-transform: uppercase;
        }
        .badge {
            padding: 4px 7px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }
        .baik { background: #dcfce7; color: #166534; }
        .ringan { background: #fef3c7; color: #92400e; }
        .berat { background: #fee2e2; color: #991b1b; }
        .muted { color: #6b7280; }
        .foto { width: 40px; height: 40px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Laporan Inventaris</h1>
    <p class="subtitle">STT Dwi Putra • Dicetak pada {{ $printedAt }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventaris as $index => $item)
                @php
                    $kondisiText = match ($item->kondisi) {
                        'baik' => 'Baik',
                        'rusak' => 'Rusak Ringan',
                        'hilang' => 'Rusak Berat',
                        default => ucfirst((string) $item->kondisi),
                    };

                    $badgeClass = match ($item->kondisi) {
                        'baik' => 'baik',
                        'rusak' => 'ringan',
                        'hilang' => 'berat',
                        default => 'muted',
                    };
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if ($item->foto)
                            <img src="{{ public_path('storage/' . $item->foto) }}" width="40" height="40" class="foto" alt="Foto {{ $item->nama_barang }}">
                        @else
                            <span class="muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->kode_barang ?? '-' }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $kondisiText }}</span></td>
                    <td>{{ $item->lokasi ?? '-' }}</td>
                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="muted">Tidak ada data inventaris.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
