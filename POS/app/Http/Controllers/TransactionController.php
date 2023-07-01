<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->get();
        return view('transaction.transaction_history',compact('orders'));
    }

    public function viewReceipt($id)
    {
    
        $orders = DB::table('orders')
                    ->join('customers','orders.customer_id','customers.id')
                    ->where('orders.id', $id)
                    ->first();

        $order_details = DB::table('order_details')
                    ->join('products','order_details.product_id','products.id')
                    ->select('order_details.*','products.product_name','products.product_code','products.brand')
                    ->where('order_id', $id)
                    ->get();
            
        return view('transaction.view_receipt',compact('orders','order_details'));
    }
}
