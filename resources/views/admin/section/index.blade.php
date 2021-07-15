@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Golongan" :section="$page ?? ''"/>
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
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('golongan.create')}}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($sections as $key => $section)
                                <tr>
                                    <td>{{$sections->firstItem() + $key}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="{{route('golongan.edit',$section->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            <form action="{{route('golongan.destroy',$section->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    {{$sections->setPath(url()->current())->links('pagination::bootstrap-4')}}
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
