<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <h4 align="center" style="color: white">{{ $user->role }}</h4>
    <hr style="border: 1px solid white; width:100%">
    <a class="nav-link text-white{{ request()->is('Home') ? ' active' : '' }}" href="{{ Route('Home') }}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-th"></i>&nbsp; Home</a>

    <!-- ROLE KETIKA BELUM BUAT KETERANGAN SEMUA -->
    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['']))
    <a class="nav-link text-white{{ request()->is('Kepala Laboratorium') ? ' active' : '' }}" href="{{ Route('Home/Profile/Edit')}}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-users"></i>&nbsp; Lengkapi Data Kalab
    </a>
    @endif

    @if ($user->role_check(['Guru']) && $user->mapel_check(['']))
    <a class="nav-link text-white{{ request()->is('Guru') ? ' active' : '' }}" href="{{ Route('Home/Profile/Edit')}}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-users"></i>&nbsp; Lengkapi Data Guru
    </a>
    @endif

    @if ($user->role_check(['Siswa']) && $user->kelas_check(['']))
    <a class="nav-link text-white{{ request()->is('Siswa') ? ' active' : '' }}" href="{{ Route('Home/Profile/Edit')}}"
        role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-users"></i>&nbsp; Lengkapi Data Siswa
    </a>
    @endif

    <!-- MENU INVENTARIS BARANG (ROLE: ADMINISTRATOR) -->

    @if ($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Barang" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-archive"></i>&nbsp;
        Inventaris Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Barang/Tambah') ? ' show' : '' }}{{ request()->is('Barang/') ? ' show' : '' }}"
                id="Barang">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU INVENTARIS BARANG (ROLE:KEPALA LABORATORIUM) -->

    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Barang" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-archive"></i>&nbsp;
        Inventaris Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Barang/Tambah') ? ' show' : '' }}{{ request()->is('Barang/') ? ' show' : '' }}"
                id="Barang">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU PERBAIKAN BARANG (ROLE:ADMIN & KEPALA LABORATORIUM) -->
    
    @if ($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Perbaikan" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Perbaikan Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Perbaikan/Tambah') ? ' show' : '' }}{{ request()->is('Perbaikan/') ? ' show' : '' }}"
                id="Perbaikan">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Perbaikan') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Perbaikan Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Perbaikan') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Perbaikan Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Perbaikan" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Perbaikan Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Perbaikan/Tambah') ? ' show' : '' }}{{ request()->is('Perbaikan/') ? ' show' : '' }}"
                id="Perbaikan">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Perbaikan') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Perbaikan Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Perbaikan') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Perbaikan Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU PENGAJUAN BARANG (ROLE:ADMIN & KEPALA LABORATORIUM) -->
    
    @if ($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Pengajuan" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Pengajuan Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Pengajuan/Tambah') ? ' show' : '' }}{{ request()->is('Pengajuan/') ? ' show' : '' }}"
                id="Pengajuan">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Pengajuan') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Pengajuan Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Pengajuan') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Pengajuan Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Pengajuan" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Pengajuan Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Pengajuan/Tambah') ? ' show' : '' }}{{ request()->is('Pengajuan/') ? ' show' : '' }}"
                id="Pengajuan">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Pengajuan') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Pengajuan Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Pengajuan') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Pengajuan Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

<!-- MENU PEMINJAMAN BARANG (SEMUA ROLE) PART KEPALA LABORATORIUM -->
    
@if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Peminjaman" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Peminjaman Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Peminjaman/Tambah') ? ' show' : '' }}{{ request()->is('Peminjaman/') ? ' show' : '' }}"
                id="Peminjaman">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Peminjaman Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Peminjaman Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- MENU PEMINJAMAN BARANG (ROLE:SEMUA) PART ADMIN -->
