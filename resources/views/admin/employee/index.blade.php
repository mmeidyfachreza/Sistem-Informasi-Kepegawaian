@extends('base')
@section('plugin')
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Pegawai" :section="$page ?? ''"/>
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
                        <span><i class="nav-icon fas fa-search"></i></span>&nbsp;&nbsp;Pencarian
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse @isset($request) show @endisset" data-parent="#accordion">
                    <form action="{{route('search.employee')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="value">NIP/Nama Karyawan</label>
                                <input type="text" class="form-control" id="value" name="name" placeholder="masukan NISN/Nama pegawai" value="{{old('nisn',$request->value ?? "")}}" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Cari</button>
                            @isset($request)
                            <a href="{{route('employee.index')}}" class="btn btn-danger">Batalkan</a>
                            @endisset
                        </div>
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
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                    data-target="#modal-sm">
                                    Import Data pegawai
                                </button> --}}
                                <a href="{{route('pegawai.create')}}" class="btn btn-primary btn-sm">Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->nip}}</td>
                                    <td>{{$employee->employee_status}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-info" href="{{route('pegawai.show',$employee->id)}}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-warning" href="{{route('pegawai.edit',$employee->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            @if (auth()->user()->id != $employee->id)
                                            <form action="{{route('pegawai.destroy',$employee->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{$employees->setPath(url()->current())->links('pagination::bootstrap-4')}}
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
        {{-- <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import Data pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('employee.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <p>Pastikan mengikuti format excel yang telah disediakan sebelum melakukan import data</p>
                            <p><a href="{{route('employee.format.export')}}" class="btn btn-success btn-sm">Download
                                    Format Excel</a></p>

                            <div class="form-group">
                                <label for="employeeImport">Upload File Excel</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="employeeImport"
                                            name="employeeImport" required>
                                        <label class="custom-file-label" for="employeeImport">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="page" value="{{$page}}">

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Proses</button>
                        </div>
                </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div> --}}

        <!-- /.modal -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('javascript')
<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        bsCustomFileInput.init();

    });
  </script>
@endsection
