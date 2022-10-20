<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::getUser();
        $pengajuanlab = Pengajuan::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate(10);
        if ($request->search) {
            if ($request->search >= 1) {
                $pengajuan = Pengajuan::orderBy('id', 'desc')->where('kode_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            } else {
                $pengajuan = Pengajuan::orderBy('id', 'desc')->where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            }
        } else {
            $pengajuan = Pengajuan::orderBy('id', 'desc')->paginate(10);
        }
        return view('pengajuanbarang.pengajuan', compact('user', 'pengajuan','pengajuanlab'));
    }

    public function tambah(Request $id)
    {
        $user = User::getUser();
        $usera = User::getUser($id->id)->first();
        $barang = Barang::orderBy('id','desc')->paginate(10);
        $baranglab = Barang::orderBy('id','desc')->where('users_id',$id->id)->paginate(10);
        $pengajuan = Pengajuan::select('*')->where('users_id',$id->id)->first();
        $pengajuanid = Pengajuan::select('*')->where('id',$id->id)->first();
        return view('pengajuanbarang.tambah', compact('user', 'usera', 'pengajuan', 'barang', 'baranglab'));
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
            'hargasatuan_barang'=> 'required',
            'tgl_pengajuan'     => 'required'
        ]);
        if($validation){
            Pengajuan::create([
                'users_id'             => $user->id,
                'kode_barang'          => $request->kode_barang,
                'nama_barang'          => $request->nama_barang,
                'qty_barang'           => $request->qty_barang,
                'ruangan_barang'       => $request->ruangan_barang,
                'merk_barang'          => $request->merk_barang,
                'warna_barang'         => $request->warna_barang,
                'hargasatuan_barang'   => $request->hargasatuan_barang,
                'tgl_pengajuan'        => $request->tgl_pengajuan,
                'keterangan_barang'    => $request->keterangan_barang,
                'created_at'           => now()
            ]);
            session()->flash('Success', 'Berhasil Menambah Data Pengajuan Barang');
            return Redirect(Route('Pengajuan')); 
        }
        else{
            session()->flash('Failed', 'Gagal Menambah Data Pengajuan Barang');
            return Redirect(Route('Pengajuan')); 
        }
    }

    public function editpengajuan($pengajuans)
    {
        $pengajuan = Pengajuan::select('*')->where('id',$pengajuans)->first();
        $user = User::getUser();
        return view ('pengajuanbarang.editpengajuan', compact('pengajuan', 'user')); 
    }

    public function storeeditpengajuan(request $request, $pengajuans)
    {
        $user = User::getUser();
        $pengajuan = Pengajuan::select('*')->where('id',$pengajuans)->first();
        $validation = $this->validate($request, [
            'kode_barang'       => 'required',
            'nama_barang'       => 'required',
            'qty_barang'        => 'required',
            'ruangan_barang'    => 'required',
            'merk_barang'       => 'required',
            'warna_barang'      => 'required',
            'hargasatuan_barang'=> 'required',
            'tgl_pengajuan'     => 'required'

        ]);
        if($validation){
            $pengajuan->update([
                'users_id'          => $user->id,
                'kode_barang'       => $request->kode_barang,
                'nama_barang'       => $request->nama_barang,
                'qty_barang'        => $request->qty_barang,
                'ruangan_barang'    => $request->ruangan_barang,
                'merk_barang'       => $request->merk_barang,
                'warna_barang'      => $request->warna_barang,
                'hargasatuan_barang'=> $request->hargasatuan_barang,
                'tgl_pengajuan'     => $request->tgl_pengajuan,
                'keterangan_barang' => $request->keterangan_barang,
                'updated_at'        => now()
            ]);
            session()->flash('Success', 'Berhasil Edit Pengajuan Barang');
            return Redirect(Route('Pengajuan')); 
        }
        else{
            session()->flash('Failed', 'Gagal Edit Pengajuan Barang');
            return Redirect(Route('Pengajuan').'/'.$pengajuan->id.'/Edit'); 
        }
        
    }
    public function deletepengajuan($id)
    {
        $pengajuan = Pengajuan::select('*')->where('id',$id)->first();
        Pengajuan::destroy($pengajuan); 
        session()->flash('Success', 'Berhasil Menghapus Pengajuan Barang');
        return Redirect(Route('Pengajuan'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id->delete();
    }
}
