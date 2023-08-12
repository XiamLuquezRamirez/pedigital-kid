<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgGradosModulosTransv extends Model
{
    protected $table = 'img_grados_modulos';
    protected $fillable = [
        'modulo_img',
        'url_img',
    ];

    public static function imgmodulo()
    {
        $ImgModulo = ImgGradosModulosTransv::orderBy('modulo_img', 'ASC')
            ->get();
        return $ImgModulo;
    }
}
