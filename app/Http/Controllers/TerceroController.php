<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tercero;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use App\Http\Controllers\Tables\Builders\TerceroTable;
use Illuminate\Support\Facades\DB;

class TerceroController extends Controller
{
    use Datatable;

    protected $tableClass = TerceroTable::class;

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            Tercero::create($request->all());
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
            Tercero::where('id', $request->id)->update($request->all());
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
            $data = Tercero::findOrFail($request->id);
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

    public function terceroById($id){
        $data = Tercero::findOrFail($id);
        return $data;
    }

    public function terceroSearch($data, $type){
        $answer = Tercero::where($type, 1)->where('nombre', 'LIKE', '%' . $data . '%')->orWhere('documento', 'LIKE', $data . '%')->get();
        return array( 'data' => $answer );
    }
}
