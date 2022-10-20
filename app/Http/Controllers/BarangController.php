<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::getUser();
        $baranglab = Barang::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate(5);
        if ($request->search) {
            if ($request->search >= 1) {
                $barang = Barang::orderBy('id', 'desc')->where('kode_barang', 'LIKE', '%' . $request->search . '%')->paginate(5);
            } else {
                $barang = Barang::orderBy('id', 'desc')->where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate(5);
            }
        } else {
            $barang = Barang::orderBy('id', 'desc')->paginate(5);
        }
        return view('barang.barang', compact('user', 'barang', 'baranglab'));
    }

    public function editbarang($barangs)
    {
        $barang = Barang::select('*')->where('id',$barangs)->first();
        $user = User::getUser();
        return view ('barang.editbarang', compact('barang', 'user')); 
    }

    public function storeeditbarang(request $request, $barangs)
    {
        $user = User::getUser();
        $barang = Barang::select('*')->where('id',$barangs)->first();
        $validation = $this->validate($request, [
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'qty_barang'    => 'required',
            'ruangan_barang'=> 'required',
            'merk_barang'   => 'required',
            'warna_barang'  => 'required',
            'kondisi_barang'=> 'required'
        ]);
        if($validation){
            $barang->update([
                'users_id'      => $user->id,
                'kode_barang'   => $request->kode_barang,
                'nama_barang'   => $request->nama_barang,
                'qty_barang'    => $request->qty_barang,
                'ruangan_barang'=> $request->ruangan_barang,
                'merk_barang'   => $request->merk_barang,
                'warna_barang'  => $request->warna_barang,
                'kondisi_barang'=> $request->kondisi_barang,
                'catatan_barang'=> $request->catatan_barang,
                'updated_at'    => now()
            ]);
            session()->flash('Success', 'Berhasil Edit Barang');
            return Redirect(Route('Barang')); 
        }
        else{
            session()->flash('Failed', 'Gagal Edit Barang');
            return Redirect(Route('Barang').'/'.$barang->id.'/Edit'); 
        }
        
    }
    public function tambah(Request $id)
    {
        $user = User::getUser();
        $usera = User::getUser($id->id)->first();
        $barang = Barang::select('users_id')->where('users_id',$id->users_id)->first();
        return view('barang.tambah', compact('user', 'usera', 'barang'));
    }

    public function storetambah(Request $request)
    {
        $user = User::getUser();
        $validation = $this->validate($request, [
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'qty_barang'    => 'required',
            'ruangan_barang'=> 'required',
            'merk_barang'   => 'required',
            'warna_barang'  => 'required',
            'kondisi_barang'=> 'required'
        ]);
        if($validation){
            Barang::create([
                'users_id'      => $user->id,
                'kode_barang'   => $request->kode_barang,
                'nama_barang'   => $request->nama_barang,
                'qty_barang'    => $request->qty_barang,
                'ruangan_barang'=> $request->ruangan_barang,
                'merk_barang'   => $request->merk_barang,
                'warna_barang'  => $request->warna_barang,
                'kondisi_barang'=> $request->kondisi_barang,
                'catatan_barang'=> $request->catatan_barang,
                'created_at'    => now()
            ]);
            session()->flash('Success', 'Berhasil Menambah Barang');
            return Redirect(Route('Barang')); 
        }
        else{
            session()->flash('Failed', 'Gagal Menambah Barang');
            return Redirect(Route('Barang')); 
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */

    public function deletebarang($id)
    {
        $barang = Barang::select('*')->where('id',$id)->first();
        Barang::destroy($barang); 
        session()->flash('Success', 'Berhasil Menghapus Barang');
        return Redirect(Route('Barang'));
    }
    
    public function destroy($id)
    {
        $id->delete();
    }
}
