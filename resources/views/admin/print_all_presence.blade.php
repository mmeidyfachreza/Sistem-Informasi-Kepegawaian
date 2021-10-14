<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Presensi {{$employee['nama']}}</title> --}}
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
    </style>

</head>
<body>
    <p>Bulan : <b>{{date('F Y', strtotime($date))}}</b></p>
    <br>
    <table>
        <thead>
            <tr>
                <td rowspan="2">No</td>
                <td rowspan="2">Nama</td>
                <td colspan="{{$day}}">Tanggal</td>
                <td colspan="4">Jumlah</td>
                <td rowspan="2">Presentase Kehadiran</td>
            </tr>
            <tr>
                @for ($i=1;$i<=$day;$i++)
                <td>{{$i}}</td>
                @endfor
                <td>Hadir</td>
                <td>Alpha</td>
                <td>Izin</td>
                <td>Sakir</td>
            </tr>
        </thead>
        <tbody>
            <?php $x=1 ?>
            @foreach ($presences as $employee => $presence)
            <tr>
                <td>{{$x++}}</td>
                <td>{{$employee}}</td>
                @for ($i=1;$i<=$day;$i++)
                    @if (isset($presence["rekap"][$i]))
                        @if ($presence["rekap"][$i]=='h')
                        <td><img src="{{asset('assets/dist/img/done.png')}}" style="height: 20px;weight: 20px" alt="h"></td>
                        @else
                        <td>{{$presence["rekap"][$i]}}</td>
                        @endif
                    @else
                        <td> </td>
                    @endif
                @endfor
                <td>{{$presence["hadir"]}}</td>
                <td>{{$presence["alpa"]}}</td>
                <td>{{$presence["izin"]}}</td>
                <td>{{$presence["sakit"]}}</td>
                <td>{{$presence["presentase_kehadiran"]}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
