@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/brands_index.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">List of Brands</p>
</div>
<!-- ADD BRANDS MODAL -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Brands</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('add-brand') }}" method="POST">
        @csrf
        
        <div class="modal-body">
                <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" class="form-control" name="brand_name" placeholder="Enter Brand" required>
                </div>
                <div class="form-group">
                    <label for="">Manufacturer</label>
                    <input type="text" class="form-control"  name="manufacturer" placeholder="Enter Manufacturer" required>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Brand</button>
        </div>    
        </form>
    </div>
  </div>
</div>
<!-- ADD BRANDS MODAL END -->

<!-- EDIT BRANDS MODAL -->
<div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Brands</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('edit-brand') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="brand_id" id="brand_id">
        <div class="modal-body">
                <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" class="form-control" name="brand_name" id="brand_name"  placeholder="Enter Brand" required>
                </div>
                <div class="form-group">
                    <label for="">Manufacturer</label>
                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Enter Manufacturer" required>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>    
        </form>
    </div>
  </div>
</div>
<!-- EDIT BRANDS MODAL END -->

<!--DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <br>
           <br>
        <form action="{{ url('delete-brand')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="deleteSign">
            <h1><i class="fa-regular fa-circle-xmark"></i></h1>
            </div>
            <br>
            <div class="confirmation">
                <h1>Are you sure?</h1>
                <br>
                <h6>Do you really want to delete these Brand? This <br>
                    process cannot be undone.
                </h6>
            </div>
            <br>
            <br>
            <input type="hidden" name="delete_brand" id="delete_id">
            
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
<div class="col-md-12">
    <div class="card">
      <div class="card-header bg-white">
        <div class="grid-container">
            <div class="grid-item"><p></p></div>
            <div class="grid-item"><button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary" ><i class="fa-solid fa-plus"></i> Add Brands</button></div>
        </div>
      </div>
      <div class="card-body">
        <table id="dtBasicExample" class="table table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Brand Name</th>
              <th class="th-sm">Manufacturer</th>
              <th class="th-sm" style="width: 150px;">Actions</th>
            </tr>
          </thead>
          <tbody>
             @foreach($brand as $brands)
                <tr>
                    <td>{{$brands->id}}</td>
                    <td>{{$brands->brand_name}}</td>
                    <td>{{$brands->manufacturer}}</td>
                    <td>
                        <button type="button" value="{{$brands->id}}" class="btn btn-primary editbtn"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                        <button type="button" value="{{$brands->id}}" class="btn btn-danger delbtn"><i class="fa-solid fa-trash"></i> Delete</button>
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
   <script>
    $(document).ready(function(){
        //DELETE BRAND
        $(document).on('click', '.delbtn', function(){
            var brand = $(this).val();
            $('#deleteModal').modal('show');
            $('#delete_id').val(brand);
        })

        //EDIT BRAND
        $(document).on('click','.editbtn', function(){
            var brand = $(this).val();
            $('#editBrandModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#brand_id').val(data[0]);
            $('#brand_name').val(data[1]);
            $('#manufacturer').val(data[2]);
        })
    })
   </script>
@endsection