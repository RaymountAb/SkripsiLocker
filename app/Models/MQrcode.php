<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MQrcode extends Model
{
    use HasFactory;

    protected $table = 'm_qrcode';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;

    protected $guarded = ['id'];
    protected $fillable = [
        'pegawai',
        'qrcode'
    ];

    public function locker()
    {
        return $this->hasOne(Locker::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
