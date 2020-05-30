<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookOnline;
use App\Models\BookRoom;
use App\Models\ConfigRoom;
use App\Models\Customer;
use App\Models\Floor;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\Service;
use App\Models\Store;
use App\Models\TypeRoom;
use Carbon\Carbon;
use CustomerSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use stdClass;

class RoomController extends Controller
{
    public function index()
    {
        //================ Get all room ==================/
        $rooms = new Collection();
        $lastConfigRoom = ConfigRoom::latest()->first();
        if ($lastConfigRoom != null) {

            $countAllRoom   = Room::all()->count();
            $offsetRoom     = $lastConfigRoom->so_phong;
            $rooms          = Room::skip($countAllRoom - $offsetRoom)->take($offsetRoom)->get();
        }

        return view('admin.room.index', ["rooms" => $rooms]);
    }

    public function show($id)
    {


        $room = Room::find($id);

        //================ Get all product  ==================/

        $products = Store::all();

        //=============== Custom status   ===================/

        switch (strtolower($room->trang_thai)) {

            case 'empty':
                $status = "success";
                $statusInfo = "đang trống";
                break;
            case 'maintenance':
                $status = "danger";
                $statusInfo = "bảo trì";
                break;
            case 'full':
                $status = "info";
                $statusInfo = "Nguyễn Văn A";
                break;
            case 'fulltime':
                $status = "warning";
                $statusInfo = "Hết giờ";
                break;

            default:
                break;
        }


        //================ Get room status full ==================/

        $bookRoom = new stdClass();
        $bookRoom->thoi_gian_ket_thuc  = null;

        //=============== Get list service by room ===================/

        $listServices = DB::select("select cua_hang.ten_mat_hang , cua_hang.don_gia as don_gia, sum(dich_vu.so_luong) as so_luong
                            from phong 
                            join dich_vu 
                            on dich_vu.phong_id = phong.id 
                            join cua_hang
                            on cua_hang.id = dich_vu.mat_hang_id
                            where phong.id = $id and ( trang_thai = 'full' or trang_thai = 'fulltime' ) and dich_vu.trang_thai_dv = 0
                            group by cua_hang.ten_mat_hang, cua_hang.don_gia
                        ");
        $roomEmpty = Room::where('trang_thai', 'empty')->get();

        if ($room->trang_thai == 'full'  ||  $room->trang_thai == 'fulltime') {

            $bookRoom   = $room->bookRoom->last();
            $customer   = Customer::find($bookRoom->khach_hang_id);
            $statusInfo = $customer->ho_ten;
            $status     =  $room->trang_thai == 'full' ? "info" : 'warning';



            return view('admin.room.detail', ["room" => $room, 'status' => $status, "statusInfo" => $statusInfo, 'customer' => $customer, 'bookRoom' => $bookRoom, 'products' => $products, 'listServices' => $listServices, 'roomEmpty' => $roomEmpty]);
        }


        return view('admin.room.detail', ["room" => $room, 'status' => $status, "statusInfo" => $statusInfo, 'bookRoom' => $bookRoom, 'products' => $products, 'listServices' => $listServices, 'roomEmpty' => $roomEmpty]);
    }

    public function roomUpdate(Request $request, $id)
    {
        $room = Room::find($id);

        //================ Update status room =================//

        if ($request->trang_thai != "full") {
            $room->trang_thai = $request->trang_thai;
            $room->save();
            return Redirect::back();
        }

        //================ Add customer   =================//

        $request->validate(
            [
                'ho_ten'        => 'required|max:255',
                'so_dien_thoai' => 'required|regex:/[0-9]{9,15}/',
                'so_cmnd'       => 'required',
            ],
            [
                'ho_ten.required'        => 'Vui lòng nhập tên khách hàng',
                'ho_ten.max'             => 'Tên khách hàng quá dài',
                'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại',
                'so_dien_thoai.regex'    => 'Số điện thoại không đúng định dạng',
                'so_cmnd.required'       => 'Vui lòng nhập số CMND',
            ]
        );

        $customer = Customer::where('so_cmnd', $request->so_cmnd)->first();
        if ($customer == null) {
            $customer =  Customer::create(
                [
                'so_cmnd' => $request->so_cmnd,
                    'ho_ten' => $request->ho_ten,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'so_lan_dat_phong' => 1
                ]
            );
        } else {
            $customer->so_lan_dat_phong += 1;
            $customer->save();
        }


        //================ Add Book room  =================//

        $room = Room::find($id);
        $room->trang_thai = "full";
        $room->loai_phong_id  = $request->loai_phong_id;
        $room->save();

        BookRoom::create(
            [
                'phong_id' => $id,
                'khach_hang_id' => $customer->id,
                'thoi_gian_dat' => $request->thoi_gian_dat,
                'thoi_gian_ket_thuc' =>  Carbon::now()->add($request->thoi_gian_dat, 'hourd'),
                'ghi_chu' =>  $request->ghi_chu
            ]
        );

        //================ Add Order    =================//

        Order::create(
            [
                'trang_thai' => 0,
                'tong_tien'  =>  Room::find($id)->TypeRoom->gia_phong,
                'phong_id' => $id,
                'khach_hang_id' => $customer->id,
                'user_id' => Auth::user()->id
            ]
        );

        //=============== Storing Session ===============//


        return redirect()->back();
    }

    public function addService(Request $request, $id)
    {

        Service::create([
            'mat_hang_id' => $request->mat_hang_id,
            'phong_id'    => $id,
            'so_luong'    => $request->so_luong
        ]);

        $product = Store::find($request->mat_hang_id);


        $listServices = DB::select("select cua_hang.ten_mat_hang , cua_hang.don_gia as don_gia, sum(dich_vu.so_luong) as so_luong
                                from phong 
                                join dich_vu 
                                on dich_vu.phong_id = phong.id 
                                join cua_hang
                                on cua_hang.id = dich_vu.mat_hang_id
                                where phong.id = $id and ( trang_thai = 'full' or trang_thai = 'fulltime' ) and dich_vu.trang_thai_dv = 0
                                group by cua_hang.ten_mat_hang, cua_hang.don_gia");

        return response()->json([
            'service' => [
                'mat_hang_id'  => $request->mat_hang_id,
                'phong_id'     => $id,
                'ten_mat_hang' => $product->ten_mat_hang,
                'so_luong'     => $request->so_luong,
                'don_gia'      => $product->don_gia
            ],
            'listServices' => $listServices,
            'message' => 'Đã thêm dịch vụ .'
        ]);
    }

    public function checkOut(Request $request)
    { 
        $now = Carbon::now();
        $timeStart = BookRoom::where('phong_id', $request->roomId)->get()->last()->created_at;
        $d =  $now->diff($timeStart)->format('%D');
        $h =  $now->diff($timeStart)->format('%H');
        $i =  $now->diff($timeStart)->format('%I');
    
        $totalHourd = ( $d * 24 * 60 + $h * 60  + $i ) / 60;   
        $room = Room::find($request->roomId);
        $order = Order::where('phong_id', $request->roomId)->get()->last();
        $roomPrice = round($order->tong_tien * $totalHourd);
        $amount = round($order->tong_tien * $totalHourd);
        $services = Service::where('phong_id', '=', $request->roomId)->where('trang_thai_dv', '=', 0)->get();
        if (!$services->isEmpty()) {
            foreach ($services as $service) {

                OrderDetail::create([
                    'hoa_don_id'  => $order->id,
                    'mat_hang_id' => $service->mat_hang_id,
                    'so_luong'    => $service->so_luong,
                    'don_gia'     => $service->product->don_gia,
                    'thanh_tien'  => $service->product->don_gia * $service->so_luong,
                ]);

                $amount +=  $service->product->don_gia * $service->so_luong;

                $service->trang_thai_dv = 1;
                $service->save();
            }
        }

        $order->tong_tien = $amount;



        $order->save();

        $room->trang_thai = 'maintenance';
        $room->save();

        $orderDetails = DB::table('chi_tiet_hoa_don')
            ->join('cua_hang', 'cua_hang.id', '=', 'chi_tiet_hoa_don.mat_hang_id')
            ->where('hoa_don_id', $order->id)
            ->select('chi_tiet_hoa_don.*', 'cua_hang.ten_mat_hang')
            ->get();

        return response()->json(['orderDetails' => $orderDetails, 'amount' => $amount, 'roomPrice' => $roomPrice , 'id' => $order->id ]);
    }




    public function getMap()
    {

        return view('admin.room.get_map');
    }

    public function viewSetting()
    {

        /*=================================
           Cấu hình view
          =================================*/

        // $rooms =  Room::where("ma_phong","LIKE","%Px - 50%")->get();
        $config = ConfigRoom::latest()->first();
        $floor = Floor::all();
        return view('admin.room.setting', ['config' => $config, 'floor' => $floor]);
    }
    public function setting(Request $request)
    {

        /*=================================
           Cấu hình phòng create - update
          =================================*/

        $request->validate(
            [
                'so_tang'  => 'required|numeric|min:1|max:30',
                'so_phong' => 'required|numeric|min:1|max:300',
                'ma_phong' => 'required|max:30|min:2',
            ],
            [
                'so_tang.required'  => 'Vui lòng nhập số tầng',
                'so_tang.numeric'   => 'Số tầng không đúng định dạng',
                'so_tang.min'       => 'Số tầng phải lớn hơn 0',
                'so_tang.max'       => 'Số tầng phải nhỏ hơn 30',
                'so_phong.required' => 'Vui lòng nhập số phòng',
                'so_phong.numeric'  => 'Số phòng không đúng định dạng',
                'so_phong.min'      => 'Số phòng phải lớn hơn 0',
                'so_phong.max'      => 'Số phòng phải nhỏ hơn 300',
                'ma_phong.required' => 'Vui lòng nhập mã phòng',
                'ma_phong.max'      => 'Mã phòng quá dài',
                'ma_phong.min'      => 'Mã phòng quá ngắn',
            ]
        );


        //============ Thiết lập phòng ============//

        if ($request->so_tang > $request->so_phong) {
            return Redirect::back()->withErrors('Số phòng phải lớn hơn số tầng');
        }

        $config = ConfigRoom::updateOrCreate([

            "so_phong" => $request->so_phong,
            "so_tang" => $request->so_tang,
            "ma_phong" => $request->ma_phong,
        ]);

        //============ Thiệt lập tầng ============//


        if ($config) {

            DB::table('tang')->delete();

            for ($i = 1; $i <= $request->so_tang; $i++) {
                Floor::create(["ten_tang" => $i, "so_phong" => floor($request->so_phong / $request->so_tang)]);
            }
        }

        return Redirect::Back();
    }

    public function configFloor(Request $request)
    {

        DB::table('tang')->delete();
        for ($i = 1; $i <= count($request->so_tang); $i++) {
            Floor::create(["ten_tang" => $i, "so_phong" => $request->so_tang[$i - 1]]);
        }

        $lastConfigRoom = ConfigRoom::latest()->first();

        if ($lastConfigRoom->so_phong === Floor::all()->sum('so_phong')) {

            $keyRoom = $lastConfigRoom->ma_phong;
            $floors = Floor::all();

            //============== Add all room ==============/ 

            // DB::table('phong')->delete();

            $numberFloor = 1;

            foreach ($floors as $floor) {
                $i = 1;
                while ($floor->so_phong >= $i) {
                    $keyOfRoom = "$keyRoom - " . $numberFloor . 0 . $i;
                    Room::create(["ma_phong" => $keyOfRoom, "trang_thai" => "Empty", "loai_phong_id" => 2]);
                    $i++;
                }

                $numberFloor++;
            }
            return Redirect::Back()->with('success', 'Thiết lập thành công !');
        };
        return Redirect::back()->withErrors(['msg' => 'Vui lòng thiết lập lại số phòng !']);
    }

    public function ReplaceRoom(Request $request)
    {
        //================ Add Book room  =================//

        $roomNew = Room::find($request->roomNew);
        $roomOld = Room::find($request->roomOld);
        $roomNew->trang_thai = "full";
        $roomOld->trang_thai = "empty";
        $roomNew->loai_phong_id  =   $roomOld->loai_phong_id;
        $roomNew->save();
        $roomOld->save();


        $bookRoom = BookRoom::where('phong_id', $roomOld->id)->get()->last();
        $bookRoom->phong_id = $roomNew->id;
        $bookRoom->save();

        //================ Add Order    =================//

        $order = Order::where('phong_id', $roomOld->id)->get()->last();
        $order->phong_id = $roomNew->id;
        $order->save();

        $services = Service::where('phong_id', $roomOld->id)->get()->last();
        if ($services != null) {

            $services->phong_id = $roomNew->id;
            $services->save();
        }

        return redirect()->route('room.detail', $roomNew->id);
    }

    public function listBook(){
        $list = BookOnline::orderBy('id','desc')->paginate(10);
        return view('admin.room.listbook',['list' => $list]);
    }
    public function bookDetail($id){

        $book = BookOnline::find($id);
        $rooms = Room::all();
        return view('admin.room.bookdetail',['book' => $book,'rooms' => $rooms]);
    }

    public function bookDetailUpdate(Request $request ,$id){

        $book = BookOnline::find($id);
        $book->phong_id = $request->phong_id;
        $book->trang_thai = 1;
        $book->save();

        return redirect()->back()->with('bookUpdate' , 'Thiết lập thành công');
    }
}
