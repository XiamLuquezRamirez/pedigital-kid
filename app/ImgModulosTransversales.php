<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgModulosTransversales extends Model
{
    protected $table = 'img_modtransversales';
    protected $fillable = [
        'asig_img',
        'url_img'
    ];

    public static function imgAsig() {
        $ImgAig = ImgModulosTransversales::get();
        return $ImgAig;
    }
}
