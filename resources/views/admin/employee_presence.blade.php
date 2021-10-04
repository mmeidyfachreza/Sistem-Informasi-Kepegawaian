@extends('base')
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
                        <div style="float:left" class="card-title">Presensi {{$employee['nama']}}</div>
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('cetak.presensi')}}" method="GET" target="_blank">
                                    @csrf
                                    <input type="month" name="month" id="month" value="{{$date}}">
                                    <input type="hidden" value="{{$employee['id']}}" name="pegawai_id">
                                    <button type="submit" class="btn btn-success btn-sm"><i
                                            class="fa fa-print"></i>&nbsp Cetak Data</button>
                                </form>
                            </div>
                        </div>
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
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x=1?>
                                @foreach ($presences as $key => $presence)
                                <tr>
                                    <td>{{$presences->firstItem() + $key}}</td>
                                    <td>{{$presence->tanggal}}</td>
                                    <td>{{$presence->jam_datang}}</td>
                                    <td>{{$presence->jam_pulang}}</td>
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
