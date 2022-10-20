
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
                <h3 class="text-center">Profile</h3>
                <br>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" readonly placeholder=" Nama Lengkap..." name="Nama" value="{{ $user->nama_lengkap }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="NISNIP" class="col-sm-3 col-form-label">NIS / NIP </label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8 ">
                        <input type="number" class="form-control justify-content-center @error('NISNIP') is-invalid @enderror" readonly id="NISNIP" placeholder="NIS / NIP.." name="NISNIP" value="{{ $user->nis_nip }}" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Peran" class="col-sm-3 col-form-label">Peran</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Peran') is-invalid @enderror" readonly id="Peran" placeholder=" Peran..." name="Peran" value="{{ $user->role }}" >
                    </div>
                </div>
                
                @if ($user->role_check(['Kepala Laboratorium']))
                <div class="form-group row d-flex align-items-center">
                    <label for="Ruangkalab" class="col-sm-3 col-form-label">Ruang Laboratorium</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Ruangkalab') is-invalid @enderror" readonly id="Ruangkalab" placeholder="" name="Ruangkalab" value="{{ $user->ruang_kalab }}" >
                    </div>
                </div>
                @endif

                @if ($user->role_check(['Guru']))
                <div class="form-group row d-flex align-items-center">
                    <label for="matpel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('matpel') is-invalid @enderror" readonly id="matpel" placeholder="" name="matpel" value="{{ $user->mapel_guru }}" >
                    </div>
                </div>
                @endif

                @if ($user->role_check(['Siswa']))
                <div class="form-group row d-flex align-items-center">
                    <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('kelas') is-invalid @enderror" readonly id="kelas" placeholder="" name="kelas" value="{{ $user->kelas }}" >
                    </div>
                </div>
                @endif
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('email') is-invalid @enderror" id="email" readonly placeholder=" Email..." name="email" value="{{ $user->email }}">
                    </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="Password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Home/Profile/ChangePassword') }}" class="btn btn-primary" id="Password" placeholder=" Password..." name="Password" readonly> Ganti Password</a>
                    </div>
                </div>
                
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <a href="{{ Route('Home') }}" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href=" {{ Route('Home/Profile/Edit') }} " class="btn btn-primary btn-md">Edit User</a>
                    </div>
                    <div>
                        @if (Auth::user()->cek == 1)
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
                                        <h6>Nama Lengkap : {{ $user->nama_lengkap }} </h6>
                                        <h6>NIS / NIP&nbsp;&nbsp;&nbsp;&nbsp; : {{ $user->nis_nip }}</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="/Home/Profile/Delete" method="post">
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
    </div>
</div>
@include('layouts.copyright')
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

