<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $table = 'profesores';
    protected $fillable = [
        'identificacion',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'email',
        'usuario_profesor',
        'estado',
        'foto',
        'jornada'
    ];


    public static function Buscar($id)
    {
        return Profesores::join('users', 'users.id', 'profesores.usuario_profesor')
            ->select('profesores.*', 'users.login_usuario')
            ->selectRaw('(CASE WHEN jornada = "JM" THEN "Jornada Mañana" WHEN jornada = "JT" THEN "Jornada Tarde" ELSE "Jornada Nocturna" END) AS jorna')
            ->where('usuario_profesor', $id)->first();
    }

}
