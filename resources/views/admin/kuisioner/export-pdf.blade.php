<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kuisioner Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
        .summary {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Kuisioner Alumni</h1>
        <p>{{ config('app.name') }}</p>
        <p>Tanggal: {{ date('d F Y') }}</p>
    </div>

    <div class="summary">
        <h3>Ringkasan</h3>
        <p><strong>Total Responden:</strong> {{ count($data) }} orang</p>
        <p><strong>Tanggal Export:</strong> {{ date('d F Y H:i:s') }}</p>
    </div>

    @if(count($data) > 0)
        <table>
            <thead>
                <tr>
                    @foreach(array_keys($data[0]) as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #666; margin-top: 50px;">
            Belum ada data kuisioner yang tersedia.
        </p>
    @endif

    <div style="margin-top: 30px; text-align: center; color: #666; font-size: 10px;">
        <p>Laporan ini dibuat secara otomatis oleh sistem pada {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
