<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal_lab';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJadwal($id)
    {
        return Jadwal::get()->where('users_id', $id);
    }
    public static function destroy($id)
    {
        $id->delete();
    }
}
