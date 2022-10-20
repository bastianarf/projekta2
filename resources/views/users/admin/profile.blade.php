
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(108, 16, 169)">
        @if ($user->role_check(['Admin']))
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <h3 class="text-center">Data Users</h3>
                <br>
                <div class="form-group row d-flex align-items-center">
                    <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" readonly placeholder=" Nama Lengkap..." name="Nama" value="{{ $user_pegawai->nama_lengkap }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="NISNIP" class="col-sm-3 col-form-label">NIS / NIP </label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control justify-content-center @error('NISNIP') is-invalid @enderror" readonly id="NISNIP" placeholder="NIS / NIP.." name="NISNIP" value="{{ $user_pegawai->nis_nip }}" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Peran" class="col-sm-3 col-form-label">Peran</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Peran') is-invalid @enderror" readonly id="Peran" placeholder=" Peran..." name="Peran" value="{{ $user_pegawai->role }}" >
                    </div>
                </div>
                
                @if ($user->role_check(['Kepala Laboratorium']))
                <div class="form-group row d-flex align-items-center">
                    <label for="Ruangkalab" class="col-sm-3 col-form-label">Ruang Laboratorium</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Ruangkalab') is-invalid @enderror" readonly id="Ruangkalab" placeholder="" name="Ruangkalab" value="{{ $user_pegawai->ruang_kalab }}" >
                    </div>
                </div>
                @endif

                @if ($user->role_check(['Guru']))
                <div class="form-group row d-flex align-items-center">
                    <label for="matpel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('matpel') is-invalid @enderror" readonly id="matpel" placeholder="" name="matpel" value="{{ $user_pegawai->mapel_guru }}" >
                    </div>
                </div>
                @endif

                @if ($user->role_check(['Siswa']))
                <div class="form-group row d-flex align-items-center">
                    <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('kelas') is-invalid @enderror" readonly id="kelas" placeholder="" name="kelas" value="{{ $user_pegawai->kelas }}" >
                    </div>
                </div>
                @endif
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('email') is-invalid @enderror" id="email" readonly placeholder=" Email..." name="email" value="{{ $user_pegawai->email }}">
                    </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="Password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Home/Profile/ChangePassword') }}" class="btn btn-primary" id="Password" placeholder=" Password..." name="Password" readonly> Ganti Password</a>
                    </div>
                </div>
                <hr>
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <a href="{{ Route('Admin/Show') }}" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href=" {{ Route('Admin/Show') }}/{{ $user_pegawai->nip }}/Edit" class="btn btn-primary btn-md">Edit User</a>
                    </div>
                    <div>
                        @if ($user_pegawai->cek == 1)
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Hapus User
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk menghapus ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Nama Lengkap : {{ $user_pegawai->nama_lengkap }} </h6>
                                        <h6>NIS / NIP&nbsp;&nbsp;&nbsp;&nbsp; : {{ $user_pegawai->nis_nip }}</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ Route('Admin/Show') }}/{{ $user_pegawai->nip }}/Delete" method="post">
                                            @method('delete')
                                            @csrf   
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        @else
        @include('layouts.akses')
        @endif
    </div>
</div>
@include('layouts.copyright')
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

