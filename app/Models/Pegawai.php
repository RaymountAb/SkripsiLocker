<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pegawai extends Authenticatable
{
    use HasFactory,Notifiable, HasApiTokens;

    protected $table = 'm_pegawai';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'username',
        'nip',
        'nama',
        'password',
        //'api_token',
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
