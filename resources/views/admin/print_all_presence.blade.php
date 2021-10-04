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
    <p>Bulan : <b>{{$date}}</b></p>
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
        <?php $hadir=0; $alpa=0; $izin=0; $sakit=0; ?>
        <tr>
            <td>{{$x++}}</td>
            <td>{{$employee}}</td>
            @for ($i=0;$i<$day;$i++)
                @if (isset($presence[$i]))
                    @if ($presence[$i]->status=="hadir")
                        <?php $hadir++ ?>
                        <td>.</td>
                    @elseif ($presence[$i]->status=="izin")
                    <?php $izin++ ?>
                        <td>i</td>
                    @elseif ($presence[$i]->status=="sakit")
                    <?php $sakit++ ?>
                        <td>s</td>
                    @elseif ($presence[$i]->status=="alpa")
                    <?php $alpa++ ?>
                        <td>a</td>
                    @endif
                @else
                    <td name > </td>
                @endif
            @endfor
            <td>{{$hadir}}</td>
            <td>{{$alpa}}</td>
            <td>{{$izin}}</td>
            <td>{{$sakit}}</td>
            <td>{{number_format((float)($hadir/$day)*100,2,'.','') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
