<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan_barang';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPengajuan($id)
    {
        return Pengajuan::get()->where('users_id', $id);
    }

    public static function destroy($id)
    {
        $id->delete();
    }
}
