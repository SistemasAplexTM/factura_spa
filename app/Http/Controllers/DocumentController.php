<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Cupons;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
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
