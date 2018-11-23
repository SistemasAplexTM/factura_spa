<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payments;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use App\Http\Controllers\Tables\Builders\PaymentsTable;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    use Datatable;

    protected $tableClass = PaymentsTable::class;

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            Payments::create($request->all());
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
            Payments::where('id', $request->id)->update($request->all());
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
}
