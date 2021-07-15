@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Pegawai" :section="$page ?? ''" />
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
                                            <td>Status Menikah</td>
                                            <td>{{$employee->marital_status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>{{$employee->jobTitle->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status Kepegawaian</td>
                                            <td>{{$employee->employee_status}}</td>
                                        </tr>
                                        @if ($employee->employee_status == "pns")
                                        <tr>
                                            <td>Golongan PNS</td>
                                            <td>{{$employee->section->name}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Tahun Diterima</td>
                                            <td>{{$employee->entry_year}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{route('pegawai.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
