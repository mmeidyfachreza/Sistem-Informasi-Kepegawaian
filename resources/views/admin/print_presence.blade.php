<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presensi {{$employee['name']}}</title>
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
    <p>Nama    : <b>{{$employee['name']}}</b></p>
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
            <td>{{$presence->date}}</td>
            <td>{{$presence->arrival_time}}</td>
            <td>{{$presence->return_time}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
