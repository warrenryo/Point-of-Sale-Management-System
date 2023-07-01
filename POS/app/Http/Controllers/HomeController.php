<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = DB::table('products')->count();
        $total = DB::table('order_details')->sum('total');
        $customer = DB::table('customers')->count();
        $order_count = DB::table('orders')->count();
        $orders = DB::table('orders')->get();
        return view('home',compact('orders','order_count','customer','total','product'));
    }

    public function viewAbout()
    {
        return view('about.about_index');
    }
}
