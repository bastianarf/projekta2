<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'inventaris_barang';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function barang_user()
    {
        return $this->hasMany(barang_user::class,'barang_id');
    }
    public static function getBarang($id)
    {
        return Barang::get()->where('ruangan_barang', $id)->first();
    }

    public static function getFullBarang()
    {
        return Barang::get();
    }

    public static function destroy($id)
    {
        $id->delete();
    }
}
