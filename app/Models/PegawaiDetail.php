<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiDetail extends Model
{
    use HasFactory;

    protected $table= 'm_pegawaidetail';

    protected $primarykey='id';

    public $timestamps = true;
    public $incrementing= true;

    protected $guarded = ['id'];

    protected $fillable=[
        'pegawai',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'foto',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    
}
