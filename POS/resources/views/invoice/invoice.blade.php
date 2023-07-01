@extends('layouts.app')
<link rel="stylesheet" href="{{asset('assets/css/invoice.css')}}">
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
<!-- Modal -->
<div class="modal fade" id="saveTransac" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Invoice for <span class="text-primary">{{$customer->customer_name}}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/add-transaction')}}" method="POST">
      <div class="modal-body">
      <div class="card-body">
                    @csrf
                    <div class="modal-body">
                        <div class="tot">
                            <h1>Total: <span id="total_amount" style="margin-left: 10px;"> {{Cart::total()}}</span></h1>
                        </div>
                        <br>
                    <label>Payment Method:</label>
                                    <div class="payMethod">
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" value="Cash" required>
                                            <div class="radio-tile">
                                            <i class="fa-solid fa-peso-sign icon"></i>
                                            <div>
                                                <label>Cash</label>
                                            </div>
                                            </div>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" value="Card" required>
                                            <div class="radio-tile">
                                            <i class="fa-solid fa-credit-card icon"></i>
                                            <div>
                                                <label>Card</label>
                                            </div>
                                            </div>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" value="Gcash" required>
                                            <div class="radio-tile">
                                            <i class="fa-solid fa-g icon"></i>
                                            <div>
                                                <label>Gcash</label>
                                            </div>
                                            </div>
                                        </span>
                                    </div>
                                    <!--End Payment Method-->
                                    <br>
                                    <div class="tenderedAmount">
                                        <div class="form-group" style="width: 200px;">
                                            <label>Tendered Amount</label>
                                            <input type="number" class="form-control" name="paid_amount" id="paid_amount" required>
                                        </div>
                                        <div class="form-group" style="width: 200px; margin-left: 20px;">
                                            <label>Change</label>
                                            <input id="change" class="form-control" readonly></input>
                                        </div>
                                        <span id="cantExceed" style="visibility: hidden; color: red;">*Paid Amount cannot be lower than Total Amount</span>
                                    </div>
                    </div>
                </div>
      </div>
      <input type="hidden" name="customer_id" value="{{$customer->id}}">
      <input type="hidden" name="customer_name" value="{{$customer->customer_name}}">
      <input type="hidden" name="order_date" value="{{date('d/m/y')}}">
      <input type="hidden" name="order_status" value="Paid">
      <input type="hidden" name="total_products" value="{{Cart::count()}}">
      <input type="hidden" name="sub_total" value="{{Cart::subtotal()}}">
      <input type="hidden" name="tax" value="{{Cart::tax()}}">
      <input type="hidden" name="total" value="{{Cart::total()}}">

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Save Transaction</button>
      </div>
      </form>
    </div>
  </div>
</div>


 <!--receipt start-->
 <div class="all">
<div class="card">
    <br>
 <div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: 
            </small>
        </h1>

    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <span class="text-default-d3">Vape Central Ph</span>
                            <div class="text-grey-m2">
                                <div style="font-size: 15px;"> <b class="text-sm">31 Matino, Diliman, Lungsod Quezon, Kalakhang Maynila</b></div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{$customer->customer_name}}</span>
                        </div>
                        <br>
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Email:</span>
                            <div class="text-grey-m2">
                                <div class="my-1"><i class="fa-solid fa-envelope"></i> <b class="text-600">{{$customer->customer_email}}</b></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID: </span> {{$customer->id}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{date('d/m/y')}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-danger badge-pill px-25">Pending</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

              

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>
                        @php
                            $sl=1;
                        @endphp
                    <tbody class="text-95 text-secondary-d3">
                        @foreach($content as $cont)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$cont->name}}</td>
                                <td>{{$cont->qty}}</td>
                                <td><i class="fa-solid fa-peso-sign"></i> {{$cont->price}}</td>
                                <td><i class="fa-solid fa-peso-sign"></i> {{$cont->price*$cont->qty}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            Extra note such as company or payment information...
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">{{Cart::subtotal();}}</span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax 
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">{{Cart::tax()}}</span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2" id="total">{{Cart::total()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
             
                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#saveTransac">Confirm Transaction</button>
                        <a href="{{ route('pos') }}" class="btn btn-danger float-right" style="position: relative; right: 20px;">Cancel</a>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

</div>

</div>


@endsection

@section('script')
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
   <script>
        $(document).ready(function(){
            $('#save').on('click', function(){
                var totalAmount = parseFloat($('#total_amount').text().replace(/,/g, ''));
                var paidAmount = parseFloat($('#paid_amount').val());

                if(paidAmount < totalAmount)
                {
                    $('#cantExceed').css('visibility', 'visible');
                    setTimeout(() => {
                        $('#cantExceed').css('visibility', 'hidden');
                    }, 5000);
                    return false;
                }
            })
            $('#paid_amount, #total_amount').keyup(function(){
                var total = 0;
                var x = Number($('#paid_amount').val());
                var y = Number($('#total_amount').text().replace(/,/g, ''));
                var total = x - y;

                $('#change').val(total);
            })
        })
   </script>
@endsection