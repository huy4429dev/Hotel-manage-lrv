<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderByDesc('id')->get();
        return view('admin.customer.index', ['customers' => $customers]);
    }

    public function detail($id)
    {
        $customer = Customer::find($id);

        if ($customer != null) {

            return view('admin.customer.detail', ['customer' => $customer]);
        }

        return redirect()->back()->with('error', 'Khách hàng không tồn tại');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);

        if ($customer != null) {
            $customer->delete();
            return redirect()->back()->with('success', 'Xóa Khách hàng thành công');
        }

        return redirect()->back()->with('error', 'Khách hàng không tồn tại');
    }
}
