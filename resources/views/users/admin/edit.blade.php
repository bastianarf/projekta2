
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
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" >
                <h3 class="text-center">Edit Users</h3>
                <br>
                <form method="POST" action="{{ Route('Admin/Show') }}/{{ $user_pegawai->nis_nip }}/Edit">
                    @method('patch')
                    @csrf

                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control justify-content-center @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Ketik Nama Lengkap..." name="nama_lengkap" value="{{ $user_pegawai->nama_lengkap }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="nis_nip" class="col-sm-3 col-form-label">NIS / NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8 ">
                            <input type="number" class="form-control justify-content-center @error('nis_nip') is-invalid @enderror" id="nis_nip" placeholder="Ketik NIS / NIP..." name="nis_nip" value="{{ $user_pegawai->nis_nip }}">
                        </div>
                    </div>                    
                   
                    <div class="form-group row d-flex align-items-center">
                        <label for="role" class="col-sm-3 col-form-label">Peran</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="role" name="role" class="form-control form-control-user @error('role') is-invalid @enderror" required placeholder="Pilih Peran">
                                <option disabled selected> - Pilih Peran - </option>
                                    <option value="Admin" @if ($user_pegawai->role =='Admin') selected @endif>Admin</option>
                                    <option value="Kepala Laboratorium" @if ($user_pegawai->role =='Kepala Laboratorium') selected @endif>Kepala Laboratorium</option>
                                    <option value="Guru" @if ($user_pegawai->role =='Guru') selected @endif>Guru</option>
                                    <option value="Siswa" @if ($user_pegawai->role =='Siswa') selected @endif>Siswa</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruangkalab" class="col-sm-3 col-form-label">Ruang Laboratorium</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="ruangkalab" name="ruangkalab" class="form-control form-control-user @error('ruangkalab') is-invalid @enderror" required placeholder="Pilih Ruang Laboratorium">
                                <option disabled selected> - Pilih Laboratorium - </option>
                                    <option value="Laboratorium Komputer 1" @if ($user_pegawai->ruang_kalab =='Laboratorium Komputer 1') selected @endif>Laboratorium Komputer 1</option>
                                    <option value="Laboratorium Komputer 2" @if ($user_pegawai->ruang_kalab =='Laboratorium Komputer 2') selected @endif>Laboratorium Komputer 2</option>
                                    <option value="Laboratorium Komputer 3" @if ($user_pegawai->ruang_kalab =='Laboratorium Komputer 3') selected @endif>Laboratorium Komputer 3</option>
                                        </select>
                                        @error('ruangkalab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="mapel" name="mapel" class="form-control form-control-user @error('mapel') is-invalid @enderror" required placeholder=" Pilih Mata Pelajaran..">
                                <option disabled selected>- Pilih Mata Pelajaran -</option>
                                    <option value="Prakarya dan Kewirausahaan" @if ($user_pegawai->mapel_guru =='Prakarya dan Kewirausahaan') selected @endif>Prakarya dan Kewirausahaan</option>
                                    <option value="Bahasa Indonesia" @if ($user_pegawai->mapel_guru =='Bahasa Indonesia') selected @endif>Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris" @if ($user_pegawai->mapel_guru =='Bahasa Inggris') selected @endif>Bahasa Inggris</option>
                                    <option value="Pendidikan Agama Islam" @if ($user_pegawai->mapel_guru =='Pendidikan Agama Islam') selected @endif>Pendidikan Agama Islam</option>
                                    <option value="Pendidikan Kewarganegaraan" @if ($user_pegawai->mapel_guru =='Pendidikan Kewarganegaraan') selected @endif>Pendidikan Kewarganegaraan</option>
                                    <option value="Matematika" @if ($user_pegawai->mapel_guru =='Matematika') selected @endif>Matematika</option>
                                    <option value="IPA" @if ($user_pegawai->mapel_guru =='IPA') selected @endif>IPA</option>
                                    <option value="IPS" @if ($user_pegawai->mapel_guru =='IPS') selected @endif>IPS</option>
                                    <option value="TIK" @if ($user_pegawai->mapel_guru =='TIK') selected @endif>TIK</option>
                                    <option value="Penjasorkes" @if ($user_pegawai->mapel_guru =='Penjasorkes') selected @endif>Penjasorkes</option>
                                        </select>
                                        @error('mapel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-8">
                        <select id="kelas" name="kelas" class="form-control form-control-user @error('kelas') is-invalid @enderror" required placeholder=" Pilih Kelas..">
                                <option disabled selected>- Pilih Kelas -</option>
                                    <option value="7A" @if ($user->kelas =='7A') selected @endif>7A</option>
                                    <option value="7B" @if ($user->kelas =='7B') selected @endif>7B</option>
                                    <option value="7C" @if ($user->kelas =='7C') selected @endif>7C</option>
                                    <option value="7D" @if ($user->kelas =='7D') selected @endif>7D</option>
                                    <option value="7E" @if ($user->kelas =='7E') selected @endif>7E</option>
                                    <option value="8A" @if ($user->kelas =='8A') selected @endif>8A</option>
                                    <option value="8B" @if ($user->kelas =='8B') selected @endif>8B</option>
                                    <option value="8C" @if ($user->kelas =='8C') selected @endif>8C</option>
                                    <option value="8D" @if ($user->kelas =='8D') selected @endif>8D</option>
                                    <option value="8E" @if ($user->kelas =='8E') selected @endif>8E</option>
                                    <option value="9A" @if ($user->kelas =='9A') selected @endif>9A</option>
                                    <option value="9B" @if ($user->kelas =='9B') selected @endif>9B</option>
                                    <option value="9C" @if ($user->kelas =='9C') selected @endif>9C</option>
                                    <option value="9D" @if ($user->kelas =='9D') selected @endif>9D</option>
                                    <option value="9E" @if ($user->kelas =='9E') selected @endif>9E</option>
                                    <option value="9F" @if ($user->kelas =='9F') selected @endif>9F</option>
                                        </select>
                                        @error('kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group text-left">
                        <a href="{{ Route('Admin/Show') }}/{{ $user_pegawai->nis_nip }}" class="btn btn-danger btn-md">Batal</a>
                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
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

