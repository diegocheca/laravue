<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $fillable = [
        'descripcion',
        'stock',
        'proveedor',
        'contactoproveedor',
        'observacion',
        'unidad',
    ];
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
