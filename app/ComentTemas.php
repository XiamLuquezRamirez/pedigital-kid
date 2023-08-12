<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ComentTemas extends Model {

    protected $table = 'coment_tema';
    protected $fillable = [
        'tema',
        'usuario',
        'comentario'
    ];

    public static function Guardar($idTem, $Coment) {
        return ComentTemas::create([
                    'tema' => $idTem,
                    'usuario' => Auth::user()->id,
                    'comentario' => $Coment
        ]);
    }

    public static function Consultar($id) {
        $Respuesta = ComentTemas::join('users', 'users.id', 'coment_tema.usuario')
                ->where('tema', $id)
                ->orWhere('usuario', Auth::user()->id)
                ->select("users.nombre_usuario", "comentario")
                ->get();
        return $Respuesta;
    }

}
