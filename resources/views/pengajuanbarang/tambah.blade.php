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
                <h3 class="text-center">Tambah Data Pengajuan Barang </h3>
                <hr>
                <form method="POST" action="{{ Route('Pengajuan') }}/{{ $user->id }}/Tambah">
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="kode_barang" class="col-sm-4 col-form-label">Kode Barang <div class="text-secondary small">Kode harus Unik</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="kode_barang" placeholder="Ketikkan Kode Barang.." required name="kode_barang" value="{{ old('kode_barang') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang <div class="text-secondary small"></div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="nama_barang" placeholder="Ketikkan Nama Barang.." required name="nama_barang" value="{{ old('nama_barang') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="qty_barang" class="col-sm-4 col-form-label">Qty Barang <div class="text-secondary small">( Gunakan Angka )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="number" class="form-control justify-content" id="qty_barang" placeholder="Ketikkan Qty Barang.." required name="qty_barang" value="{{ old('qty_barang') }}">
                        </div>
                    </div>

                    <!-- MENU TAMBAH RUANG LABORATORIUM KOMPUTER -->
                    @if ($user->role_check(['Admin']))
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruangan_barang" class="col-sm-4 col-form-label">Ruang Laboratorium Barang <div class="text-secondary small">Pilih Ruangan</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="ruangan_barang" name="ruangan_barang" class="form-control form-control-user @error('ruangan_barang') is-invalid @enderror" required placeholder="Pilih Ruang Laboratorium">
                                <option selected disabled>- Pilih Laboratorium Komputer -</option>
                                    <option value="Laboratorium Komputer 1" @if ($user->ruang_kalab =='Laboratorium Komputer 1') selected @endif>Laboratorium Komputer 1</option>
                                    <option value="Laboratorium Komputer 2" @if ($user->ruang_kalab =='Laboratorium Komputer 2') selected @endif>Laboratorium Komputer 2</option>
                                    <option value="Laboratorium Komputer 3" @if ($user->ruang_kalab =='Laboratorium Komputer 3') selected @endif>Laboratorium Komputer 3</option>
                                        </select>
                                        @error('ruangan_barang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>
                    @else
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruangan_barang" class="col-sm-4 col-form-label">Ruang Laboratorium Barang <div class="text-secondary small">Pilih Ruangan</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <input type="text" class="form-control justify-content" readonly id="ruangan_barang" placeholder="Ketikkan Ruangan Barang.." required name="ruangan_barang" value="{{ $user->ruang_kalab }}">
                        </div>
                    </div>
                    @endif

                    <div class="form-group row d-flex align-items-center">
                        <label for="merk_barang" class="col-sm-4 col-form-label">Merk Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="merk_barang" placeholder="Ketikkan Merk Barang.." required name="merk_barang" value="{{ old('merk_barang') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="warna_barang" class="col-sm-4 col-form-label">Warna Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="warna_barang" placeholder="Ketikkan Warna Barang.." required name="warna_barang" value="{{ old('warna_barang') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="hargasatuan_barang" class="col-sm-4 col-form-label">Harga Satuan Barang <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="number" class="form-control justify-content" id="hargasatuan_barang" placeholder="Ketikkan Harga Satuan Barang.." required name="hargasatuan_barang" value="{{ old('hargasatuan_barang') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="tgl_pengajuan" class="col-sm-4 col-form-label">Tanggal Pengajuan <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="date" class="form-control justify-content" id="tgl_pengajuan" placeholder="Pilih Tanggal Pengajuan.." required name="tgl_pengajuan" value="{{ old('tgl_pengajuan') }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="keterangan_barang" class="col-sm-4 col-form-label">Keterangan Barang <div class="text-secondary small">( Opsional )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="keterangan_barang" placeholder="Ketikkan Keterangan Barang.." name="keterangan_barang" value="{{ old('keterangan_barang') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md float-right">Tambah Pengajuan Barang</button>
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