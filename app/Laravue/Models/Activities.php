<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activities extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'tipo_log',
        'created_by',
        'tabla_modificada',
        'id_row_modificada',
        'valores_anteriores',
        'estado',

    ];
    protected $primaryKey = 'id';
}