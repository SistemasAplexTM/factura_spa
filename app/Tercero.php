<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    public $table = "terceros";
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'nombre', 
        'direccion', 
        'telefono', 
        'ciudad', 
        'email',
        'nacimiento',
        'documento',
        'vendedor',
        'proveedor',
        'datos_proveedor',
        'cliente',
        'usado',
    ];
}
