
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
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
                <h3 class="text-center">Membuat User</h3>
                <br>
                <form method="POST" action="{{ Route('Admin/CreateUser') }}">
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Ketik Nama Lengkap..." name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="nis_nip" class="col-sm-3 col-form-label">NIS / NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8 ">
                            <input type="text" class="form-control justify-content-center @error('nis_nip') is-invalid @enderror" id="nis_nip" placeholder="Ketik NIP..." name="nis_nip" value="{{ old('nis_nip') }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="role" class="col-sm-3 col-form-label">Peran<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <select class="custom-select @error('Role') is-invalid @enderror" id="role" name="role">
                                <option selected disabled>Pilih Peran..</option>
                                <option value="Admin">Admin</option>
                                <option value="Kepala Laboratorium">Kepala Laboratorium</option>
                                <option value="Guru">Guru</option>
                                <option value="Siswa">Siswa</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruangkalab" class="col-sm-3 col-form-label">Ruang Laboratorium<div class="small">Khusus Peran Kepala Laboratorium</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="ruangkalab" name="ruangkalab" class="form-control form-control-user @error('ruangkalab') is-invalid @enderror" required placeholder="Pilih Ruang Laboratorium">
                                <option disabled selected>- Pilih Laboratorium Komputer -</option>
                                    <option value="Laboratorium Komputer 1">Laboratorium Komputer 1</option>
                                    <option value="Laboratorium Komputer 2">Laboratorium Komputer 2</option>
                                    <option value="Laboratorium Komputer 3">Laboratorium Komputer 3</option>
                                        </select>
                                        @error('ruangkalab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran <div class="small">Khusus Peran Guru</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="mapel" name="mapel" class="form-control form-control-user @error('mapel') is-invalid @enderror" required placeholder=" Pilih Mata Pelajaran..">
                                <option disabled selected>- Pilih Mata Pelajaran -</option>
                                    <option value="Prakarya dan Kewirausahaan">Prakarya dan Kewirausahaan</option>
                                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                                    <option value="Pendidikan Kewarganegaraan">Pendidikan Kewarganegaraan</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="TIK">TIK</option>
                                    <option value="Penjasorkes">Penjasorkes</option>
                                        </select>
                                        @error('mapel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="kelas" class="col-sm-3 col-form-label">Kelas <div class="small">Khusus Peran Siswa</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="kelas" name="kelas" class="form-control form-control-user @error('kelas') is-invalid @enderror" required placeholder=" Pilih Kelas..">
                                <option disabled selected>- Pilih Kelas -</option>
                                    <option value="7A">7A</option>
                                    <option value="7B">7B</option>
                                    <option value="7C">7C</option>
                                    <option value="7D">7D</option>
                                    <option value="7E">7E</option>
                                    <option value="8A">8A</option>
                                    <option value="8B">8B</option>
                                    <option value="8C">8C</option>
                                    <option value="8D">8D</option>
                                    <option value="8E">8E</option>
                                    <option value="9A">9A</option>
                                    <option value="9B">9B</option>
                                    <option value="9C">9C</option>
                                    <option value="9D">9D</option>
                                    <option value="9E">9E</option>
                                    <option value="9F">9F</option>
                                        </select>
                                        @error('kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="email" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('email') is-invalid @enderror" id="email" placeholder="Ketik Email..." name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="password" class="col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control justify-content-center @error('Password') is-invalid @enderror" id="password" placeholder="Ketik Password..." name="password" data-toggle="password">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label><span class="text-danger col-sm-3 col-form-label">*</span>Harus di isi.</label>
                    </div>
                    <div class="form-group text-left">
                        <a href="{{ Route('Home') }}" class="btn btn-danger btn-md">Batal</a>
                        <button type="submit" class="btn btn-primary btn-md">Buat User</button>
                    </div>
                </form>
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

