@extends('base')
@section('plugin')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Dashboard" :section="$page ?? ''"/>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @isset($employeeCount)
            <div class="col-lg-12 col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$employeeCount}}</h3>

                        <p>Total Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('pegawai.index')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
            @isset($pnsCount)
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$pnsCount}}</h3>

                        <p>Total pegawai PNS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('pegawai.index')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
            @isset($honorerCount)
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$honorerCount}}</h3>

                        <p>Total pegawai Honorer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('pegawai.index')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
        </div>
        <!-- /.row -->
        <section>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Monitoring Presensi Pegawai</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nama</th>
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
                                  <td>{{$presence->employee->name}}</td>
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
        </section>
        <section>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pencarian Data Pegawai</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('dashboard.search')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="masukan nip"
                                value="{{old('nip',$request->nip ?? "")}}" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </section>
        @isset($employee)
        <section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{asset('storage/photos/'.$employee->photo)}}" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{$employee->name}}</h3>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#settings"
                                                data-toggle="tab">Biodata</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">

                                        <div class="active tab-pane" id="settings">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>NIP</td>
                                                        <td>{{$employee->nip}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>{{$employee->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>{{$employee->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir</td>
                                                        <td>{{$employee->birth_place}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>{{date('d-m-Y', strtotime($employee->birth_date))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agama</td>
                                                        <td>{{$employee->religion}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>{{$employee->gender}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Pegawai</td>
                                                        <td>{{$employee->employee_status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Pernikahan</td>
                                                        <td>{{$employee->marital_status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun Diterima</td>
                                                        <td>{{$employee->entry_year}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jabatan</td>
                                                        <td>{{$employee->jobTitle->name}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
        </section>
        @endisset



    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('javascript')
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //Date picker
        $('#reservationdate2').datetimepicker({
            format: 'DD/MM/YYYY'
        });

    })

    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endsection
