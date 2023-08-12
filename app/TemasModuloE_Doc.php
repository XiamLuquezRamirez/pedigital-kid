<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemasModuloE_Doc extends Model
{
    protected $table = 'documento_moduloe';
    protected $fillable = [
        'tema',
        'contenido'
    ];


    public static function BuscarTema($id) {
        $InfTema = TemasModuloE_Doc::where('tema', $id)
                ->first();
        return $InfTema;
    }
}
