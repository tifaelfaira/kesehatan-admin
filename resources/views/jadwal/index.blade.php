<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Kesehatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #d3ddeeff;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #c1caffff;
        }
        th {
            background: #66a7b8ff;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #dff9fb;
        }
    </style>
</head>
<body>
    <h1>📅 Daftar Jadwal Kesehatan</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tema</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $item)
                <tr>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['tema'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
