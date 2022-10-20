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
                <h3 class="text-center">Edit Data Jadwal </h3>
                <hr>
                <form method="POST" action="{{ Route('Jadwal') }}/{{ $jadwal->id }}/Edit">
                    @method('patch')
                    @csrf

                    <!-- MENU TAMBAH RUANG LABORATORIUM KOMPUTER -->
                    @if ($user->role_check(['Admin','Guru']))
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruang_lab" class="col-sm-4 col-form-label">Ruang Laboratorium Komputer <div class="text-secondary small">Pilih Ruangan</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="ruang_lab" name="ruang_lab" class="form-control form-control-user @error('ruang_lab') is-invalid @enderror" required placeholder="Pilih Ruang Laboratorium">
                                <option selected disabled>- Pilih Laboratorium Komputer -</option>
                                    <option value="Laboratorium Komputer 1" @if ($jadwal->ruang_lab =='Laboratorium Komputer 1') selected @endif>Laboratorium Komputer 1</option>
                                    <option value="Laboratorium Komputer 2" @if ($jadwal->ruang_lab =='Laboratorium Komputer 2') selected @endif>Laboratorium Komputer 2</option>
                                    <option value="Laboratorium Komputer 3" @if ($jadwal->ruang_lab =='Laboratorium Komputer 3') selected @endif>Laboratorium Komputer 3</option>
                                        </select>
                                        @error('ruang_lab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>
                    @else
                    <div class="form-group row d-flex align-items-center">
                        <label for="ruang_lab" class="col-sm-4 col-form-label">Ruang Laboratorium Komputer <div class="text-secondary small">Pilih Ruangan</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <input type="text" class="form-control justify-content" readonly id="ruang_lab" placeholder="Ketik Ruang Laboratorium.." required name="ruang_lab" value="{{ $user->ruang_kalab }}">
                        </div>
                    </div>
                    @endif
                    
                    <div class="form-group row d-flex align-items-center">
                        <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        <select id="kelas" name="kelas" class="form-control form-control-user @error('kelas') is-invalid @enderror" required placeholder=" Pilih Kelas..">
                                <option disabled selected>- Pilih Kelas -</option>
                                    <option value="7A" @if ($jadwal->kelas =='7A') selected @endif>7A</option>
                                    <option value="7B" @if ($jadwal->kelas =='7B') selected @endif>7B</option>
                                    <option value="7C" @if ($jadwal->kelas =='7C') selected @endif>7C</option>
                                    <option value="7D" @if ($jadwal->kelas =='7D') selected @endif>7D</option>
                                    <option value="7E" @if ($jadwal->kelas =='7E') selected @endif>7E</option>
                                    <option value="8A" @if ($jadwal->kelas =='8A') selected @endif>8A</option>
                                    <option value="8B" @if ($jadwal->kelas =='8B') selected @endif>8B</option>
                                    <option value="8C" @if ($jadwal->kelas =='8C') selected @endif>8C</option>
                                    <option value="8D" @if ($jadwal->kelas =='8D') selected @endif>8D</option>
                                    <option value="8E" @if ($jadwal->kelas =='8E') selected @endif>8E</option>
                                    <option value="9A" @if ($jadwal->kelas =='9A') selected @endif>9A</option>
                                    <option value="9B" @if ($jadwal->kelas =='9B') selected @endif>9B</option>
                                    <option value="9C" @if ($jadwal->kelas =='9C') selected @endif>9C</option>
                                    <option value="9D" @if ($jadwal->kelas =='9D') selected @endif>9D</option>
                                    <option value="9E" @if ($jadwal->kelas =='9E') selected @endif>9E</option>
                                    <option value="9F" @if ($jadwal->kelas =='9F') selected @endif>9F</option>
                                        </select>
                                        @error('kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="tgl_penggunaan" class="col-sm-4 col-form-label">Tanggal Penggunaan <div class="text-secondary small">( Wajib Diisi )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="date" class="form-control justify-content" id="tgl_penggunaan" placeholder="Pilih Tanggal Penggunaan.." required name="tgl_penggunaan" value="{{ $jadwal->tgl_penggunaan }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="waktu_penggunaan_mulai" class="col-sm-4 col-form-label">Waktu Mulai <div class="text-secondary small">( Wajib Diisi )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="time" class="form-control justify-content" id="waktu_penggunaan_mulai" placeholder="Pilih Waktu Mulai.." required name="waktu_penggunaan_mulai" value="{{ $jadwal->waktu_penggunaan_mulai }}">
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="waktu_penggunaan_akhir" class="col-sm-4 col-form-label">Waktu Selesai <div class="text-secondary small">( Wajib Diisi )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="time" class="form-control justify-content" id="waktu_penggunaan_akhir" placeholder="Pilih Waktu Selesai.." required name="waktu_penggunaan_akhir" value="{{ $jadwal->waktu_penggunaan_akhir }}">
                        </div>
                    </div>
                    
                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_matpel" class="col-sm-4 col-form-label">Nama Pelajaran <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        @if ($user->role_check(['Admin','Kepala Laboratorium']))
                        <select id="nama_matpel" name="nama_matpel" class="form-control form-control-user @error('nama_matpel') is-invalid @enderror" required placeholder=" Pilih Mata Pelajaran..">
                                <option disabled selected>- Pilih Mata Pelajaran -</option>
                                    <option value="Prakarya dan Kewirausahaan" @if ($jadwal->nama_matpel =='Prakarya dan Kewirausahaan') selected @endif>Prakarya dan Kewirausahaan</option>
                                    <option value="Bahasa Indonesia" @if ($jadwal->nama_matpel =='Bahasa Indonesia') selected @endif>Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris" @if ($jadwal->nama_matpel =='Bahasa Inggris') selected @endif>Bahasa Inggris</option>
                                    <option value="Pendidikan Agama Islam" @if ($jadwal->nama_matpel =='Pendidikan Agama Islam') selected @endif>Pendidikan Agama Islam</option>
                                    <option value="Pendidikan Kewarganegaraan" @if ($jadwal->nama_matpel =='Pendidikan Kewarganegaraan') selected @endif>Pendidikan Kewarganegaraan</option>
                                    <option value="Matematika" @if ($jadwal->nama_matpel =='Matematika') selected @endif>Matematika</option>
                                    <option value="IPA" @if ($jadwal->nama_matpel =='IPA') selected @endif>IPA</option>
                                    <option value="IPS" @if ($jadwal->nama_matpel =='IPS') selected @endif>IPS</option>
                                    <option value="TIK" @if ($jadwal->nama_matpel =='TIK') selected @endif>TIK</option>
                                    <option value="Penjasorkes" @if ($jadwal->nama_matpel =='Penjasorkes') selected @endif>Penjasorkes</option>
                                        </select>
                                        @error('nama_matpel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                        @else
                        <input type="text" class="form-control justify-content" readonly id="nama_matpel" placeholder="Ketik Nama Matpel.." required name="nama_matpel" value="{{ $user->mapel_guru }}">
                        @endif
                        </div>
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="nama_guru" class="col-sm-4 col-form-label">Nama Guru <div class="text-secondary small">Wajib Diisi</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                        @if ($user->role_check(['Admin','Kepala Laboratorium']))
                        <select id="nama_guru" name="nama_guru" class="form-control form-control-user @error('nama_guru') is-invalid @enderror" required placeholder="Pilih Guru">
                                <option selected disabled>- Pilih Guru -</option>
                                @foreach ($usera as $data_pengguna)
                                <option value="{{ $data_pengguna->nama_lengkap }}" @if($data_pengguna->nama_lengkap == $jadwal->nama_guru) selected @endif> {{ $data_pengguna->nama_lengkap }}</option>
                                @endforeach
                                </select>
                                        @error('nama_guru')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                        @enderror
                                    

                                    @else
                                    <input type="text" class="form-control justify-content" readonly id="nama_guru" placeholder="Ketik Nama Guru.." required name="nama_guru" value="{{ $user->nama_lengkap }}">
                                    @endif
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