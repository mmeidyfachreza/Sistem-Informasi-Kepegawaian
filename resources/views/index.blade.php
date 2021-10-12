@extends('base')
@section('style')
<style>
    td, th {
        text-align: center;
    }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Presensi" :section="$page ?? ''" />
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
                        <div style="float:left" class="card-title">List Data</div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tanggal</th>
                                    <th>Jam Datang</th>
                                    <th>Jam Pulang</th>
                                    <th>Status</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x=1?>
                                @if (!$presence)
                                    <tr>
                                        <td>{{$presences->lastItem() + 1}}</td>
                                        <td>
                                            {{now()->toDateString('Y-m-d')}}
                                            <span class="right badge badge-primary">Hari Ini</span>
                                        </td>
                                        <td><a href="{{route("catat.kehadiran")}}" class="btn btn-success">Catat Kehadiran</a></td>
                                        <td></td>
                                        <td>belum catat kehadiran</td>
                                    </tr>
                                @endif
                                @foreach ($presences as $key => $presence)
                                <tr>
                                    <td>{{$presences->lastItem() - $key}}</td>
                                    <td>{{$presence->tanggal}} @if ($presence->tanggal == now()->toDateString('Y-m-d'))
                                        <span class="right badge badge-primary">Hari Ini</span> @endif</td>
                                    <td>{{$presence->jam_datang}}</td>
                                    <td>@if ($presence->tanggal == now()->toDateString('Y-m-d') && !$presence->jam_pulang)
                                        <a href="{{route("catat.kehadiran")}}" class="btn btn-success">Catat Pulang</a>
                                    @else
                                        {{$presence->jam_pulang}}
                                    @endif
                                    </td>
                                    <td>{{$presence->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{$presences->setPath(url()->current())->links('pagination::bootstrap-4')}}
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
