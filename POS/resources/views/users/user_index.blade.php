@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@extends('layouts.includes.sidebar')
<link rel="stylesheet" href="assets/css/user_index.css">
<div class="head">
    <p style="position: relative; bottom: 20px;">POS Accounts</p>
</div>
<link rel="stylesheet" href="{{asset('assets/css/user_index.css')}}">
<!--DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <br>
           <br>
        <form action="{{ url('delete-user')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="deleteSign">
            <h1><i class="fa-regular fa-circle-xmark"></i></h1>
            </div>
            <br>
            <div class="confirmation">
                <h1>Are you sure?</h1>
                <br>
                <h6>Do you really want to delete these User? This <br>
                    process cannot be undone.
                </h6>
            </div>
            <br>
            <br>
            <input type="hidden" name="delete_user" id="delete_id">
            
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
<div class="col-md-10">
    <div class="card">
      <div class="card-body">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm" style="width: 30px;">ID</th>
              <th class="th-sm">Name </th>
              <th class="th-sm">Email</th>
              <th class="th-sm" style="width: 150px;">Actions</th>
            </tr>
          </thead>
          <tbody>
               @foreach($user as $us)
                    <tr>
                        <td>{{$us->id}}</td>
                        <td>{{$us->name}}</td>
                        <td >{{$us->email}}</td>
                        <td>
                            <button type="button" value="{{$us->id}}" class="btn btn-danger delbtn"><i  class="fa-solid fa-trash"></i> Delete</button>
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

<!--SCRIPT FOR DELETE AND MODAL -->
   <script>
    $(document).ready(function(){
        $(document).on('click','.delbtn', function(){
            var user = $(this).val();
            $('#deleteModal').modal('show');
            $('#delete_id').val(user);
        })
    })
   </script>
@endsection