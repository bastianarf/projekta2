<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $table = 'perbaikan_barang';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPerbaikan($id)
    {
        return Perbaikan::get()->where('users_id', $id);
    }

    public static function destroy($id)
    {
        $id->delete();
    }
}
