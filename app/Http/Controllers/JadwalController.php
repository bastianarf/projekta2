<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jadwal;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::getUser();
        if ($request->search) {
            if ($request->search >= 1) {
                $jadwal = Jadwal::orderBy('id', 'desc')->where('kelas', 'LIKE', '%' . $request->search . '%')->paginate(10);
            } else {
                $jadwal = Jadwal::orderBy('id', 'desc')->where('ruang_lab', 'LIKE', '%' . $request->search . '%')->paginate(10);
            }
        } else {
            $jadwal = Jadwal::orderBy('id', 'desc')->paginate(10);
        }
        return view('jadwal.jadwal', compact('user', 'jadwal'));
    }

    public function tambah(Request $id)
    {
        $user = User::getUser();
        $usera = User::orderBy('id', 'desc')->paginate(10);
        $jadwal = Jadwal::select('*')->where('users_id', $id->id)->first();
        return view ('jadwal.tambah', compact('user','usera','jadwal'));
    }

    public function storetambah(Request $request)
    {
        $user = User::getUser();
        $validation = $this->validate($request, [
            'ruang_lab'             => 'required',
            'kelas'                 => 'required',
            'tgl_penggunaan'        => 'required',
            'waktu_penggunaan_mulai'=> 'required',
            'waktu_penggunaan_akhir'=> 'required',
            'nama_matpel'           => 'required',
            'nama_guru'             => 'required'
        ]);
        if($validation){
            Jadwal::create([
                'users_id'              => $user->id,
                'ruang_lab'             => $request->ruang_lab,
                'kelas'                 => $request->kelas,
                'tgl_penggunaan'        => $request->tgl_penggunaan,
                'waktu_penggunaan_mulai'=> $request->waktu_penggunaan_mulai,
                'waktu_penggunaan_akhir'=> $request->waktu_penggunaan_akhir,
                'nama_matpel'           => $request->nama_matpel,
                'nama_guru'             => $request->nama_guru,
                'created_at'            => now()
            ]);
        session()->flash('Success', 'Berhasil Menambah Data Jadwal');
            return Redirect(Route('Jadwal')); 
        }
        else{
            session()->flash('Failed', 'Gagal Menambah Data Jadwal');
            return Redirect(Route('Jadwal')); 
        }
    }

    public function editjadwal($jadwals)
    {
        $jadwal = Jadwal::select('*')->where('id',$jadwals)->first();
        $user = User::getUser();
        $usera = User::orderBy('id', 'desc')->paginate(10);
        return view ('jadwal.editjadwal', compact('jadwal', 'user','usera'));
    }

    public function storeeditjadwal(Request $request, $jadwals)
    {
        $user = User::getUser();
        $jadwal = Jadwal::select('*')->where('id',$jadwals)->first();
        $validation = $this->validate($request, [
            'ruang_lab'             => 'required',
            'kelas'                 => 'required',
            'tgl_penggunaan'        => 'required',
            'waktu_penggunaan_mulai'=> 'required',
            'waktu_penggunaan_akhir'=> 'required',
            'nama_matpel'           => 'required',
            'nama_guru'             => 'required'
        ]);
        if($validation){
            $jadwal->update([
                'users_id'              => $user->id,
                'ruang_lab'             => $request->ruang_lab,
                'kelas'                 => $request->kelas,
                'tgl_penggunaan'        => $request->tgl_penggunaan,
                'waktu_penggunaan_mulai'=> $request->waktu_penggunaan_mulai,
                'waktu_penggunaan_akhir'=> $request->waktu_penggunaan_akhir,
                'nama_matpel'           => $request->nama_matpel,
                'nama_guru'             => $request->nama_guru,
                'updated_at'            => now()
            ]);
            session()->flash('Success', 'Berhasil Edit Jadwal');
            return Redirect(Route('Jadwal')); 
        }
        else{
            session()->flash('Failed', 'Gagal Edit Jadwal');
            return Redirect(Route('Jadwal').'/'.$jadwal->id.'/Edit');
        } 
    }

    public function deletejadwal($id)
    {
        $jadwal = Jadwal::select('*')->where('id',$id)->first();
        Jadwal::destroy($jadwal); 
        session()->flash('Success', 'Berhasil Menghapus Jadwal');
        return Redirect(Route('Jadwal'));
    }
    public function destroy($id)
    {
        $id->delete();
    }
}
