<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Loglogin extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //
    protected $fillable = [
        'id_user',
        'estado',
        'fecha',
    ];
    protected $primaryKey = 'id';
}
