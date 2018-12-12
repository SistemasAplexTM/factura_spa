<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $table = "tipo";
    protected $fillable = ['descripcion', 'tiendas'];
}
