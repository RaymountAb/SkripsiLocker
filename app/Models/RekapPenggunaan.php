<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPenggunaan extends Model
{
    use HasFactory;

    protected $table = 'rekap_penggunaan';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'pegawai',
        'loker',
        'waktu',
        'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(MQrcode::class);
    }
    public function loker()
    {
        return $this->belongsTo(Locker::class);
    }
}
