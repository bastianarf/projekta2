@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')

    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0"
        style="background-color: rgb(108, 16, 169)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')

            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Login'))
                <img src="{{ asset('img/logosmp4.png') }}" class="rounded mx-auto d-block img-fluid figure-img"
                    alt="Logo SMP Negeri 4 Ponorogo" width="20%">
                <figcaption class=" text-center">SMP Negeri 4 Ponorogo</figcaption>
                <h2 class="text-center">{{ session()->get('Login')  }} {{ $user->nama_lengkap }}</h2>
                <br>
                @endif
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif

                <!-- DASBOR UNTUK ROLE ADMIN -->
                @if ($user->role_check(['Admin']))
                <div iv class="row">
                <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-archive"></i> &nbsp;Data Barang</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Barang Labkom 1 </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $baranglab1->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Barang Labkom 2 </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $baranglab2->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Barang Labkom 3 </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $baranglab3->count() }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Barang</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $barang->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                        
                <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-users"></i> &nbsp;Data Users</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Admin</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $useradmin->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Kepala Lab</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $userkalab->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Guru</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $userguru->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Siswa</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $usersiswa->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                </div>

                <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-tasks"></i> &nbsp;Data Inventaris Barang</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Perbaikan</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $perbaikan->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Pengajuan</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $pengajuan->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Peminjaman</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $peminjaman->count() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Jadwal</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $jadwal->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            <!-- DASBOR UNTUK ROLE KEPALA LABORATORIUM -->
            @if ($user->role_check(['Kepala Laboratorium']) && $user->ruangkalab_check(['Laboratorium Komputer 1','Laboratorium Komputer 2', 'Laboratorium Komputer 3']))
            <div iv class="row">
                <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-archive"></i> &nbsp;Data Barang {{ $user->ruang_kalab }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Barang</div>
                                    <div class="col-sm-1">:</div>
                                    @if ($user->ruangkalab_check(['Laboratorium Komputer 1']))
                                    <div class="col-sm-5 text-left">{{ $baranglab1->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 2']))
                                    <div class="col-sm-5 text-left">{{ $baranglab2->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 3']))
                                    <div class="col-sm-5 text-left">{{ $baranglab3->count() }}</div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-tasks"></i> &nbsp;Data Peminjaman {{ $user->ruang_kalab }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Peminjaman</div>
                                    <div class="col-sm-1">:</div>
                                    @if ($user->ruangkalab_check(['Laboratorium Komputer 1']))
                                    <div class="col-sm-5 text-left">{{ $peminjamanlab1->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 2']))
                                    <div class="col-sm-5 text-left">{{ $peminjamanlab2->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 3']))
                                    <div class="col-sm-5 text-left">{{ $peminjamanlab3->count() }}</div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-tasks"></i> &nbsp;Data Perbaikan {{ $user->ruang_kalab }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Perbaikan</div>
                                    <div class="col-sm-1">:</div>
                                    @if ($user->ruangkalab_check(['Laboratorium Komputer 1']))
                                    <div class="col-sm-5 text-left">{{ $perbaikanlab1->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 2']))
                                    <div class="col-sm-5 text-left">{{ $perbaikanlab2->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 3']))
                                    <div class="col-sm-5 text-left">{{ $perbaikanlab3->count() }}</div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-tasks"></i> &nbsp;Data Pengajuan {{ $user->ruang_kalab }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Pengajuan</div>
                                    <div class="col-sm-1">:</div>
                                    @if ($user->ruangkalab_check(['Laboratorium Komputer 1']))
                                    <div class="col-sm-5 text-left">{{ $pengajuanlab1->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 2']))
                                    <div class="col-sm-5 text-left">{{ $pengajuanlab2->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 3']))
                                    <div class="col-sm-5 text-left">{{ $pengajuanlab3->count() }}</div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div> 

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-calendar"></i> &nbsp;Data Jadwal {{ $user->ruang_kalab }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Jadwal yang Terdaftar</div>
                                    <div class="col-sm-1">:</div>
                                    @if ($user->ruangkalab_check(['Laboratorium Komputer 1']))
                                    <div class="col-sm-5 text-left">{{ $jadwallab1->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 2']))
                                    <div class="col-sm-5 text-left">{{ $jadwallab2->count() }}</div>
                                    @endif
                                    @if($user->ruangkalab_check(['Laboratorium Komputer 3']))
                                    <div class="col-sm-5 text-left">{{ $jadwallab3->count() }}</div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
            </div>
            @endif

            <!-- DASBOR UNTUK ROLE GURU -->
            @if ($user->role_check(['Guru']) && $user->mapel_check(['Prakarya dan Kewirausahaan','Bahasa Indonesia','Bahasa Inggris','Pendidikan Agama Islam','Pendidikan Kewarganegaraan','Matematika','IPA','IPS','TIK','Penjasorkes']))
            <div iv class="row">
            <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-calendar"></i> &nbsp;Data Jadwal {{ $user->nama_lengkap }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Jadwal</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $jadwalguru->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
            <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-users"></i> &nbsp;Data {{ $user->role }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total {{ $user->role }}</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $userguru->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- DASBOR UNTUK ROLE SISWA -->
            @if ($user->role_check(['Siswa']) && $user->kelas_check(['7A','7B','7C','7D','7E','8A','8B','8C','8D','8E','9A','9B','9C','9D','9E','9F']))
            <div iv class="row">
            <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-calendar"></i> &nbsp;Data Jadwal {{ $user->nama_lengkap }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Jadwal Kelas {{ $user->kelas }}</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $jadwalsiswa->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
            <br>
            <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-users"></i> &nbsp;Data {{ $user->role }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total {{ $user->role }}</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $usersiswa->count() }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                </div>
            </div>
        </div>
@include('layouts.copyright')
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection
