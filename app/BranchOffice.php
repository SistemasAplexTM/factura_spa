<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    public $table = "setup";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nit',
        'razon_social'
    ];
}
