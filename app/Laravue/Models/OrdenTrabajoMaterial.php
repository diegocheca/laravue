<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenTrabajoMaterial extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ordentrabajo_id',
        'material_id',
        'cantidad',
        'created_by',
    ];
    protected $primaryKey = 'id';
}
