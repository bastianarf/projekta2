<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use App\Models\Perbaikan;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redirect(Route('Home'));
    }

    public function Barang()
    {
        $user = User::getUser();
        $barang = Barang::orderBy('id', 'desc')->paginate();
        $baranglab = Barang::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate();
        return view ('cetak.barang', compact('user','barang','baranglab'));
    }
    public function Peminjaman($id)
    {
        $user = User::getUser();
        $peminjaman = Peminjaman::orderBy('id', 'desc')->paginate();
        return view ('cetak.peminjaman', compact('user', 'peminjaman'));
    }

    public function Pengajuan($id)
    {
        $user = User::getUser();
        $pengajuan = Pengajuan::orderBy('id', 'desc')->paginate();
        $pengajuanlab = Pengajuan::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate();
        return view ('cetak.pengajuan', compact('user', 'pengajuan', 'pengajuanlab'));
    }

    public function Jadwal($id)
    {
        $user = User::getUser();
        $jadwal = Jadwal::orderBy('id', 'desc')->paginate();
        $jadwallab = Jadwal::orderBy('id', 'desc')->where('ruang_lab',$user->ruang_kalab)->paginate();
        return view ('cetak.jadwal', compact('user', 'jadwal', 'jadwallab'));
    }

    public function Perbaikan($id)
    {
        $user = User::getUser();
        $perbaikanlab = Perbaikan::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate(10);
        $perbaikan = Perbaikan::orderBy('id', 'desc')->paginate();

        return view ('cetak.perbaikan', compact('user', 'perbaikan','perbaikanlab'));
    }
}
