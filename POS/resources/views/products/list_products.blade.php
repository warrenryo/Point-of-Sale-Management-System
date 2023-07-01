@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/list_products.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">List of Products</p>
</div>
<!-- EDIT BRANDS MODAL -->
<!-- <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('edit-product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="product_id" id="product_id">
        <div class="modal-body">
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                     </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Product Brand</label>
                        @php
                            $brand= DB::table('brands')->get();
                        @endphp
                        <select name="brand" id="brand" class="form-control">
                            <option id="brand" selected>Choose Brand</option>
                            @foreach($brand as $row)
                            <option id="brand" value="{{ $row->brand_name }}">{{$row->brand_name}}</option>
                            @endforeach
                        </select>    
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code" required>
                    </div>
                    <div class="form-group col-md-2" >
                        <label for="">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Product Quantity" required>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Product Description"></textarea>
                    </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>    
        </form>
    </div>
  </div>
</div>-->
<!-- EDIT BRANDS MODAL END -->

<!--DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <br>
           <br>
        <form action="{{ url('delete-product')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="deleteSign">
            <h1><i class="fa-regular fa-circle-xmark"></i></h1>
            </div>
            <br>
            <div class="confirmation">
                <h1>Are you sure?</h1>
                <br>
                <h6>Do you really want to delete these Product? This <br>
                    process cannot be undone.
                </h6>
            </div>
            <br>
            <br>
            <input type="hidden" name="delete_product" id="delete_id">
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="position: relative; right: 150px; width: 100px; padding: 10px;" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" style="position: relative; bottom: 2px; right: 110px; width: 100px; padding: 10px;">Delete</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <!-- END DELETE MODAL -->

<!--DATA TABLE START -->
<div class="all-container">
    <div class="card">
      <div class="card-header bg-white">
        <div class="grid-container">
            <div class="grid-item"></div>
            <div class="grid-item"><a href="{{ route('add_products') }}" class="btn btn-primary" ><i class="fa-solid fa-plus"></i> Add Products</a></div>
        </div>
      </div>
      <div class="card-body">
        <table id="dtBasicExample" class="table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead class="bg-gradient bg-info">
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Product Name</th>
              <th class="th-sm">Product Code</th>
              <th class="th-sm">Product Image</th>
              <th class="th-sm">Description</th>
              <th class="th-sm">Brand</th>
              <th class="th-sm">Price</th>
              <th class="th-sm" style="width: 30px;">Quantity</th>
              <th class="th-sm" style="width: 40px;">Status</th>
              <th class="th-sm" style="width: 150px; text-align: center;">Actions</th>
            </tr>
          </thead>
          <tbody>
             @foreach($prod as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_code}}</td>
                    <td><img src="{{$item->product_photo}}" style="width: 100px;"></td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->brand}}</td>
                    <td><i class="fa-solid fa-peso-sign"></i> {{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>
                        @if($item->quantity > 0 && $item->quantity <= 4)
                            <span class="badge badge-warning">{{$item->quantity}} Low Stock</span>
                            @elseif($item->quantity == 0)
                            <span class="badge badge-dark">Out of Stock</span>
                            @else
                            <span class="badge badge-success">{{$item->quantity}} In Stock</span>
                        @endif
                    </td>
                    <td style=" text-align: center;">
                        <a href="{{ URL::to('edit-product/'.$item->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <button type="button" value="{{$item->id}}" class="btn btn-danger delbtn"><i class="fa-solid fa-trash"></i> Delete</button>
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
<!--SCRIPT FOR EDIT PRODUCT MODAL-->
   <script>
        $(document).ready(function(){
            //DELETE MODAL
            $(document).on('click', '.delbtn', function(){
                var prod = $(this).val();
                $('#deleteModal').modal('show');
                $('#delete_id').val(prod);
            })
            //EDIT MODAL
            $(document).on('click', '.editbtn', function(){
                var prod = $(this).val();
                $('#editProductModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function(){
                    return $(this).text();
                }).get();

                console.log(data)
                $('#product_id').val(data[0]);
                $('#product_name').val(data[1]);
                $('#product_code').val(data[2]);
                $('#brand').val(data[4]);
                $('#price').val(data[5]);
                $('#quantity').val(data[6]);
                $('#description').val(data[3]);
            })
        })
   </script>
<!--SCRIPT FOR EDIT PRODUCT MODAL-->
@endsection