@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Presensi" section="Pegawai"/>
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
                        <div style="float:left" class="card-title">Presensi {{$employee['name']}}</div>
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('cetak.presensi',$employee['id'])}}" class="btn btn-success btn-sm" target="_blank"><i
                                    class="fa fa-print"></i>&nbsp Cetak Data</a>
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
                                    <td>{{$presence->date}}</td>
                                    <td>{{$presence->arrival_time}}</td>
                                    <td>{{$presence->return_time}}</td>
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
