<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'loghistory';
    protected $primarykey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'date',
        'time',
        'loker',
        'pegawai',
        'activity'
    ];
}
