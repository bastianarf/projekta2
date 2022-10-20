<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::getUser();
        $perbaikanlab = Perbaikan::orderBy('id', 'desc')->where('ruangan_barang',$user->ruang_kalab)->paginate(10);
        $perbaikanid = Perbaikan::get()->where('id', $request->id)->first();
        if ($request->search) {
            if ($request->search >= 1) {
                $perbaikan = Perbaikan::orderBy('id', 'desc')->where('kode_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            } else {
                $perbaikan = Perbaikan::orderBy('id', 'desc')->where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate(10);
            }
        } else {
            $perbaikan = Perbaikan::orderBy('id', 'desc')->paginate(10);
        }
        return view('perbaikanbarang.perbaikan', compact('user', 'perbaikan','perbaikanid','perbaikanlab'));
    }

    public function tambah(Request $id)
    {
        $user = User::getUser();
        $usera = User::getUser($id->id)->first();
        $barang = Barang::orderBy('id','desc')->paginate(10);
        $baranglab = Barang::orderBy('id','desc')->where('users_id',$id->id)->paginate(10);
        $perbaikan = Perbaikan::select('*')->where('users_id',$id->id)->first();
        $listperbaikan = Perbaikan::orderBy('id','desc')->paginate(10);
        //dd($listperbaikan);
        return view('perbaikanbarang.tambah', compact('user', 'usera', 'perbaikan', 'barang', 'baranglab', 'listperbaikan'));
    }

    public function storetambah(Request $request)
    {
        $user = User::getUser();
        $validation = $this->validate($request, [
            'kode_barang'      => 'required',
            'nama_barang'      => 'required',
            'qty_barang'       => 'required',
            'ruangan_barang'   => 'required',
            'jenis_kerusakan'  => 'required'
        ]);
        if($validation){
            Perbaikan::create([
                'users_id'             => $user->id,
                'kode_barang'          => $request->kode_barang,
                'nama_barang'          => $request->nama_barang,
                'qty_barang'           => $request->qty_barang,
                'ruangan_barang'       => $request->ruangan_barang,
                'jenis_kerusakan'      => $request->jenis_kerusakan,
                'keterangan_barang'    => $request->keterangan_barang,
                'created_at'           => now()
            ]);
            session()->flash('Success', 'Berhasil Menambah Data Perbaikan Barang');
            return Redirect(Route('Perbaikan')); 
        }
        else{
            session()->flash('Failed', 'Gagal Menambah Data Perbaikan Barang');
            return Redirect(Route('Perbaikan')); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function deleteperbaikan($id)
    {
        $perbaikan = Perbaikan::select('*')->where('id',$id)->first();
        Perbaikan::destroy($perbaikan); 
        session()->flash('Success', 'Berhasil Menghapus Barang');
        return Redirect(Route('Perbaikan'));
    }
    
     public function destroy($id)
    {
        $id->delete();
    }
}
