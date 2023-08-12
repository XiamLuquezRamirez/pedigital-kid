<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgAsignatura extends Model
{
     protected $table = 'img_asignaturas';
    protected $fillable = [
        'asig_img',
        'url_img'
    ];
    
    
    public static function imgAsig() {
        $ImgAig = ImgAsignatura::get();
        return $ImgAig;
    }
    
}
