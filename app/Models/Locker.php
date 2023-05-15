<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;

    protected $table = 'm_locker';

    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    
    protected $guarded = ['id'];
    
    protected $fillable = [
        'name_loker',
        'status',
        'qrcode'
    ];


}
