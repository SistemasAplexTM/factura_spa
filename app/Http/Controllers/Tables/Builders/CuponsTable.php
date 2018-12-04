<?php 

namespace App\Http\Controllers\Tables\Builders;

use App\Cupons;
use LaravelEnso\VueDatatable\app\Classes\Table;

/**
 * 
 */
class CuponsTable extends Table
{
	
	protected $templatePath = __DIR__.'/../Templates/cuponsTable.json';

	public function query(){
		return Cupons::select(\DB::raw(
			'descuentos.id AS "dtRowId", 
			descuentos.codigo_barras, 
			descuentos.descuento, 
			descuentos.descripcion,
			descuentos.fecha_inicio,
			descuentos.fecha_fin,
			descuentos.cantidad,
			descuentos.cant_restante,
			descuentos.tipo_descuento'
		))->where('descuentos.id', '<>', 1);
	}
}