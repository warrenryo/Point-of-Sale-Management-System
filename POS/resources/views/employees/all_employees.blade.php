@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/list_employee.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">List of Employees</p>
</div>
<!-- EDIT MODAL -->
<!--<div class="modal fade" id="editEmployModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ url('/edit-employee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="employ_id" id="employ_id">
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>Employee Name</label>
                            <input type="text "class="form-control" name="name" id="name" placeholder="Enter Employee Name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="email" id="email"  placeholder="Enter Email Address" required>
                        </div>
                        <div class="form-group mb-4" >
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="phone" id="phone"  placeholder="Enter Phone Number" style="width: 200px;" required>
                        </div>
                        <div class="form-group mb-4">
                            <img id="image" src="#">
                            <br>    
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*"
                            class="upload" onchange="readURL(this);" style="width: 250px;">
                        </div>
                       
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
      </form>
      </div>
    </div>
  </div>
</div>-->
<!-- EDIT MODAL END -->


<!--DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <br>
           <br>
        <form action="{{ url('delete-employee')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="deleteSign">
            <h1><i class="fa-regular fa-circle-xmark"></i></h1>
            </div>
            <br>
            <div class="confirmation">
                <h1>Are you sure?</h1>
                <br>
                <h6>Do you really want to delete these Employee? This <br>
                    process cannot be undone.
                </h6>
            </div>
            <br>
            <br>
            <input type="hidden" name="delete_employee" id="delete_id">
            
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
      <div class="card-body">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Name </th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Contact Number</th>
              <th class="th-sm">Photo</th>
              <th class="th-sm" style="width: 230px;">Actions</th>
            </tr>
          </thead>
          <tbody>
                @foreach($emp as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td><img src="{{$item->photo}}" style="width: 100px;"></td>
                        <td>
                          <a href="{{ URL::to('edit-employee/'.$item->id) }}" class="btn btn-primary edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                          <button type="button" class="btn btn-danger deletebtn" value="{{$item->id}}"><i  class="fa-solid fa-trash"></i> Delete</button>
                          <a href="{{ URL::to('view-employee/'.$item->id) }}" class="btn btn-success"><i class="fa-solid fa-eye"></i> View</a>
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
    
    //DELETE EMPLOYEE
    $(document).on('click', '.deletebtn', function(){
      var emp = $(this).val();
      $('#deleteModal').modal('show');
      $('#delete_id').val(emp);
    })

    //EDIT EMPLOYEE
    $(document).on('click', '.edit',function(){
      var $emp = $(this).val();
      $('#editEmployModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children('td').map(function(){
        return $(this).text();
      }).get();

      console.log(data);
      $('#employ_id').val(data[0]);
      $('#name').val(data[1]);
      $('#email').val(data[2]);
      $('#phone').val(data[3]);
      $('#image').val(data[4]);
    })


  })
</script>

@endsection