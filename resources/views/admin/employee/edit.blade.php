@extends('base')
@section('plugin')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                        <li>Proses Gagal!!!</li>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('pegawai.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{old('nip', $employee->nip)}}"
                                    placeholder="Masukan NIP" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{old('name', $employee->nama)}}"
                                    placeholder="Masukan Nama" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{old('tempat_lahir', $employee->tempat_lahir)}}"
                                            placeholder="Masukan Tempat Lahir" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_lahir" placeholder="dd/mm/yyyy" value="{{old('tanggal_lahir',date('d/m/Y', strtotime($employee->tanggal_lahir)))}}" required/>
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                @foreach ($genders as $gender)
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="{{$gender}}" name="jenis_kelamin" value="{{$gender}}" @if ($employee->jenis_kelamin==$gender) checked @endif>
                                        <label for="{{$gender}}" class="custom-control-label">{{$gender}}</label>
                                      </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control select2" style="width: 100%;" name="agama">
                                    @foreach ($religions as $data)
                                    <option value="{{$data}}" @if ($employee->agama==$data) selected @endif>{{$data}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select class="form-control select2" style="width: 100%;" name="pendidikan">
                                    @foreach ($educations as $data)
                                    <option value="{{$data}}" @if ($employee->pendidikan==$data) selected @endif>{{$data}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{old('jurusan', $employee->jurusan)}}"placeholder="Masukan Jurusan" required>
                                </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" id="alamat" cols="30" rows="2" required>{{$employee->alamat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Status Pernikahan</label>
                                @foreach ($maritals as $marital)
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="{{$marital}}" name="status_pernikahan" value="{{$marital}}" @if ($employee->status_pernikahan == $marital) checked @endif>
                                        <label for="{{$marital}}" class="custom-control-label">{{$marital}}</label>
                                      </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2" style="width: 100%;" name="jabatan_id">
                                    @foreach ($jobTitles as $data)
                                    <option value="{{$data->id}}" @if ($employee->jabatan->id == $data->id) selected @endif>{{$data->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Status Pegawai</label>
                                        @foreach ($status as $data)
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="{{$data}}" name="status_pegawai" value="{{$data}}" @if ($employee->status_pegawai==$data) checked @endif onclick="myFunction()">
                                                <label for="{{$data}}" class="custom-control-label">{{$data}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="display:block" id="section-field">
                                        <label>Golongan PNS</label>
                                        <select class="form-control select2" style="width: 100%;" name="golongan_id">
                                            <option disabled selected>--Pilih--</option>
                                            @foreach ($sections as $section)
                                            <option value="{{$section->id}}" @if ($employee->golongan->id == $section->id) selected @endif>{{$section->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tahun Diterima</label>
                                <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate3" name="tahun_masuk" value="{{old('tahun_masuk', $employee->tahun_masuk)}}" required/>
                                    <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{old('username', $employee->user->username)}}"
                                            placeholder="Masukan Username" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password jika ingin diperbarui">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Akun</label>
                                <select class="form-control select2" style="width: 100%;" name="tipe_user">
                                    @foreach ($user_types as $user_type)
                                    <option value="{{$user_type}}" @if ($employee->user->tipe_user == $user_type) selected @endif>{{$user_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto Pegawai</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" accept="image/*" name="foto" onchange="preview_image(event)">
                                        <label class="custom-file-label" for="foto">Pilih file</label>
                                    </div>
                                </div>
                                <br>
                                <img style="width:30%" id="output_image" src="{{asset('storage/foto/'.$employee->foto)}}"/>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('pegawai.index')}}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
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
@section('javascript')
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    window.addEventListener("load",function(){
        var checked = document.querySelector('input[name="status_pegawai"]:checked').value;
    if (checked == "pns") {
        document.getElementById("section-field").style.display = 'block';
    } else {
        document.getElementById("section-field").style.display = 'none';
    }
    })

    function myFunction() {
    var checked = document.querySelector('input[name="status_pegawai"]:checked').value;
    if (checked == "pns") {
        document.getElementById("section-field").style.display = 'block';
    } else {
        document.getElementById("section-field").style.display = 'none';
    }
    }
    $(function () {
        //Initialize Select2 Elements
        bsCustomFileInput.init();
        $('.select2').select2()
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //Date picker
        $('#reservationdate2').datetimepicker({
            format: 'YYYY'
        });
        $('#reservationdate3').datetimepicker({
            format: 'YYYY'
        });

    });
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
