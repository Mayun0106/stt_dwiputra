<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 24px;
            color: #0f172a;
        }
        header {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }
        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        p {
            margin: 4px 0 0;
            color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 10px 12px;
            text-align: left;
            font-size: 13px;
            vertical-align: top;
        }
        th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 11px;
            color: #475569;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .print-note {
            font-size: 12px;
            color: #6b7280;
            margin-top: 8px;
        }
        @media print {
            body {
                padding: 0;
            }
            header {
                margin-bottom: 18px;
            }
        }
    </style>
    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>
</head>
<body>
    <header>
        <div>
            <h1>{{ $title }}</h1>
            <p>{{ $count }} item{{ $count === 1 ? '' : 's' }} tercetak.</p>
        </div>
        <div class="print-note">Gunakan kontrol pencetakan browser untuk mencetak halaman ini.</div>
    </header>

    <table>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $item)
                <tr>
                    @if ($type === 'anggota')
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan ?? '-' }}</td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>{{ $item->nomor_hp ?? '-' }}</td>
                        <td>{{ ucfirst($item->status ?? '-') }}</td>
                    @elseif ($type === 'inventaris')
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori ?? '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ ucfirst($item->kondisi ?? '-') }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $item->status ?? '-')) }}</td>
                    @elseif ($type === 'kegiatan')
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ optional($item->tanggal_mulai)->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->lokasi ?? '-' }}</td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td>{{ ucfirst($item->status ?? '-') }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
