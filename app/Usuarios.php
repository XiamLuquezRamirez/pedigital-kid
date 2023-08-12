<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Model {

    protected $table = 'users';
    protected $fillable = [
        'id',
        'nombre_usuario',
        'login_usuario',
        'pasword_usuario',
        'tipo_usuario',
        'email_usuario',
        'estado_usuario',
        'grado_usuario'
    ];

    public static function login($request) {

        $usuario = Usuarios::where('id', $request['Usuario'])->where('estado_usuario', 'ACTIVO')->first();

        if ($usuario && \Hash::check($request['Pasw'], $usuario->pasword_usuario)) {
            auth()->loginUsingId($usuario->id);
            return $usuario;
        }
        return false;
    }

    public static function login2($est) {
        $usuario = Usuarios::where('id', (int) $est)->where('estado_usuario', 'ACTIVO')->first();
        auth()->loginUsingId($usuario->id);
        return $usuario;
    }

    public static function loginDocente($request) {

        $usuario = Usuarios::where('login_usuario', $request['Usuario'])->where('estado_usuario', 'ACTIVO')->first();

        if ($usuario && \Hash::check($request['Pasw'], $usuario->pasword_usuario)) {
            auth()->loginUsingId($usuario->id);
            return $usuario;
        }
        return false;
    }

}
