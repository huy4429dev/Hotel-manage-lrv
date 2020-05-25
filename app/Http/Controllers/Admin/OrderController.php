<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index', ['orders' => $orders]);
    }

    public function detail($id)
    {

        $order = Order::find($id);
        return view('admin.order.detail', ['order' => $order]);
    }

    public function group()
    {
        $data = Order::select(DB::raw('count(id) as `data`'), DB::raw('sum(tong_tien) as `tongtien`'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
        ->whereRaw(DB::raw('YEAR(created_at) = 2020' ))
        ->groupBy('monthyear')
        ->orderBy('monthyear', 'asc')
        ->get();

        $data_thu = [
            ($data[0]->tongtien ?? 0) / 1000000,
            ($data[1]->tongtien ?? 0) / 1000000,
            ($data[2]->tongtien ?? 0) / 1000000,
            ($data[3]->tongtien ?? 0) / 1000000,
            ($data[4]->tongtien ?? 0) / 1000000,
            ($data[5]->tongtien ?? 0) / 1000000,
            ($data[6]->tongtien ?? 0) / 1000000,
            ($data[7]->tongtien ?? 0) / 1000000,
            ($data[8]->tongtien ?? 0) / 1000000,
            ($data[9]->tongtien ?? 0) / 1000000,
            ($data[10]->tongtien ?? 0) / 1000000,
            ($data[11]->tongtien ?? 0) / 1000000,
            ($data[12]->tongtien ?? 0) / 1000000,
        ];

        $data_chi = [
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
        ];
        return view('admin.order.group', ['data' => [$data_chi, $data_thu]]);
    }

    public function groupPost(Request $request)
    {

        $data = Order::select(DB::raw('count(id) as `data`'), DB::raw('sum(tong_tien) as `tongtien`'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
            ->whereRaw(DB::raw('YEAR(created_at) = '.$request->groupYear ))
            ->groupBy('monthyear')
            ->orderBy('monthyear', 'asc')
            ->get();


        $data_thu = [
            ($data[0]->tongtien ?? 0) / 1000000,
            ($data[1]->tongtien ?? 0) / 1000000,
            ($data[2]->tongtien ?? 0) / 1000000,
            ($data[3]->tongtien ?? 0) / 1000000,
            ($data[4]->tongtien ?? 0) / 1000000,
            ($data[5]->tongtien ?? 0) / 1000000,
            ($data[6]->tongtien ?? 0) / 1000000,
            ($data[7]->tongtien ?? 0) / 1000000,
            ($data[8]->tongtien ?? 0) / 1000000,
            ($data[9]->tongtien ?? 0) / 1000000,
            ($data[10]->tongtien ?? 0) / 1000000,
            ($data[11]->tongtien ?? 0) / 1000000,
            ($data[12]->tongtien ?? 0) / 1000000,
        ];

        $data_chi = [
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
            rand(1000000, 100000000) / 1000000,
        ];

        return response(['data' => [$data_chi ,$data_thu]]);
    }
}
