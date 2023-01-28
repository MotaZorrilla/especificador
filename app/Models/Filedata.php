<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filedata extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pintura'    ,
        'modelo'     ,
        'certificado',      
        'numero'     ,
        'masividad'  ,
        'm15'        ,
        'm30'        ,
        'm60'        ,
        'm90'        ,  
    ];
}
