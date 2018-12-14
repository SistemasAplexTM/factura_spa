<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Cupons;
use App\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
  public function save(Request $request)
  {
    $type = Type::where('tiendas', Auth::user()->sucursal_id)->first();

    DB::beginTransaction();
    try {
        $data = Document::create([
          'usuario_id' => Auth::id(),
          'tipo_id' => $type->id,
          'consecutivo' => 9999999,
          'fecha' => date('Y-m-d', strtotime($request['form_document']['date'])),
          'fecha_recibido' => date('Y-m-d', strtotime($request['form_document']['date_receip'])),
          'terceros_id' => $request['form_document']['client_id'],
          'dias' => $request['form_document']['days'],
          'descuento' => $request['totals']['descuento_2'],
          'valor_iva' => $request['totals']['iva'],
          'anticipo' => $request['totals']['anticipo'],
          'vendedor_id' => $request['form_document']['seller_id'],
          'estatus' => 2,
          'retefuente' => $request['totals']['retefuente'],
          'reteica' => $request['totals']['reteica'],
          // 'descuentos_id' => $request['form_document']['i']d
          'impresion' => 0,
          'observacion' => $request['form_document']['observation'],
          'descuento_valor' => $request['totals']['descuento_1'],
          'pormayor' => 0,
          'sucursal_id' => Auth::user()->sucursal_id
        ]);

        $consecutive = DB::("CALL sp_getConsecutivo(?,?,?
        )", array($type->id, $data->id, date('Y-m-d', strtotime(time()))))
        $answer = array(
            "code"   => 200
        );
        DB::commit();
        return $answer;
    } catch (Exception $e) {
        DB::rollback();
        $answer = array(
            "error" => $e,
            "code"  => 600,
        );
        return $answer;
    }
  }

  public function getCupon($data){

    $datos = Cupons::where('codigo_barras', $data)->first();
    if($datos != '' or $datos != false){
      $code = 200;
      $fecha_actual = strtotime(date("d-m-Y",time()));
      $fecha_fin = strtotime($datos->fecha_fin);
      if($fecha_actual > $fecha_fin){
        $code = 600;
        $msg = 'El cupón caduco el ' . $datos->fecha_fin;
      }else{
        $msg = '<strong>' . $datos->descripcion . '</strong> <br> Se aplicará a esta factura';
      }
    }else{
      $code = 600;
      $msg = 'No hay datos con ese código';
    }
    $answer = array(
      'code'  => $code,
      'data' => $datos,
      'msg' => $msg,
      'user' => Auth::user()
    );

    return \Response::json($answer);
  }

}
