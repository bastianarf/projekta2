@extends('layouts.app')

@section('title', $path)
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        border-radius: 25px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h2 text-gray-900 mb-4">Daftar</h1>
                                </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" autofocus>

                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nis_nip" class="col-md-4 col-form-label text-md-right">{{ __('NIS/NIP') }}</label>

                            <div class="col-md-6">
                                <input id="nis_nip" type="text" class="form-control @error('nis_nip') is-invalid @enderror" name="nis_nip" value="{{ old('nis_nip') }}" required autocomplete="nis_nip">

                                @error('nis_nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Peran" class="col-md-4 col-form-label text-md-right">{{ __('Peran') }}</label>
                        <div class="col-md-6">
                            <select id="role" name="role" class="form-control form-control-user @error('role') is-invalid @enderror" required placeholder="Pilih Role">
                                <option disabled selected>- Pilih Peran -</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Kepala Laboratorium">Kepala Laboratorium</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Siswa">Siswa</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                                    </div>
                         </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#role').select2();
                                        });
                                    </script>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-user btn-block"
                                        style="font-size:20px; padding-top:8px; padding-bottom:8px"> {{ __('Daftar') }}
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
