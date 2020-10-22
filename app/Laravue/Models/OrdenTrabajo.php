<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    //
    protected $fillable = [
        'description',
        'idcliente',
        'direccion',
        'idconexion',
        'idtecnico',
        'startdate',
        'enddate',
        'porcent',
        'color',
        'created_by',
        'estado',
        'newconexion',
        'observacion',
    ];
    protected $primaryKey = 'id';

}
