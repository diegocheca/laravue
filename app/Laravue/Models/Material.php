<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'descripcion',
        'stock',
        'proveedor',
        'contactoproveedor',
        'observacion',
        'unidad',
    ];
    protected $primaryKey = 'id';

}