@if ($user->role_check(['Admin'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Peminjaman" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Peminjaman Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Peminjaman/Tambah') ? ' show' : '' }}{{ request()->is('Peminjaman/') ? ' show' : '' }}"
                id="Peminjaman">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Peminjaman Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Peminjaman Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- MENU PEMINJAMAN BARANG (ROLE:SEMUA) PART GURU -->
@if ($user->role_check(['Guru']) && $user->mapel_check(['Prakarya dan Kewirausahaan','Bahasa Indonesia','Bahasa Inggris','Pendidikan Agama Islam','Pendidikan Kewarganegaraan','Matematika','IPA','IPS','TIK','Penjasorkes'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Peminjaman" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Peminjaman Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Peminjaman/Tambah') ? ' show' : '' }}{{ request()->is('Peminjaman/') ? ' show' : '' }}"
                id="Peminjaman">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Peminjaman Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Peminjaman Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- MENU PEMINJAMAN BARANG (ROLE:SEMUA) PART SISWA -->
@if ($user->role_check(['Siswa']) && $user->kelas_check(['7A','7B','7C','7D','7E','8A','8B','8C','8D','8E','9A','9B','9C','9D','9E','9F'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Peminjaman" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-bars"></i>&nbsp;
        Peminjaman Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Peminjaman/Tambah') ? ' show' : '' }}{{ request()->is('Peminjaman/') ? ' show' : '' }}"
                id="Peminjaman">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Data Peminjaman Barang
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Peminjaman') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Peminjaman Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

    <!-- MENU JADWAL LABORATORIUM (ROLE : SEMUA) PART ADMIN -->
    @if($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Jadwal" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-calendar"></i>&nbsp;
        Jadwal</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Jadwal/Tambah') ? ' show' : '' }}{{ request()->is('Jadwal/') ? ' show' : '' }}"
                id="Jadwal">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Jadwal Laboratorium
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Jadwal Laboratorium
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU JADWAL LABORATORIUM (ROLE : SEMUA) PART LABORATORIUM -->
    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Jadwal" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-calendar"></i>&nbsp;
        Jadwal</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Jadwal/Tambah') ? ' show' : '' }}{{ request()->is('Jadwal/') ? ' show' : '' }}"
                id="Jadwal">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Jadwal Laboratorium
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Jadwal Laboratorium
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU JADWAL LABORATORIUM (ROLE : SEMUA) PART GURU -->
    @if ($user->role_check(['Guru']) && $user->mapel_check(['Prakarya dan Kewirausahaan','Bahasa Indonesia','Bahasa Inggris','Pendidikan Agama Islam','Pendidikan Kewarganegaraan','Matematika','IPA','IPS','TIK','Penjasorkes'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Jadwal" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-calendar"></i>&nbsp;
        Jadwal</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Jadwal/Tambah') ? ' show' : '' }}{{ request()->is('Jadwal/') ? ' show' : '' }}"
                id="Jadwal">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Jadwal Laboratorium
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Jadwal Laboratorium
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU JADWAL LABORATORIUM (ROLE : SEMUA) PART SISWA -->
    @if ($user->role_check(['Siswa']) && $user->kelas_check(['7A','7B','7C','7D','7E','8A','8B','8C','8D','8E','9A','9B','9C','9D','9E','9F'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Jadwal" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-calendar"></i>&nbsp;
        Jadwal</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Jadwal/Tambah') ? ' show' : '' }}{{ request()->is('Jadwal/') ? ' show' : '' }}"
                id="Jadwal">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}/{{ $user->id }}/Tambah" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Tambah Jadwal Laboratorium
                    </a>
                </div>
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Jadwal') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Jadwal Laboratorium
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU KHUSUS ADMINISTRATOR -->
    @if ($user->role_check(['Admin']))
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Administrator" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-key"></i>&nbsp;
        Administrator</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Admin/Show') ? ' show' : '' }}"
                id="Administrator">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Admin/Show') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-users"></i>
                        &nbsp; Data Users
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU UNTUK GURU DAN SISWA UNTUK MELIHAT INVENTARIS BARANG (PART GURU) -->
    @if ($user->role_check(['Guru']) && $user->mapel_check(['Prakarya dan Kewirausahaan','Bahasa Indonesia','Bahasa Inggris','Pendidikan Agama Islam','Pendidikan Kewarganegaraan','Matematika','IPA','IPS','TIK','Penjasorkes'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Barang" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-archive"></i>&nbsp;
        Inventaris Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Barang/Tambah') ? ' show' : '' }}{{ request()->is('Barang/') ? ' show' : '' }}"
                id="Barang">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- MENU UNTUK GURU DAN SISWA UNTUK MELIHAT INVENTARIS BARANG (PART SISWA) -->
    @if ($user->role_check(['Siswa']) && $user->kelas_check(['7A','7B','7C','7D','7E','8A','8B','8C','8D','8E','9A','9B','9C','9D','9E','9F'])) 
    <a class="nav-link text-white text-left dropdown-toggle" type="button" data-toggle="collapse"
        data-target="#Barang" aria-expanded="false" aria-controls="multiCollapse"><i class="fa fa-archive"></i>&nbsp;
        Inventaris Barang</a>
    <div class="row">
        <div class="col">
            <div class="collapse {{ request()->is('Barang/Tambah') ? ' show' : '' }}{{ request()->is('Barang/') ? ' show' : '' }}"
                id="Barang">
                <div class="card border-succes ml-lg-5 bg-primary mb-2">
                    <a class="nav-link text-left{{ request()->is('Admin/Show') ? ' bg-white' : ' text-white' }}"
                        href="{{ Route('Barang') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="fa fa-archive"></i>
                        &nbsp; Data Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <a class="nav-link text-white{{ request()->is('Users/Profile') ? ' active' : '' }}"
        href="{{ Route('Home/Profile') }}" role="tab" aria-controls="v-pills-home" aria-selected="true"><i
            class="fa fa-user">
        </i>
        &nbsp; Profile
    </a>
</div>