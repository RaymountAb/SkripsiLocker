<?php

//namespace App\Models;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Pegawai extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;

    protected $table = 'm_pegawai';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'nip',
        'nama',
        'password',
        'api_token',
    ];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = [
        'nip' => 'integer',
    ];

    public function pegawaidetail()
    {
        return $this->hasOne(Pegawai::class);
    }
    public function qrcode()
    {
        return $this->hasOne(MQrcode::class);
    }
}
