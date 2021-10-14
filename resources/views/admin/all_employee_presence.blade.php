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
                                <form action="{{route('presence.all.filter')}}" method="GET" id="form_filter">
                                    <input type="month" name="month" id="month" value="{{$date}}" onchange="filter()">
                                </form>
                                <form action="{{route('presence.all.print')}}" method="GET" target="_blank" id="form_filter">
                                    <input type="hidden" name="month" id="month" value="{{$date}}">
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
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <span><i class="nav-icon fas fa-user-cog"></i></span>&nbsp;&nbsp;Karyawan izin/sakit
                    </a>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion" style="padding: 20px">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{$employees->firstItem() + $key}}</td>
                                <td>{{$employee->nama}}</td>
                                <td>{{$employee->nip}}</td>
                                <td>{{$employee->status_pegawai}}</td>
                                @if (isset($employee->attendanceToday->status) && in_array($employee->attendanceToday->status,["izin","sakit"]))
                                    <td>
                                        tercatat telah {{$employee->attendanceToday->status}} hari ini
                                    </td>
                                @else
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-info" href="{{route('presence.record.permit',$employee->id)}}">catat izin</a>
                                            <a class="btn btn-warning" href="{{route('presence.record.sick',$employee->id)}}">catat sakit</a>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$employees->setPath(url()->current())->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('javascript')
<script>
    function filter() {
        document.getElementById("form_filter").submit();// Form submission
    }
</script>
@endsection
