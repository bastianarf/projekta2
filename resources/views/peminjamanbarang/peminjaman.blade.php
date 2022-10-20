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
                    <h3 class="text-center">Data Peminjaman Barang</h3>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-5 d-flex mb-1" action="{{ Route('Peminjaman') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Kode Barang atau Nama Barang"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('CetakPeminjaman') }}/{{ $user->id }}">
                            <i class="fa fa-print"></i>&nbsp;
                            Cetak Laporan
                        </a>
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('Peminjaman') }}/{{ $user->id }}/Tambah">
                            <i class="fa fa-envelope"></i>&nbsp;
                            Tambah Data Barang
                        </a>
                    </div>
                    
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty Barang</th>
                                <th scope="col">Merk Barang</th>
                                <th scope="col">Warna Barang</th>
                                <th scope="col">Ruangan Barang</th>
                                <th scope="col">Tgl Pinjam Barang</th>
                                <th scope="col">Tgl Kembali Barang</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

<!-- -----------------------------------------------------------------------------------------------------------------------------
---------------------------- MENAMPILKAN SEMUA BARANG YANG DILIST UNTUK DIPINJAM -------------------------------------- 
---------------------------------------------------------------------------------------------------------------------------------- -->
                            @if($user->role_check(['Admin','Kepala Laboratorium', 'Guru', 'Siswa']))
                            <?php $no = $peminjaman->currentPage()*$peminjaman->perPage()-9; ?>
                            @foreach ($peminjaman as $data_peminjaman)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $data_peminjaman->nama_peminjam }}</td>
                                <td>{!! QrCode::size(100)->generate($data_peminjaman->kode_barang); !!}</td>
                                <?php $num_char=50;  ?>
                                <td>{{ $data_peminjaman->nama_barang }}</td>
                                <td>{{ $data_peminjaman->qty_barang }}</td>
                                <td>{{ $data_peminjaman->merk_barang }}</td>
                                <td>{{ $data_peminjaman->warna_barang }}</td>
                                <td>{{ $data_peminjaman->ruangan_barang }}</td>
                                <td>{{ $data_peminjaman->tgl_pinjam }}</td>
                                <td>{{ $data_peminjaman->tgl_kembali }}</td>
                                <td>{{ $data_peminjaman->keterangan }}</td>
                                <td>

                                <!-- JIKA ROLE ADMIN, BISA MENGUBAH SEMUA DATA PEMINJAMAN -->
                                @if($user->role_check(['Admin']))
                                    <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                    <a href="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $data_peminjaman->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $data_peminjaman->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $data_peminjaman->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $data_peminjaman->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->kode_barang }} </h6>
                                                        <h6>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->nama_barang }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                <!-- JIKA ROLE KALAB, MENU EDIT HAPUS HANYA TERSEDIA PADA BARANG DI BAWAH RUANG YANG DI LABORATORIUM II -->
                                @if($user->role_check(['Kepala Laboratorium']) && $user->ruang_kalab == $data_peminjaman->ruangan_barang)
                                <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                    <a href="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $data_peminjaman->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $data_peminjaman->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $data_peminjaman->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $data_peminjaman->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->kode_barang }} </h6>
                                                        <h6>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->nama_barang }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                <!-- JIKA ROLE GURU DAN SISWA, MENU EDIT HAPUS HANYA TERSEDIA PADA BARANG YANG DIBUAT -->
                                @if($user->role_check(['Guru', 'Siswa']) && $user->id == $data_peminjaman->users_id)
                                <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                    <a href="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a> 
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $data_peminjaman->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $data_peminjaman->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $data_peminjaman->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $data_peminjaman->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->kode_barang }} </h6>
                                                        <h6>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_peminjaman->nama_barang }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Peminjaman') }}/{{ $data_peminjaman->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                </td>
                            <?php $no++;?>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{ $peminjaman->render() }}
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