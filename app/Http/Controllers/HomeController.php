<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Jadwal;
use App\Models\Pengajuan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\VarDumper\Caster\EnumStub;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::getUser();
        $barang = Barang::orderBy('id','desc')->paginate();
        $usera = User::orderBy('id', 'desc')->paginate();
        $useradmin = User::orderBy('id', 'desc')->where('role','Admin')->paginate();
        $userkalab = User::orderBy('id', 'desc')->where('role','Kepala Laboratorium')->paginate();
        $userguru = User::orderBy('id', 'desc')->where('role','Guru')->paginate();
        $usersiswa = User::orderBy('id', 'desc')->where('role','Siswa')->paginate();
        $baranglab1 = Barang::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 1')->paginate();
        $baranglab2 = Barang::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 2')->paginate();
        $baranglab3 = Barang::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 3')->paginate();
        $perbaikan = Perbaikan::orderBy('id','desc')->paginate();
        $pengajuan = Pengajuan::orderBy('id','desc')->paginate();
        $peminjaman = Peminjaman::orderBy('id','desc')->paginate();
        $peminjamanlab1 = Peminjaman::orderBy('id', 'desc')->where('ruangan_barang','Laboratorium Komputer 1')->paginate();
        $peminjamanlab2 = Peminjaman::orderBy('id', 'desc')->where('ruangan_barang','Laboratorium Komputer 2')->paginate();
        $peminjamanlab3 = Peminjaman::orderBy('id', 'desc')->where('ruangan_barang','Laboratorium Komputer 3')->paginate();
        $perbaikanlab1 = Perbaikan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 1')->paginate();
        $perbaikanlab2 = Perbaikan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 2')->paginate();
        $perbaikanlab3 = Perbaikan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 3')->paginate();
        $pengajuanlab1 = Pengajuan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 1')->paginate();
        $pengajuanlab2 = Pengajuan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 2')->paginate();
        $pengajuanlab3 = Pengajuan::orderBy('id','desc')->where('ruangan_barang','Laboratorium Komputer 3')->paginate();
        $jadwal = Jadwal::orderBy('id', 'desc')->paginate();
        $jadwallab1 = Jadwal::orderBy('id','desc')->where('ruang_lab','Laboratorium Komputer 1')->paginate();
        $jadwallab2 = Jadwal::orderBy('id','desc')->where('ruang_lab','Laboratorium Komputer 2')->paginate();
        $jadwallab3 = Jadwal::orderBy('id','desc')->where('ruang_lab','Laboratorium Komputer 3')->paginate();
        $jadwalguru = Jadwal::orderBy('id','desc')->where('nama_guru',$user->nama_lengkap)->paginate();
        $jadwalsiswa = Jadwal::orderBy('id','desc')->where('kelas',$user->kelas)->paginate();
        return view('home', compact('user', 'barang', 'usera', 'useradmin','userkalab','userguru','usersiswa','baranglab1', 'baranglab2','baranglab3','perbaikan','pengajuan','peminjaman','peminjamanlab1','peminjamanlab2','peminjamanlab3','perbaikanlab1','perbaikanlab2','perbaikanlab3','pengajuanlab1','pengajuanlab2','pengajuanlab3','jadwal','jadwallab1','jadwallab2','jadwallab3','jadwalguru','jadwalsiswa'));
    }
    // Show Profile, Change Password, Store Password, Show Edit Profile
    public function profile()
    {
        $user = User::getUser();
        return view('users.profile.profile', compact('user'));
    }

    public function showedit()
    {
        $user = User::getUser();
        return view('users.profile.edit', compact('user'));
    }

    public function storeedit(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap'   => 'required',
            'nis_nip'        => 'required|numeric',
            'role'           => 'required'
        ]);
        $user = User::select()->where('id', Auth::user()->id)->first();
        $user->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'nis_nip'       => $request->nis_nip,
            'role'          => $request->role,
            'ruang_kalab'   => $request->ruangkalab,
            'mapel_guru'    => $request->mapel,
            'kelas'         => $request->kelas,
            'updated_at'    => now()
        ]);
        session()->flash('Success', '(Berhasil) Update Profil');
        return redirect(Route('Home'));
    }
    public function changepassword()
    {
        return view('users.profile.changepassword', ['user' => User::getUser()]);
    }
    public function storepass(Request $request)
    {
        $this->validate($request, [
            'password'              =>  'required|min:8',
            'password_confirmation' =>  'required|min:8',
        ]);
        $pass    = $request->password;
        $passkon = $request->password_confirmation;
        $user = User::getUser();
        if ($pass == $passkon) {
            $user->update([
                'password'  => Hash::make($request->password),
                'updated_at' => now()
            ]);
            session()->flash('Success', '(Berhasil) Mengganti Password');
            return redirect(Route('Home'));
        } else {
            session()->flash('Failed', '(Gagal) Password dan Password Konfirmasi Tidak Sama');
            return redirect(Route('Home/Profile/ChangePassword'));
        }
    }    
    public function del()
    {
        User::getUser()->delete();
        return Redirect(Route('Home'));
    }

     // Administrator Show Users, Create User , Store User
    
     public function show(Request $request)
     {  
     if ($request->search) {
         $users = User::orderBy('nama_lengkap', 'asc')->where('nama_lengkap', 'LIKE', '%' . $request->search . '%')->orwhere('nis_nip', 'LIKE', '%' . $request->search . '%')->paginate(5);
     } else {
         $users = User::orderBy('nama_lengkap', 'asc')->paginate(5);
     }
     return view('users.admin.users', ['users' => $users], ['user' => User::getUser()]);
     }
 
     
     public function create()
     {
     $user = User::getUser();
     return view('users.admin.create', compact('user'));
     }
 
     public function store(Request $request)
     {
         $this->validate($request, [
             'nama_lengkap'   => 'required',
             'nis_nip'        => 'required|numeric',
             'role'           => 'required',
             'email'          => 'required',
             'password'       => 'required|min:8'
         ]);
         $Cek = User::select('nis_nip')->where('nis_nip', $request->nis_nip)->count();
 
         if ($Cek != True) {
             User::create([
                 'nama_lengkap'   => $request->nama_lengkap,
                 'nis_nip'        => $request->nis_nip,
                 'role'           => $request->role,
                 'ruang_kalab'    => $request->ruangkalab,
                 'kelas'          => $request->kelas,
                 'mapel_guru'     => $request->mapel,
                 'email'          => $request->email,
                 'password'       => hash::make($request->password),
                 'created_at'     => now()
             ]);
             //$user_temp = User::select('id')->where('nis_nip', $request->nis_nip)->first();
             session()->flash('Success', 'Berhasil Membuat User');
         } else {
             session()->flash('Failed', 'Gagal Membuat User (NIS atau NIP Sudah Terdaftar)');
         }
         return redirect(Route('Admin/Show'));
     }
 
     public function showuser($nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         $user = User::getUser();
         return view('users.admin.profile', compact('user','user_pegawai'));
     }
 
     public function showedituser($nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         $user = User::getUser();
         return view('users.admin.edit', compact('user_pegawai','user'));
     }
 
     public function storeedituser(Request $request, $nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         $this->validate($request, [
             'nama_lengkap'   => 'required',
             'nis_nip'        => 'required|numeric',
             'role'           => 'required'
         ]);
         $user = User::select()->where('id', $user_pegawai->id)->first();
         $user->update([
             'nama_lengkap'  => $request->nama_lengkap,
             'nis_nip'       => $request->nis_nip,
             'role'          => $request->role,
             'ruang_kalab'   => $request->ruangkalab,
             'mapel_guru'    => $request->mapel,
             'kelas'         => $request->kelas,
             'updated_at'    => now()
         ]);
         session()->flash('Success', '(Berhasil) Update User ' . $user_pegawai->nama_lengkap);
         return redirect(Route('Admin/Show'));
     }
 
     public function changepass($nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         return view('users.admin.changepassword', ['user' => User::getUser()], ['user_pegawai' => $user_pegawai]);
     }
     
     public function storechangepass(Request $request, $nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         $this->validate($request, [
             'password'              =>  'required|min:8',
             'password_confirmation' =>  'required|min:8',
         ]);
         $pass    = $request->password;
         $passkon = $request->password_confirmation;
         $user = $user_pegawai;
         if ($pass == $passkon) {
             $user->update([
                 'password'  => Hash::make($request->password),
                 'updated_at' => now()
             ]);
             session()->flash('Success', '(Berhasil) Mengganti Password User ' . $user->nama_lengkap);
             return redirect(Route('Admin/Show'));
         } else {
             session()->flash('Failed', '(Gagal) Password dan Password Konfirmasi Tidak Sama');
             return redirect(Route('Home/Profile/ChangePassword'));
         }
     }
 
     public function deluser($nis_nip)
     {
         $user_pegawai = User::select('*')->where('nis_nip', $nis_nip)->first();
         $user_pegawai->update([
             'role' => 4
         ]);
         User::destroy($user_pegawai);
         session()->flash('Success', 'Berhasil Menghapus User');
         return Redirect(Route('Admin/Show'));
     }

     // Batas ADMIN
}
