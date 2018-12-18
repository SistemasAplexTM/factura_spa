<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\DocumentDetail;
use App\Cupons;
use App\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
  public function save(Request $request)
  {
    return array("code" => 200, "consecutivo" => 213135);
    // $type = $this->getType(Auth::user()->sucursal_id);
    // DB::beginTransaction();
    // try {
    //     $document = $this->saveHeadboard($request, $type);
    //     //INSERT DETAIL
    //     $this->saveDetail($request['table_detail'], $document->id, $type);
    //     $answer = array(
    //         "code"   => 200
    //     );
    //     DB::commit();
    //     return $answer;
    // } catch (Exception $e) {
    //     DB::rollback();
    //     $answer = array(
    //         "error" => $e,
    //         "code"  => 600,
    //     );
    //     return $answer;
    // }
  }

  public function saveHeadboard($request, $type)
  {
    try {
      $data = Document::create([
        'usuario_id' => Auth::id(),
        'tipo_id' => $type->id,
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
        'pormayor' => $request['wholesale'],
        'sucursal_id' => Auth::user()->sucursal_id
      ]);
      $consecutive = DB::select("CALL sp_getConsecutivo(?,?,?)", array($type->id, $data->id, date('Y-m-d')));
      Document::where('id', $data->id)->update(['consecutivo' => $consecutive[0]->consecutivo]);
      return $data;
    } catch (Exception $e) {
        $answer = array(
            "error" => $e,
            "code"  => 600,
        );
        return $answer;
    }
  }

  public function saveDetail($detail, $document_id, $type)
  {
    try {
      foreach ($detail as $key) {
        $data[] = DocumentDetail::create([
          'documento_id' => $document_id,
          'producto_id' => $key['id'],
          'descripcion' => $key['producto'],
          'transaccion' => $type->id_transaccion,
          'bodega_id' => Auth::user()->sucursal_id,
          'cantidad' => $key['cantidad'],
          'cant_final' => $this->getQuantityFinal($key['cantidad'], $type->id_transaccion, 0),
          'precio' => $key['precio'],
          'costo' => $this->getCost($type->genera_utilidad, $key['precio']),
          'venta' => $this->getPrice($key['precio'],$type),
          'total_desto' => $key['id'],
          'total_costo' => $this->getTotalCost($type, $key),
          'total_venta' => ($type->genera_utilidad == 0) ? 0 : $key['cantidad'] * $key['precio'],
          'descuento' => $key['descuento'],
          'iva' => $key['iva']
          // 'doc_cruce' => $key['id'],
          // 'fecha_recibido' => $key['id'],
          // 'id_cruce' => $key['id'],
        ]);
      }
      return true;
    } catch (Exception $e) {
      $answer = array(
          "error" => $e,
          "code"  => 600,
      );
      return $answer;
    }

  }

  public function getQuantityFinal($quantity, $transaction, $return)
  {
    $answer = 0;
    if ($return != '1') {
      if($transaction != '0'){
        $answer = ($transaction == 1) ? $quantity : -$quantity;
      }
    }
    return $answer;
  }

  public function getPrice($price, $type)
  {
    $answer = $price;
    if ($type->genera_utilidad != 0) {
      if ($type->id == 5) { // El id 5 es Nota crédito
        $answer = $price * (-1);
      }
    }else {
      $answer = 0;
    }
    return $answer;
  }

  public function getCost($utility, $price)
  {
    return ($utility == 0) ? $price : 0;
  }

  public function getTotalCost($type, $data)
  {
    $cost = $this->getCost($type->genera_utilidad, $data['precio']);
    $quantityFinal = $this->getQuantityFinal($data['cantidad'], $type->id_transaccion, 0);
    $answer = $quantityFinal *  $cost;
    if ($type->genera_utilidad == 0) {
        if($type->usa_cuadre == 1){
            $answer = $data['cantidad'] * $cost;
            if($type->ingreso_egreso != 0){
              $answer = -($data['cantidad'] * $cost);
            }
        }
    }
    return $answer;
  }

  public function getType($id)
  {
    return Type::where('tiendas', $id)->first();
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
