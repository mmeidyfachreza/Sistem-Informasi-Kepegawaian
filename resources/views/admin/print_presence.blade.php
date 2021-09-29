<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presensi {{$employee['nama']}}</title>
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #dddddd;
          text-align: center;
          padding: 8px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>

</head>
<body>
    <p>Nama    : <b>{{$employee['nama']}}</b></p>
    <p>NIP     : <b>{{$employee['nip']}}</b></p>
    <p>Tanggal : <b>{{$request->month}}</b></p>
    <br>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam Hadir</th>
            <th>Jam Pulang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presences as $presence)
        <tr>
            <td>{{$presence->tangal}}</td>
            <td>{{$presence->jam_datang}}</td>
            <td>{{$presence->jam_pulang}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
