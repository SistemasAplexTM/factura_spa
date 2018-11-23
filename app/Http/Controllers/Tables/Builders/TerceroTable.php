<?php 

namespace App\Http\Controllers\Tables\Builders;

use App\Tercero;
use LaravelEnso\VueDatatable\app\Classes\Table;

/**
 * 
 */
class TerceroTable extends Table
{
	
	protected $templatePath = __DIR__.'/../Templates/terceroTable.json';

	public function query(){
		return Tercero::select(\DB::raw(
				'id AS "dtRowId", 
				terceros.nombre,
				terceros.direccion,
				terceros.telefono,
				terceros.ciudad,
				terceros.email,
				terceros.nacimiento,
				terceros.documento,
				terceros.usado,
				terceros.vendedor,
				terceros.proveedor,
				terceros.datos_proveedor,
				terceros.cliente')
		);
	}
}