<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colegios extends Model
{
    protected $table = 'colegios';
    protected $fillable = [
        'nombre',
        'ubicacion',
        'num_cursos',
        'estado',
        'habpasw'
    ];
    
    public static function Colegios()
    {
        $Cole = Colegios::get();
        return $Cole;
    }

    public static function InfColeg($col)
    {
        $Cole = Colegios::where('id', $col)
            ->first();
        return $Cole;
    }
    
    
    
}
