<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $table = 'tm_directorio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ext_id',
        'order_id',
        'dep_nom',
        'depto_nom',
        'ext_num',
        'usu_nom',
    ];
    
}
