@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<style>
    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
    top: 5px;
    right: 10px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
    }
    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
    color: rgb(107, 107, 107);
    line-height: 20px;
    font-size: 0.8em;
    }

</style>
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
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">Edit Data Peminjaman Barang </h3>
                <hr>
                <form method="POST" action="{{ Route('Peminjaman') }}/{{ $peminjaman->id }}/Edit">
                    @method('patch')
                    @csrf
                    @if($user->role_check(['Admin']))
                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_peminjam" class="col-sm-4 col-form-label">Nama Peminjam </label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="nama_peminjam" name="nama_peminjam" class="form-control form-control-user @error('nama_peminjam') is-invalid @enderror" required placeholder="Pilih Nama Peminjam">
                                <option selected disabled>- Pilih Pengguna -</option>
                                    @foreach ($usera as $data_pengguna)
                                    <option value="{{ $data_pengguna->nama_lengkap }}" @if ($peminjaman->nama_peminjam == $data_pengguna->nama_lengkap) selected @endif> {{ $data_pengguna->nama_lengkap }}</option>
                                    @endforeach   
                                        </select>
                                        @error('nama_peminjam')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>
                    @else
                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_peminjam" class="col-sm-4 col-form-label">Nama Peminjam </label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" readonly id="nama_peminjam" placeholder="Ketikkan Nama Peminjam.." required name="nama_peminjam" value="{{ $user->nama_lengkap }}">
                        </div>
                    </div>
                    @endif

                    <div class="form-group row d-flex align-items-center">
                        <label for="kode_barang" class="col-sm-4 col-form-label">Kode Barang <div class="text-secondary small">Kode harus Unik</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="kode_barang" name="kode_barang" class="form-control form-control-user @error('kode_barang') is-invalid @enderror" required placeholder="Pilih Kode Barang">
                                <option selected disabled>- Pilih Kode dan Nama Barang -</option>
                                    @foreach ($barang as $data_barang)
                                    <option value="{{ $data_barang->kode_barang }}" @if ($peminjaman->kode_barang === $data_barang->kode_barang) selected @endif> {{ $data_barang->kode_barang }} - {{ $data_barang->nama_barang }}</option>
                                    @endforeach   
                                        </select>
                                        @error('kode_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang <div class="text-secondary small"></div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="nama_barang" name="nama_barang" class="form-control form-control-user @error('nama_barang') is-invalid @enderror" required placeholder="Pilih Nama Barang">
                                <option selected disabled>- Pilih Nama Barang -</option>
                                    @foreach ($barang as $data_barang)
                                    <option value="{{ $data_barang->nama_barang }}" @if ($peminjaman->nama_barang === $data_barang->nama_barang) selected @endif> {{ $data_barang->kode_barang }} - {{ $data_barang->nama_barang }}</option>
                                    @endforeach   
                                        </select>
                                        @error('nama_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="qty_barang" class="col-sm-4 col-form-label">Qty Barang <div class="text-secondary small">( Gunakan Angka )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="number" class="form-control justify-content" id="qty_barang" placeholder="Ketikkan Qty Barang.." required name="qty_barang" value="{{ $peminjaman->qty_barang }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="merk_barang" class="col-sm-4 col-form-label">Merk Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="merk_barang" name="merk_barang" class="form-control form-control-user @error('nama_barang') is-invalid @enderror" required placeholder="Pilih Merk Barang">
                                <option selected disabled>- Pilih Merk Barang -</option>
                                    @foreach ($barang as $data_barang)
                                    <option value="{{ $data_barang->merk_barang }}" @if ($peminjaman->merk_barang === $data_barang->merk_barang) selected @endif> {{ $data_barang->nama_barang }} - {{ $data_barang->merk_barang }}</option>
                                    @endforeach   
                                        </select>
                                        @error('merk_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="warna_barang" class="col-sm-4 col-form-label">Warna Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="warna_barang" name="warna_barang" class="form-control form-control-user @error('warna_barang') is-invalid @enderror" required placeholder="Pilih Warna Barang">
                                <option selected disabled>- Pilih Warna Barang -</option>
                                    @foreach ($barang as $data_barang)
                                    <option value="{{ $data_barang->warna_barang }}" @if ($peminjaman->warna_barang === $data_barang->warna_barang) selected @endif> {{ $data_barang->nama_barang }} - {{ $data_barang->warna_barang }} - {{ $data_barang->merk_barang }}</option>
                                    @endforeach   
                                        </select>
                                        @error('warna_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="ruangan_barang" class="col-sm-4 col-form-label">Ruang Laboratorium Barang <div class="text-secondary small">Pilih Ruangan</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="ruangan_barang" name="ruangan_barang" class="form-control form-control-user @error('ruangan_barang') is-invalid @enderror" required placeholder="Pilih Ruang Laboratorium">
                                <option selected disabled>- Pilih Laboratorium Komputer -</option>
                                    @foreach ($barang as $data_barang)
                                    <option value="{{ $data_barang->ruangan_barang }}" @if ($peminjaman->ruangan_barang === $data_barang->ruangan_barang) selected @endif>{{ $data_barang->nama_barang }} - {{ $data_barang->ruangan_barang }}</option>
                                    @endforeach 
                                        </select>
                                        @error('ruangan_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="tgl_pinjam" class="col-sm-4 col-form-label">Tanggal Peminjaman Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="date" class="form-control justify-content" id="tgl_pinjam" placeholder="Masukkan Tanggal Peminjaman Barang.." required name="tgl_pinjam" value="{{ $peminjaman->tgl_pinjam }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="tgl_kembali" class="col-sm-4 col-form-label">Tanggal Pengembalian Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="date" class="form-control justify-content" id="tgl_kembali" placeholder="Masukkan Tanggal Pengembalian Barang.." required name="tgl_kembali" value="{{ $peminjaman->tgl_kembali }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="keterangan" class="col-sm-4 col-form-label">Keterangan <div class="text-secondary small">( Opsional )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="keterangan" placeholder="Ketikkan Keterangan Barang.." name="keterangan" value="{{ $peminjaman->keterangan }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md float-right">Selesai</button>
                </form>
                <br>
                <br>
                <hr>
            </div>
        </div>
    </div>
</div>
@include('layouts.copyright')
@endsection


@section('script-down')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nama').select2();
        $('#TBerangkat').select2();
        $('#TTujuan').select2();
    });
</script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection