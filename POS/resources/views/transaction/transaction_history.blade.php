@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<div class="head">
    <p style="position: absolute; bottom: 20px;">Transaction History</p>
</div>
<link rel="stylesheet" href="{{asset('assets/css/transaction.css')}}">
<!--DATA TABLE START -->
<div class="col-md-10">
    <div class="card">
      <div class="card-body">
        <table id="dtBasicExample" class="table  table-sm" cellspacing="0" width="100%">
          <thead class="bg-gradient bg-light ">
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Transaction Code</th>
              <th class="th-sm">Customer Name</th>
              <th class="th-sm">Customer ID</th>
              <th class="th-sm">Ordered Date/Time</th>
              <th class="th-sm">Total Products</th>
              <th class="th-sm">Payment Method</th>
              <th class="th-sm">Paid Amount</th>
              <th class="th-sm">Total Amount</th>
              <th class="th-sm">Order Status</th>
              <th class="th-sm" style="width: 150px;">Receipt</th>
            </tr>
          </thead>
          <tbody>
              @foreach($orders as $history)
                <tr>
                   <td>{{$history->id}}</td>
                   <td>{{$history->transaction_code}}</td>
                   <td>{{$history->customer_name}}</td>
                   <td>{{$history->customer_id}}</td>
                   <td>{{$history->order_date}}</td>
                   <td>{{$history->total_products}}</td>
                   <td>{{$history->payment_method}}</td>
                   <td><i class="fa-solid fa-peso-sign"></i> {{$history->paid_amount}}</td>
                   <td><i class="fa-solid fa-peso-sign"></i> {{$history->total}}</td>
                   <td><span class="badge badge-success">{{$history->order_status}}</span></td>
                   
                   <td>
                        <a href="{{ URL::to('/view-receipt/'.$history->id) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i> View Receipt</a>
                   </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      
    </div>
</div>
<footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6 pt">
                        Project Management &copy; POS System
                    </div>
                    <div class="col-sm-6 text-right">
                        Created By Project Team
                    </div>
                </div>
            </div>
        </footer>
@endsection
@section('script')
<!--SCRIPT FOR DATA TABLES -->
<script>
      $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
<!--SCRIPT FOR DATA TABLES END -->
<!--SCRIPT FOR SIDEBAR EXTENDS -->
<script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').toggleClass('show');
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     //$('.menu-btn').click(function(){
       //$(this).toggleClass('click');
       //$('.side-bar').toggleClass('show');
    // });
   });
  </script>
<!--SCRIPT FOR SIDEBAR EXTENDS ENDS-->
@endsection