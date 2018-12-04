<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cupons;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use App\Http\Controllers\Tables\Builders\CuponsTable;
use Illuminate\Support\Facades\DB;

class CuponsController extends Controller
{
    use Datatable;

    protected $tableClass = CuponsTable::class;

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            Cupons::create($request->all());
            $answer = array(
                "datos"  => '',
                "code"   => 200
            );
            DB::commit();
            return $answer;
        } catch (\Exception $e) {
            DB::rollback();
            $answer = array(
                "error" => $e,
                "code"  => 600,
            );
            return $answer;
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            Cupons::where('id', $request->id)->update($request->all());
            $answer = array(
                "datos"  => '',
                "code"   => 200
            );
            DB::commit();
            return $answer;
        } catch (\Exception $e) {
            DB::rollback();
            $answer = array(
                "error" => $e,
                "code"  => 600,
            );
            return $answer;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Cupons::findOrFail($request->id);
            if ($data->delete()) {
                // $this->AddToLog('Registro de tabla admin eliminada (id :'.$data->id.')');
                $answer = array(
                    "code" => 200,
                );
            }
            return $answer;
        } catch (\Exception $e) {
            $answer = array(
                "error" => $e,
                "code"  => 600,
            );
            return $answer;
        }
    }

    public function paymentById($id){
        $data = Cupons::findOrFail($id);
        return $data;
    }
}
