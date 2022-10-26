<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    public $table='favoritos';
    protected $fillable = [
        'id_usuario',
        'ref_api',
        'name'
    ];

    public static function getFavoritesByUser($id){
        $data=Favorito::where('id_usuario', $id)->get();
        return $data;
    }
}
