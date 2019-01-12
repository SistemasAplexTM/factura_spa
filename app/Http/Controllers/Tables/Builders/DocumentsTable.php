<?php

namespace App\Http\Controllers\Tables\Builders;

use App\Document;
use LaravelEnso\VueDatatable\app\Classes\Table;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class DocumentsTable extends Table
{

	protected $templatePath = __DIR__.'/../Templates/documentsTable.json';

	public function query(){
		return Document::select(\DB::raw(
			'documento.id AS "dtRowId",
			documento.consecutivo,
			documento.fecha,
			documento.usuario_id,
			documento.terceros_id,
      terceros.nombre,
			documento.valor_iva,
			documento.descuento,
      (SELECT
      Count(a.id) AS cantidad
      FROM
      detalle AS a
      WHERE
      a.deleted_at IS NULL AND
      a.documento_id = documento.id) AS quantity,
      (SELECT
			IF((Sum(ROUND(
					(
						b.total_venta * b.iva / 100
					) + b.total_venta
				))) <> "", (Sum(ROUND(
					(
						b.total_venta * b.iva / 100
					) + b.total_venta
				))), 0) AS venta
			FROM
			detalle AS b
			WHERE
			b.deleted_at IS NULL AND
			b.documento_id = documento.id) AS total_sale,
      (SELECT
      Sum(c.valor)
      FROM
      detalle_pago AS c
      WHERE
      c.deleted_at IS NULL AND
      c.documento_id = documento.id AND
			c.deleted_at IS NULL) AS total_payment,
			((SELECT
			IF((Sum(ROUND(
					(
						b.total_venta * b.iva / 100
					) + b.total_venta
				))) <> "", (Sum(ROUND(
					(
						b.total_venta * b.iva / 100
					) + b.total_venta
				))), 0) AS venta
			FROM
			detalle AS b
			WHERE
			b.deleted_at IS NULL AND
			b.documento_id = documento.id) - (SELECT
      Sum(c.valor)
      FROM
      detalle_pago AS c
      WHERE
      c.deleted_at IS NULL AND
      c.documento_id = documento.id AND
			c.deleted_at IS NULL)) AS res'
		))
    ->leftJoin('terceros', 'terceros.id', '=', 'documento.terceros_id')
    ->where('documento.sucursal_id', '=', Auth::user()->sucursal_id)
    ->orderBy('documento.fecha', 'desc');
	}

	// public function query2(){
	// 	return Document::select(\DB::raw(
	// 		'documento.id AS "dtRowId",
	// 		documento.consecutivo,
	// 		documento.fecha,
	// 		documento.usuario_id,
	// 		documento.terceros_id,
  //     terceros.nombre,
	// 		documento.valor_iva,
	// 		documento.descuento,
  //     (SELECT
  //     Count(a.id) AS cantidad
  //     FROM
  //     detalle AS a
  //     WHERE
  //     a.deleted_at IS NULL AND
  //     a.documento_id = documento.id) AS quantity,
	// 		c.venta AS total_sale,
	// 		b.valor_pago AS total_payment,
	// 		(c.venta - b.valor_pago) AS res'
	// 	))
  //   ->leftJoin('terceros', 'terceros.id', '=', 'documento.terceros_id')
  //   ->leftJoin(\DB::raw('(
	// 		SELECT
	// 			ROUND(Sum(c.valor)) AS valor_pago,
	// 			c.documento_id
	// 		FROM
	// 			detalle_pago AS c
	// 		WHERE
	// 			c.deleted_at IS NULL
	// 		AND c.deleted_at IS NULL
	// 		GROUP BY
	// 			c.documento_id
	// 	) AS b'), 'documento.id', '=', 'b.documento_id')
	// 	->leftJoin(\DB::raw('(
	// 		SELECT
	// 		IF (
	// 			(
	// 				Sum(
	// 					ROUND(
	// 						(b.total_venta * b.iva / 100) + b.total_venta
	// 					)
	// 				)
	// 			) <> "",
	// 			(
	// 				Sum(
	// 					ROUND(
	// 						(b.total_venta * b.iva / 100) + b.total_venta
	// 					)
	// 				)
	// 			),
	// 			0
	// 		) AS venta,
	// 		b.documento_id
	// 	FROM
	// 		detalle AS b
	// 	WHERE
	// 		b.deleted_at IS NULL
	// 	GROUP BY
	// 		b.documento_id
	// 	) AS c'), 'documento.id', '=', 'c.documento_id')
  //   ->where('documento.sucursal_id', '=', Auth::user()->sucursal_id)
  //   ->orderBy('documento.fecha', 'desc');
	// }

}
