<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    function export(Request $request)
    {
        return Excel::download(new OrderExport($request->orderId), 'orders-'.time().'.xlsx');
    }

}