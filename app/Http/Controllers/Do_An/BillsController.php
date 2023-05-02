<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BillsController extends Controller
{
    public function index()
    {
        
        $this->data['title'] = 'Quản lý hóa đơn';
        $customers = DB::table('customers')
                    ->orderBy('id', 'desc')
                   
                    ->get();
                  
        $this->data['customers'] = $customers;
        
        return view('admin.bill.index', $this->data);
    }
    public function edit($id)
    {

        $customerInfo = DB::table('customers')
                        ->join('bills', 'customers.id', '=', 'bills.customer_id')
                        ->select('customers.*', 'bills.id as bill_id', 'bills.total as bill_total', 'bills.note as bill_note')
                        ->where('customers.id', '=', $id)
                        ->first();

        $billInfo = DB::table('bills')
                    ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
                    ->leftjoin('products', 'bill_details.product_id', '=', 'products.id')
                    ->where('bills.customer_id', '=', $id)
                    ->select('bills.*', 'bill_details.*', 'products.name as product_name')
                    ->get();
                    
        $this->data['customerInfo'] = $customerInfo;
        $this->data['billInfo'] = $billInfo;

        return view('admin.bill.edit', $this->data);
    }
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);
        $bill->save();
        Session::flash('message', "Cập nhật thành công");

        return redirect('admin/bill');
    }
    public function destroy($id)
    {
    
        $bill = Customer::find($id);

    if ($bill != null) {
        $bill->delete();
        return redirect()->route('bill.index')->with(['message'=> 'Đã xóa thành công']);
    }

    return redirect()->route('bill.index')->with(['message'=> 'Xóa thất bại']);
    }

}
