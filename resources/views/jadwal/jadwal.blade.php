@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(108, 16, 169)">
        
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                
                <div class="tab-pane fade table-responsive active show" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <h3 class="text-center">Data Jadwal Penggunaan Laboratorium</h3>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-5 d-flex mb-1" action="{{ Route('Jadwal') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Ruang Laboratorium atau Kelas"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('CetakJadwal') }}/{{ $user->id }}">
                            <i class="fa fa-print"></i>&nbsp;
                            Cetak Jadwal
                        </a>
                        @if ($user->role_check(['Admin','Kepala Laboratorium','Guru']))
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('Jadwal') }}/{{ $user->id }}/Tambah">
                            <i class="fa fa-envelope"></i>&nbsp;
                            Tambah Jadwal
                        </a>
                        @endif
                    </div>
                    
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Laboratorium Komputer</th>
                                <th scope="col">Ruang Kelas</th>
                                <th scope="col">Tanggal Penggunaan</th>
                                <th scope="col">Waktu Mulai</th>
                                <th scope="col">Waktu Selesai</th>
                                <th scope="col">Nama Pelajaran</th>
                                <th scope="col">Nama Guru</th>
                                @if ($user->role_check(['Admin','Kepala Laboratorium', 'Guru']))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

<!-- -----------------------------------------------------------------------------------------------------------------------------
---------------------------- TAMPILKAN SEMUA JADWAL  -------------------------------------- 
---------------------------------------------------------------------------------------------------------------------------------- -->
                            <?php $no = $jadwal->currentPage()*$jadwal->perPage()-9; ?>
                            @foreach ($jadwal as $jadwal_lab)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $jadwal_lab->ruang_lab }}</td>
                                <td>{{ $jadwal_lab->kelas }}</td>
                                <td>{{ $jadwal_lab->tgl_penggunaan }}</td>
                                <td>{{ $jadwal_lab->waktu_penggunaan_mulai }}</td>
                                <td>{{ $jadwal_lab->waktu_penggunaan_akhir }}</td>
                                <td>{{ $jadwal_lab->nama_matpel }}</td>
                                <td>{{ $jadwal_lab->nama_guru }}</td>

                                @if ($user->role_check(['Admin']))
                                <td>
                                    <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                    <a href="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $jadwal_lab->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $jadwal_lab->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $jadwal_lab->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $jadwal_lab->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Ruang Laboratorium&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->ruang_lab }} </h6>
                                                        <h6>Kelas&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->kelas }}</h6>
                                                        <h6>Tanggal Penggunaan&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->tgl_penggunaan }}</h6>
                                                        <h6>Pelajaran&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_matpel }}</h6>
                                                        <h6>Guru&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_guru }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                @endif

                                <!-- JIKA ROLE KEPALA LABORATORIUM, MAKA ACTION AKAN KELUAR DI JADWAL DI LABORATORIUM YANG DIKEPALAI -->
                                @if ($user->role_check(['Kepala Laboratorium']) && $user->ruang_kalab == $jadwal_lab->ruang_lab)
                                <td>
                                    <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                    <a href="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $jadwal_lab->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $jadwal_lab->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $jadwal_lab->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $jadwal_lab->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Ruang Laboratorium&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->ruang_lab }} </h6>
                                                        <h6>Kelas&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->kelas }}</h6>
                                                        <h6>Tanggal Penggunaan&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->tgl_penggunaan }}</h6>
                                                        <h6>Pelajaran&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_matpel }}</h6>
                                                        <h6>Guru&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_guru }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                @endif

                                @if ($user->role_check(['Guru']) && $user->nama_lengkap == $jadwal_lab->nama_guru)
                                <td>
                                    <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                    <a href="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $jadwal_lab->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $jadwal_lab->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $jadwal_lab->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $jadwal_lab->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Ruang Laboratorium&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->ruang_lab }} </h6>
                                                        <h6>Kelas&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->kelas }}</h6>
                                                        <h6>Tanggal Penggunaan&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->tgl_penggunaan }}</h6>
                                                        <h6>Pelajaran&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_matpel }}</h6>
                                                        <h6>Guru&nbsp;&nbsp;&nbsp;&nbsp; : {{ $jadwal_lab->nama_guru }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Jadwal') }}/{{ $jadwal_lab->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                @endif
                                
                            <?php $no++;?>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jadwal->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.copyright')
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection