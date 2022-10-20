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
                    <h3 class="text-center">Data Barang</h3>
                    @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratoratorium Komputer 3']))
                    <h5 class="text-center"> {{ $user->ruang_kalab }} </h5>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-5 d-flex mb-1" action="{{ Route('Barang') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Kode Barang atau Nama Barang"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                        
                        @if ($user->role_check(['Admin','Kepala Laboratorium']))
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('CetakBarang') }}/{{ $user->id }}">
                            <i class="fa fa-print"></i>&nbsp;
                            Cetak Laporan Barang
                        </a>
                        
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('Barang') }}/{{ $user->id }}/Tambah">
                            <i class="fa fa-envelope"></i>&nbsp;
                            Tambah Barang
                        </a>
                        @endif
                    </div>
                    
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty Barang</th>
                                @if ($user->role_check(['Admin']))
                                <th scope="col">Ruangan Barang</th>
                                @endif
                                <th scope="col">Merk Barang</th>
                                <th scope="col">Warna Barang</th>
                                <th scope="col">Kondisi Barang</th>
                                <th scope="col">Catatan Barang</th>
                                @if ($user->role_check(['Admin','Kepala Laboratorium']))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

<!-- -----------------------------------------------------------------------------------------------------------------------------
---------------------------- KALAU USERNYA ADMIN, GURU, SISWA, YANG DITAMPILIN SEMUA BARANG -------------------------------------- 
---------------------------------------------------------------------------------------------------------------------------------- -->
                            @if($user->role_check(['Admin','Guru','Siswa']))
                            <?php $no = $barang->currentPage()*$barang->perPage()-4; ?>
                            @foreach ($barang as $data_barang)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{!! QrCode::size(100)->generate($data_barang->kode_barang); !!}</td>
                                <?php $num_char=50;  ?>
                                <td>{{ $data_barang->nama_barang }}</td>
                                <td>{{ $data_barang->qty_barang }}</td>
                                <td>{{ $data_barang->ruangan_barang }}</td>
                                <td>{{ $data_barang->merk_barang }}</td>
                                <td>{{ $data_barang->warna_barang }}</td>
                                <td>{{ $data_barang->kondisi_barang }}</td>
                                <td>{{ $data_barang->catatan_barang }}</td>
                                @if ($user->role_check(['Admin','Kepala Laboratorium']))
                                <td>
                                    <form action="{{ Route('Barang') }}/{{ $data_barang->id }}/Delete" method="post">
                                        <a href="{{ Route('Barang') }}/{{ $data_barang->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a>  
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $data_barang->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $data_barang->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $data_barang->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $data_barang->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_barang->kode_barang }} </h6>
                                                        <h6>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_barang->nama_barang }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Barang') }}/{{ $data_barang->id }}/Delete" method="post">
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
                            @endif
<!-- ------------------------------------------------------------------------------------------------------------------------------------
------------------------- KALAU USERNYA KEPALA LABORATORIUM YANG DITAMPILIN BARANG DI LAB YANG DIKENDALIKAN ----------------------------- 
------------------------------------------------------------------------------------------------------------------------------------------ -->
                            
                            @if($user->role_check(['Kepala Laboratorium']))
                            <?php $no = $baranglab->currentPage()*$baranglab->perPage()-4; ?>
                            @foreach ($baranglab as $data_barang)
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $data_barang->kode_barang }}</td>
                                <?php $num_char=50;  ?>
                                <td>{{ $data_barang->nama_barang }}</td>
                                <td>{{ $data_barang->qty_barang }}</td>
                                <td>{{ $data_barang->merk_barang }}</td>
                                <td>{{ $data_barang->warna_barang }}</td>
                                <td>{{ $data_barang->kondisi_barang }}</td>
                                <td>{{ $data_barang->catatan_barang }}</td>
                                @if ($user->role_check(['Admin','Kepala Laboratorium']))
                                <td>
                                    <form action="{{ Route('Barang') }}/{{ $data_barang->id }}/Delete" method="post">
                                        <a href="{{ Route('Barang') }}/{{ $data_barang->id }}/Edit" class="btn btn-primary" style="font-size: 12px">Edit</a>  
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $data_barang->id }}">
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $data_barang->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $data_barang->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $data_barang->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_barang->kode_barang }} </h6>
                                                        <h6>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data_barang->nama_barang }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Barang') }}/{{ $data_barang->id }}/Delete" method="post">
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
                            @endif

                        </tbody>
                    </table>
                    {{ $barang->render() }}
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