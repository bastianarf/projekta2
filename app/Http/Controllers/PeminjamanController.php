<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::getUser();
       // $peminjamanlab = Peminjaman::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate(10);
      //  $peminjamanguru = Peminjaman::orderBy('id', 'desc')->where('users_id', $user->id)->paginate(10);
      //  $peminjamansiswa = Peminjaman::orderBy('id', 'desc')->where('users_id', $user->id)->paginate(10);
        if ($request->search) {
            if ($request->search >= 1) {
                $peminjaman = Peminjaman::orderBy('id', 'desc')->where('kode_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            } else {
                $peminjaman = Peminjaman::orderBy('id', 'desc')->where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            }
        } else {
            $peminjaman = Peminjaman::orderBy('id', 'desc')->paginate(10);
        }
        return view('peminjamanbarang.peminjaman', compact('user', 'peminjaman'));
    }

    public function tambah(Request $id)
    {
        $user = User::getUser();
        $usera = User::orderBy('id', 'desc')->paginate();
        $barang = Barang::orderBy('id','desc')->paginate(10);
        $baranglab = Barang::orderBy('id','desc')->where('users_id',$id->id)->paginate(10);
        $peminjaman = Peminjaman::select('*')->where('users_id',$id->id)->first();
        return view('peminjamanbarang.tambah', compact('user', 'usera', 'peminjaman', 'barang', 'baranglab'));
    }

    public function storetambah(Request $request)
    {
        $user = User::getUser();
        $validation = $this->validate($request, [
            'kode_barang'       => 'required',
            'nama_barang'       => 'required',
            'qty_barang'        => 'required',
            'ruangan_barang'    => 'required',
            'merk_barang'       => 'required',
            'warna_barang'      => 'required',
            'tgl_pinjam'        => 'required',
            'tgl_kembali'       => 'required'
        ]);
        if($validation){
            Peminjaman::create([
                'users_id'             => $user->id,
                'nama_peminjam'        => $request->nama_peminjam,
                'kode_barang'          => $request->kode_barang,
                'nama_barang'          => $request->nama_barang,
                'qty_barang'           => $request->qty_barang,
                'ruangan_barang'       => $request->ruangan_barang,
                'merk_barang'          => $request->merk_barang,
                'warna_barang'         => $request->warna_barang,
                'tgl_pinjam'           => $request->tgl_pinjam,
                'tgl_kembali'          => $request->tgl_kembali,
                'keterangan'           => $request->keterangan,
                'created_at'           => now()
            ]);
            session()->flash('Success', 'Berhasil Menambah Data Peminjaman Barang');
            return Redirect(Route('Peminjaman')); 
        }
        else{
            session()->flash('Failed', 'Gagal Menambah Data Peminjaman Barang');
            return Redirect(Route('Peminjaman')); 
        }
    }

    public function editpeminjaman($peminjamans)
    {
        $peminjaman = Peminjaman::select('*')->where('id',$peminjamans)->first();
        $user = User::getUser();
        $usera = User::orderBy('id', 'desc')->paginate(10);
        $barang = Barang::orderBy('id','desc')->paginate(10);
        return view ('peminjamanbarang.editpeminjaman', compact('peminjaman', 'user', 'usera', 'barang')); 
    }

    public function storeeditpeminjaman(request $request, $peminjamans)
    {
        $user = User::getUser();
        $usera = User::orderBy('id', 'desc')->paginate(10);
        $peminjaman = Peminjaman::select('*')->where('id',$peminjamans)->first();
        $validation = $this->validate($request, [
            'kode_barang'       => 'required',
            'nama_barang'       => 'required',
            'qty_barang'        => 'required',
            'ruangan_barang'    => 'required',
            'merk_barang'       => 'required',
            'warna_barang'      => 'required',
            'tgl_pinjam'        => 'required',
            'tgl_kembali'       => 'required'

        ]);
        if($validation){
            $peminjaman->update([
                'users_id'             => $user->id,
                'nama_peminjam'        => $request->nama_peminjam,
                'kode_barang'          => $request->kode_barang,
                'nama_barang'          => $request->nama_barang,
                'qty_barang'           => $request->qty_barang,
                'ruangan_barang'       => $request->ruangan_barang,
                'merk_barang'          => $request->merk_barang,
                'warna_barang'         => $request->warna_barang,
                'tgl_pinjam'           => $request->tgl_pinjam,
                'tgl_kembali'          => $request->tgl_kembali,
                'keterangan'           => $request->keterangan,
                'updated_at'           => now()
            ]);
            session()->flash('Success', 'Berhasil Edit Peminjaman Barang');
            return Redirect(Route('Peminjaman')); 
        }
        else{
            session()->flash('Failed', 'Gagal Edit Peminjaman Barang');
            return Redirect(Route('Peminjaman').'/'.$peminjaman->id.'/Edit'); 
        }
        
    }
    public function deletepeminjaman($id)
    {
        $peminjaman = Peminjaman::select('*')->where('id',$id)->first();
        Peminjaman::destroy($peminjaman); 
        session()->flash('Success', 'Berhasil Menghapus Peminjaman Barang');
        return Redirect(Route('Peminjaman'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
    }
}
