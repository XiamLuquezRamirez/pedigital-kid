<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RespMultPregMEPruebaSimulacro extends Model
{
    protected $table = 'resp_pregmultiple_me_prueba';
    protected $fillable = [
        'alumno',
        'sesion',
        'pregunta',
        'respuesta',
        'fecha',
    ];

    public static function Guardar($data, $fecha)
    {
        $Opc = RespMultPregMEPruebaSimulacro::where('pregunta', $data["Pregunta"])
            ->where('alumno', Auth::user()->id)
            ->first();
        if ($Opc) {
            $Opc->delete();
        }

        foreach ($data["Opciones"] as $key => $val) {
            if ($data["OpcionSel"][$key] == "si") {

                $grupPre = RespMultPregMEPruebaSimulacro::create([
                    'alumno' => Auth::user()->id,
                    'sesion' => $data['IdSesion'],
                    'pregunta' => $data["PreguntaOpc"],
                    'respuesta' => $data["Opciones"][$key],
                    'fecha' => $fecha
                ]);
            }
        }
        $respuesta =[
            'RegViejo' => $Opc,
            'RegNuevo' =>$grupPre
        ];

        return $respuesta ;
    }

}
