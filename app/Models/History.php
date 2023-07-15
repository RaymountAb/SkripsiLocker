<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'loghistory';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'date',
        'time',
        'loker',
        'pegawai',
        'activity'
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
