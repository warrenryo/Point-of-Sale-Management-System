@extends('layouts.app')

<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/list_customer.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">Customers Lists</p>
</div>
<!--DATA TABLE START -->
<div class="all">
    <div class="card">
      <div class="card-body">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Name </th>
              <th class="th-sm">Email</th>
            </tr>
          </thead>
          <tbody>
                @foreach($customer as $cus)
                    <tr>
                        <td>{{$cus->id}}</td>
                        <td>{{$cus->customer_name}}</td>
                        <td>{{$cus->customer_email}}</td>
                    </tr>
                @endforeach
          </tbody>
        </table>
      </div>
      
    </div>
</div>
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