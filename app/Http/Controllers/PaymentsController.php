<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payments;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use App\Http\Controllers\Tables\Builders\PaymentsTable;

class PaymentsController extends Controller
{
    use Datatable;

    protected $tableClass = PaymentsTable::class;
}
