<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use App\Models\Orders;
use App\Models\Products;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->quantity;
        $data['price'] = $request->price;

        $add = Cart::add($data);
        if($add){
            return redirect()->back()->with('success', 'Product Added to Cart');
        }else{
            return redirect()->back();
        }
    }

    public function updateCart(Request $request, $rowId)
    {
        $updateQty= $request->qty;
        $update = Cart::update($rowId,$updateQty);
        if($update){
            return redirect()->back()->with('success', 'Cart Updated');
        }else{
            return redirect()->back();
        }

    }

    public function deleteCart($rowId)
    {
        $delete = Cart::remove($rowId);
        return redirect()->back()->with('success', 'Product Removed');
    }

    public function deleteAll()
    {
        $delete = Cart::destroy();
        return redirect()->back()->with('success', 'Cart Deleted');
    }

    public function createInvoice(Request $request)
    {
        

        $validateData = $request->validate([
            'customer_id' => 'required',
        ]);
        $customer_id = $request->customer_id;
        $customer = DB::table('customers')->where('id', $customer_id)->first();
        $content = Cart::content();
        return view('invoice.invoice', compact('customer','content'));
    }

    public function addTransaction(Request $request)
    {

        $number = mt_rand(100000000,999999999);
        if($this->transactionCodeExists($number)){
            $number = mt_rand(100000000,999999999);
        }
        
        //ORDERS FUNCTION
        $data = array();
        $data['transaction_code'] = $number;
        $data['customer_name'] = $request->customer_name;
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['tax'] = $request->tax;
        $data['total'] = $request->total;
        $data['payment_method'] = $request->payment_method;
        $data['paid_amount'] = $request->paid_amount;

        //GET THE ORDERS ID
        $order_id = DB::table('orders')->insertGetId($data);
        $contents = Cart::content();

        //ORDER DETAILS FUNCTION
        $orderDetails = array();
        foreach($contents as $content){
            $orderDetails['order_id'] = $order_id;
            $orderDetails['product_id'] = $content->id;
            $orderDetails['quantity'] = $content->qty;
            $orderDetails['unit_price'] = $content->price;
            $orderDetails['total'] = $content->total;

            $insertData = DB::table('order_details')->insert($orderDetails);
            
        } 
        if($insertData){
            $ord = OrderDetails::where('order_id', $order_id)->get();
            foreach ($ord as $item ) {
                $prod = Products::where('id', $item->product_id)->first();
                $prod->quantity = $prod->quantity - $item->quantity;
                $prod->update();
            }
            Cart::destroy();
            Alert::success('Transaction Completed', '');
            return redirect()->route('pos');
        }
    }
    public function transactionCodeExists($number){
        return Orders::whereTransactionCode($number)->exists();
    }
}
