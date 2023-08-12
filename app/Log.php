<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Log extends Model
{
   
    protected $table = 'log_u';
    protected $fillable = [
        'id_usuario',
        'perfil',
        'accion',
        'id_afectado',
        'fecha',
        'hora'
    ];
    
    
    public static function Guardar($accion,$Afec) {
     
        return Log::create([
                    'id_usuario' => Auth::user()->id,
                    'perfil' => Auth::user()->tipo_usuario,
                    'accion' => $accion,
                    'id_afectado' => $Afec,
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s')
        ]);
    }
}
