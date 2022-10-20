<?php

namespace App\Models\Auth;

use App\Models\Auth\AuthenticatesUsers;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap', 'nis_nip', 'role', 'ruang_kalab', 'kelas','mapel_guru', 'email', 'password','created_at','updated_at', 'cek'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class,'users_id');
    }

    public function perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'users_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'users_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'users_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'users_id');
    }

    public static function enum_get($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field='{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $no = 1;
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[$no] = $v;
            $no++;
        }
        return collect($enum);
    }
    public static function role_check($role)
    {
        $roles = collect($role);
        foreach ($roles as $role) {
            if ($role == Auth::user()->role) {
                return True;
            }
        }
    }

    //TAMBAHAN
    public static function ruangkalab_check($ruangkalab)
    {
        $ruangkalabs = collect($ruangkalab);
        foreach ($ruangkalabs as $ruangkalab) {
            if ($ruangkalab == Auth::user()->ruang_kalab) {
               return True; 
            }
        }
    }

    public static function kelas_check($kelas)
    {
        $kelass = collect($kelas);
        foreach ($kelass as $kelas) {
            if ($kelas == Auth::user()->kelas) {
                return True;
            }
        }
    }

    public static function mapel_check($mapel)
    {
        $mapels = collect($mapel);
        foreach ($mapels as $mapel) {
            if ($mapel == Auth::user()->mapel_guru) {
                return True;
            }
        }
    }
    //Fungsi Luar

    public static function getUser(){
        return User::get()->where('id',Auth::user()->id)->first();
    }
    
    public static function destroy($user)
    {
        $user->delete();
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
