<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemasModuloE_Img extends Model
{
    protected $table = 'imagenes_moduloe';
    protected $fillable = [
        'tema',
        'imagen'
    ];

    public static function BuscarTema($id) {
        $InfTema = TemasModuloE_Img::where('tema', $id)
                ->get();
        return $InfTema;
    }

    
}
