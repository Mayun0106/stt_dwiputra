<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            margin: 0;
            padding: 24px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 24px;
        }
        .logo {
            max-height: 60px;
            width: auto;
        }
        .title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #111827;
        }
        .subtitle {
            margin: 8px 0 0;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.5;
        }
        .meta {
            color: #6b7280;
            font-size: 12px;
            margin-top: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }
        th,
        td {
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
            font-size: 12px;
        }
        th {
            background-color: #f8fafc;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .footer {
            margin-top: 24px;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1 class="title">{{ $title }}</h1>
            <p class="subtitle">{{ $subtitle }}</p>
            <p class="meta">Dicetak: {{ $printedAt }}</p>
        </div>
        @if (!empty($logo))
            <img src="{{ $logo }}" alt="Logo" class="logo">
        @endif
    </div>

    <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $column)
                        <td>{{ $column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Laporan dihasilkan oleh sistem STT Dwi Putra.</div>
</body>
</html>
