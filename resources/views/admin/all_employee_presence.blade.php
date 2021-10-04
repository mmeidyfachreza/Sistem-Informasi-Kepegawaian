@extends('base')
@section('style')
<style>
    td, th {
            text-align: center;
            padding: 8px;
        }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Presensi" section="Pegawai" />
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <div style="float:left" class="card-title">Presensi Seluruh Pegawai</div>
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('presence.filter')}}" method="GET" target="_blank">
                                    @csrf
                                    <input type="month" name="month" id="month" value="{{$date}}">
                                    <button type="submit" class="btn btn-success btn-sm"><i
                                            class="fa fa-print"></i>&nbsp Cetak Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
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
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
