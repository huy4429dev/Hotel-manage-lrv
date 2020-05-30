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

        $data_thu = [];
        $i = 1;
        while($i <= 12){
          $data_thu[] = 0;
          $i ++;
        }

        foreach($data_thu as $key => $value){
          foreach($data as $item){
              if($key == substr($item->monthyear,0,strpos($item->monthyear,'-') )){
                  $data_thu[$key - 1] =  $item->tongtien; 
                }
            }
        }

        $data_chi = [
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
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

            $data_thu = [];
            $i = 1;
            while($i <= 12){
              $data_thu[] = 0;
              $i ++;
            }
    
            foreach($data_thu as $key => $value){
              foreach($data as $item){
                  if($key == substr($item->monthyear,0,strpos($item->monthyear,'-') )){
                      $data_thu[$key - 1] =  $item->tongtien; 
                    }
                }
            }

        $data_chi = [
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
        ];

        return response(['data' => [$data_chi ,$data_thu]]);
    }
}
