<?php 

namespace App\Http\Controllers\Tables\Builders;

use App\Payments;
use LaravelEnso\VueDatatable\app\Classes\Table;

/**
 * 
 */
class PaymentsTable extends Table
{
	
	// protected $templatePath = __DIR__ . '/../Templates/paymentsTable.json';
	protected $templatePath = __DIR__.'/../Templates/paymentsTable.json';

	public function query(){
		return Payments::select(\DB::raw('forma_pago.id AS "dtRowId", forma_pago.descripcion'));
	}
}