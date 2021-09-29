@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Presensi" :section="$page ?? ''"/>
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
        <div id="accordion">
            <div class="card card-primary">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <span><i class="nav-icon fa fa-pen"></i></span>&nbsp;&nbsp;Catat Presensi
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse @isset($request) show @endisset" data-parent="#accordion">
                    <form action="{{route('presensi.store')}}" method="POST">
                        @csrf
                        @if ($button == "catat hadir")
                            <input type="hidden" name="jam_datang" value="{{now()->toTimeString('second')}}">
                            <input type="hidden" name="tanggal" value="{{now()->toDateString('Y-m-d')}}">
                        @elseif ($button == "catat pulang")
                            <input type="hidden" name="jam_pulang" value="{{now()->toTimeString('second')}}">
                            <input type="hidden" name="presensi_id" value="{{$presence->id}}">
                            <input type="hidden" name="tanggal" value="{{now()->toDateString('Y-m-d')}}">
                        @endif

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6"><button type="submit" class="btn btn-{{$type}}" @if ($button == "Selamat Beristirahat") disabled @endif>{{$button}}</button></div>
                                <div class="col-lg-6"><b>Status</b>: {{$status}}</div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                      </form>
                </div>
            </div>
        </div>
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
                            {{-- <th>Aksi</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($presences as $key => $presence)
                                <tr>
                                    <td>{{$presences->lastItem() - $key}}</td>
                                    <td>{{$presence->tanggal}} @if ($presence->tanggal == now()->toDateString('Y-m-d')) <span class="right badge badge-primary">Hari Ini</span> @endif</td>
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
