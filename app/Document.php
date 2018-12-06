<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $table = "documento";
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'usuario_id', 
        'tipo_id',
        'consecutivo',
        'fecha',
        'fecha_recibido',
        'terceros_id',
        'dias',
        'descuento',
        'valor_iva',
        'anticipo',
        'vendedor_id',
        'estatus',
        'cerrado',
        'anulado',
        'retefuente',
        'reteica',
        'revisado',
        'descuentos_id',
        'impresion',
        'observacion',
        'descuento_valor',
        'direccion_envio',
        'direccion_facturacion',
        'pormayor',
        'sucursal_id',
        'concepto_anulacion',
        'usuario_id_revision',
        'sin_consecutivo'
    ];
}
