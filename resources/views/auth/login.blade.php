@extends('layouts.app')

@section('title', $path)
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        border-radius: 25px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h2 text-gray-900 mb-4">Masuk</h1>
                                </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-user btn-block"
                                        style="font-size:20px; padding-top:8px; padding-bottom:8px"> {{ __('Login') }}
                                    </button>
                            </div>
                        </div>
                        </form>
                        <hr>
                        <div class="text-center">
                                <a class="small btn btn-primary btn-user"
                                    href="javascript:alert('Silahkan Hubungi Admin');"
                                    style="border-radius:20px; padding: 5px 20px;">Lupa Password?</a>
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
