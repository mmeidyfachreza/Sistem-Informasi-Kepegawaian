<!-- Sidebar -->
<div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('storage/foto/'.auth()->user()->pegawai->foto)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{route('profile')}}" class="d-block">{{auth()->user()->pegawai->nama}} <span style="position: absolute;
                right: 1rem;
                top: .5rem;" class="right badge badge-success">Admin</span></a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="{{route('admin.home')}}" class="nav-link active">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Beranda
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('pegawai.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Pegawai
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('jabatan.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Jabatan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('golongan.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>
                        Golongan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('presensi.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-check"></i>
                    <p>
                        Presensi
                    </p>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="{{route('akun-sekolah.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Akun Sekolah
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('sekolah.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-school"></i>
                    <p>
                        Sekolah
                    </p>
                </a>
            </li> --}}
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
