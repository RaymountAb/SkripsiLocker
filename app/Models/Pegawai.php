<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pegawai extends Model
{
    use HasFactory;   
    
    protected $table = 'm_pegawai';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'nip',
        'nama',
        'password'
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
