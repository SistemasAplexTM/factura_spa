<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentDetail;
use Illuminate\Support\Facades\DB;

class DocumentDetailController extends Controller
{
    public function getDetailByIdDocument($code){
    	$data = DB::select(
                DB::raw("SELECT
						a.id,
						a.descripcion AS producto,
						a.precio_venta AS precio,
						a.precio_pormayor,
						a.precio_con_iva,
						a.costo,
						1 AS cantidad,
						0 AS descuento,
						((1 * a.precio_venta) + ROUND(b.valor * a.precio_venta / 100)) AS monto_total,
						ROUND(b.valor * a.precio_venta / 100) AS iva,
						ROUND(b.valor,0) AS porcentaje_iva
						FROM
						producto AS a
						INNER JOIN iva AS b ON a.iva_id = b.id
						WHERE
						a.id = $code")
            );

    	$answer = array(
            'code'  => 200,
            'data' => $data,
        );

    	return \Response::json($answer);
    }
}
