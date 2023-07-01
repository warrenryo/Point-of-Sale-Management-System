@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('assets/css/pos_index.css')}}">
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/add-customer')}}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="card-body">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>Customer Name</label>
                            <input type="text "class="form-control" name="customer_name"  placeholder="Enter Customer Name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="customer_email"   placeholder="Enter Customer Email">
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        
    </div>
    <div class="row" style="width: 1920px;">
        <div class="product_index">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="title">
                        <p>Products</p>
                    </div>
                    
                </div>
                <div class="card-body">
                    <table id="dtBasicExample" class="table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead class="bg-gradient">
                            <tr>
                            <th class="th-sm"  style="width: 5px;">ID</th>
                            <th class="th-sm">Product Image</th>
                            <th class="th-sm">Product Name</th>
                            <th class="th-sm">Product Code</th>
                            <th class="th-sm">Brand</th>
                            <th class="th-sm">Price</th>
                            <th class="th-sm">Stocks</th>
                            <th class="th-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="add">
                            @foreach($products as $product)
                                <tr>
                                    <form action="{{ url('/add-cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="hidden" name="name" value="{{$product->product_name}} - {{$product->brand}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price" value="{{$product->price}}">
                                        <td style="text-align: center;">{{$product->id}}</td>
                                        <td><img src="{{ URL::to($product->product_photo) }}" style="width: 100px;"></td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td style="color: red; text-align: center;"><i class="fa-solid fa-peso-sign"></i> {{$product->price}}</td>
                                        <td>
                                            
                                            @if($product->quantity > 0 && $product->quantity <= 4)
                                                <span class="badge badge-warning">{{$product->quantity}} Low Stock</span>
                                                @elseif($product->quantity == 0)
                                                <span class="badge badge-dark">Out of Stock</span>
                                                @else
                                                <span class="badge badge-success">{{$product->quantity}} In Stock</span>
                                            @endif
                                        </td>
                                        @if($product->quantity == 0)
                                        <td style="text-align: center;">
                                            <button type="submit" disabled class="btn btn-dark addbtn"><i class="fa-solid fa-plus"></i></button>
                                        </td>
                                        @else
                                        <td style="text-align: center;">
                                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                                        </td>
                                        @endif
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--COUNTER -->
        <div class="counter" >
            <div class="card">
                <div class="card-header bg-white">
                    <div class="title">
                        <p>Counter</p>
                    </div>   
                </div>
                <div class="card-body">
                <form action="{{ url('/create-invoice') }}" method="POST">
                        @csrf
                    <div class="panel">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li id="err">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4>Customer
                            <a href="" class="btn btn-primary pull-right addcus" data-toggle="modal" data-target="#addModal"><i class="fa-solid fa-plus"></i> Add Customer</a>
                        </h4>
                        <br>
                            
                        <div class="form-group">
                            @php
                                $customer = DB::table('customers')->get();
                            @endphp
                            <select class="form-select chosen" name="customer_id" required>
                            <option disabled selected="">Select Customer</option>
                            @foreach($customer as $cus)
                            <option value="{{$cus->id}}" required>{{$cus->customer_name}}</option>
                            @endforeach
                            </select>
                        
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Add Transaction</button>
                </form>
                    <br>
                    <div class="card border-info mb-5" style="max-width: 40rem;">
                        <div class="card-header">
                            <h1>Total: {{Cart::total();}}</h1>
                           
                        </div>
                        <div class="card-body text-info table_counter">
                            <a href="{{ URL::to('/delete-all') }}" class="btn btn-danger pull-right"><i class="fa-solid fa-trash"></i> Delete All</a>
                            <br>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th style="width: 150px;">Quantity</th>
                                        <th>Price</th>
                                        <th style="width: 50px;">Actions</th>
                                    </tr>
                                </thead>
                                @php
                                    $prod = Cart::content();
                                @endphp
                                <tbody class="">
                                        @foreach($prod as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>
                                                    <form action="{{ url('/update-cart/'.$product->rowId) }}" method="POST">
                                                        @csrf
                                                        <div class="qtybutton">
                                                            <input type="number" class="form-control" name="qty" value="{{$product->qty}}" style="width: 70px;">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-check"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td style="text-align: center;"><i class="fa-solid fa-peso-sign"></i> {{$product->price*$product->qty}}</td>
                                                <td style="text-align: center;">
                                                    <a href="{{ URL::to('/delete-cart/'.$product->rowId) }}" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
    </div>
</div>
<!-- OUT OF STOCK MODAL INDICATOR -->
<div class="modal fade" id="outofStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-easein="bounceDownIn">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="outofstock">
            <br>
            <h1><i class="fa-solid fa-cart-plus"></i></h1>
            <br>
            <h2>This Product is Out of Stock</h2>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btnClose" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6 pt">
                        Project Management &copy; POS System
                    </div>
                    <div class="col-sm-6 text-right cp">
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

<script>
    $('.chosen').chosen();
</script>

@endsection