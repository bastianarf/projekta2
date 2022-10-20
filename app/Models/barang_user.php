<?php

namespace App;

use App\Models\Auth\User;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;

class barang_user extends Model
{
    protected $fillable = ['updated_at','created_at'];
    public function user()
    {
        return $this->hasOne(User::class,'id','users_id');
    }
    public function barang()
    {
        return $this->hasOne(Barang::class,'id','barang_id');
    }
}
