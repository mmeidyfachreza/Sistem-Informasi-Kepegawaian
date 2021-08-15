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
                        <h3 class="card-title">Tambah Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('pegawai.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip"
                                    placeholder="Masukan NIP Pegawai" value="{{old('nip')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama Pegawai" value="{{old('name')}}" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="birth_place">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="birth_place" name="birth_place"
                                            placeholder="Masukan Tempat Lahir" value="{{old('birth_place')}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="birth_date" placeholder="dd/mm/yyyy" value="{{old('birth_date')}}" autocomplete="off" required/>
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
                                        <input class="custom-control-input" type="radio" id="{{$gender}}" name="gender" value="{{$gender}}">
                                        <label for="{{$gender}}" class="custom-control-label">{{$gender}}</label>
                                      </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control select2" style="width: 100%;" name="religion">
                                    @foreach ($religions as $religion)
                                    <option value="{{$religion}}" {{ $religion == old('religion') ? 'selected' : '' }}>{{$religion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select class="form-control select2" style="width: 100%;" name="education">
                                    @foreach ($educations as $education)
                                    <option value="{{$education}}" {{ $education == old('education') ? 'selected' : '' }}>{{$education}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="major">Jurusan</label>
                                <input type="text" class="form-control" id="major" name="major"
                                    placeholder="Masukan Jurusan" value="{{old('major')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" id="address" cols="30" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status Pernikahan</label>
                                @foreach ($maritals as $marital)
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="{{$marital}}" name="marital" value="{{$marital}}" @if ($marital == "belum menikah") checked @endif>
                                        <label for="{{$marital}}" class="custom-control-label">{{$marital}}</label>
                                      </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2" style="width: 100%;" name="job_title_id">
                                    @foreach ($jobTitles as $jobTitle)
                                    <option value="{{$jobTitle->id}}">{{$jobTitle->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status Pegawai</label>
                                        @foreach ($status as $data)
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="{{$data}}" name="employee_status" value="{{$data}}" @if ($data == "pns") checked @endif onclick="myFunction()">
                                                <label for="{{$data}}" class="custom-control-label">{{$data}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" style="display:block" id="section-field">
                                        <label>Golongan PNS</label>
                                        <select class="form-control select2" style="width: 100%;" name="section_id">
                                            <option disabled selected>--Pilih--</option>
                                            @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tahun Diterima</label>
                                <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate3" name="entry_year" value="{{old('entry_year')}}" required/>
                                    <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Masukan username untuk login ke sistem" value="{{old('username')}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukan password untuk login ke sistem" value="{{old('password')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Akun</label>
                                <select class="form-control select2" style="width: 100%;" name="user_type">
                                    @foreach ($user_types as $user_type)
                                    <option value="{{$user_type}}" {{ $user_type == old('user_type') ? 'selected' : '' }}>{{$user_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ijazah">Foto Pegawai</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" accept="image/*" name="photo" onchange="preview_image(event)" required>
                                        <label class="custom-file-label" for="photo">Pilih file</label>
                                    </div>
                                </div>
                                <br>
                                <img style="width:30%" id="output_image"/>
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
    function myFunction() {
    var checked = document.querySelector('input[name="employee_status"]:checked').value;
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
