<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman_barang';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPeminjaman($id)
    {
        return Peminjaman::get()->where('users_id', $id);
    }
    public static function destroy($id)
    {
        $id->delete();
    }
}
