<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentDetail extends Model
{
    public $table = "detalle";
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'documento_id',
        'producto_id',
        'descripcion',
        'transaccion',
        'bodega_id',
        'cantidad',
        'cantidad_final',
        'precio',
        'costo',
        'venta',
        'total_desto',
        'total_costo',
        'total_venta',
        'descuento',
        'iva',
        'doc_cruce',
        'observacion',
        'fecha_recibido',
        'id_cruce',
        'devolucion',
        'descuentos_id',
        'descuento_tipo'
    ];
}
