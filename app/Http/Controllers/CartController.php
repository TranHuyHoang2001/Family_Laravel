<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\DetailBill;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cart(Request $request)
    {
   
        return view('frontend.cart');
        
    }
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        // return $product;
        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'options'=>['image'=>$product->image]
          ]
        );
        // echo"<pre>";
        // print_r(Cart::Content());
        // echo"</pre>";
        return redirect('cart');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('cart');
    }

    public function destroy()
    {
        Cart::destroy();      
        return redirect('cart');
    }


    public function update(Request $request)
    {
        $data = $request->get('qty');
        foreach($data as $k=>$v)
        {
            Cart::update($k, $v);
        }
        return redirect('cart');
    }

    public function order()
    {
        return view('frontend.checkout');
    }
    public function complete()
    {
        return view('frontend.complete_orders');
    }

    public function getCheckout() {
        $this->data['title'] = 'Check out';
        $this->data['cart'] = Cart::content();
        $this->data['total'] = Cart::total();
        return view('frontend.checkout', $this->data);
    }

    public function postCheckout(Request $request) {
        $cartInfor = Cart::content();   
        $request->validate(
            [
                'fullname' => 'required|min:3',
                'phone' => 'required|digits_between:10,12',
                'email' => 'required|email',
                'address' => 'required|min:5'

            ],
            [
                'required' => ':attribute không được để trống',
                'alpha' => ':attribute chỉ chứa ký tự chữ',
                'min' => ':attribute có ít nhất :min ký tự',
                'digits_between' => ':attribute chỉ chứa số và phải nhập 10 số',
                'email' => ':attribute phải có định dạng email'
            ],
            [
                'fullname' => 'Họ tên',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'address' => 'Địa chỉ'
            ]
        );

        try {
            // save
            $customer = new Customer;
            $customer->fullname = $request->fullname;
            $customer->email =$request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->note = $request->note;
            $customer->save();

            $bill = new Bill;
            $bill->customer_id = $customer->id;
            $bill->date_order = date('Y-m-d H:i:s');
            $bill->total = Cart::total();
            $bill->note = $request->note;
            $bill->save();
            

            
            if (count($cartInfor) >0) {
                foreach ($cartInfor as $key => $item) {
                    $billDetail = new DetailBill();
                    $billDetail->bill_id = $bill->id;
                    $billDetail->product_id = $item->id;
                    $billDetail->quantily = $item->qty;
                    $billDetail->price = $item->price;
                    $billDetail->save();
                }
          // del
           Cart::destroy();
            
        } 
       return redirect('complete');

       
    }
        catch (\Exception $exception) {
            echo $exception->getMessage();
        
    }
}
}
