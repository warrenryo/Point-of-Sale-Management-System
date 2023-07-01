@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/add_employee.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">Add Employees</p>
</div>
<div class="container">
    <div class="row justify-content-center" style="position: relative; top: 20px; left: 100px;">
        <div class="col-md-8">
            <div class="card">
                <br>
                <div class="card-body">
                <form action="{{ url('/put-employee')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>Employee Name</label>
                            <input type="text "class="form-control" name="name"  placeholder="Enter Employee Name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="email"   placeholder="Enter Email Address" required>
                        </div>
                        <div class="form-group mb-4" >
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="phone"   placeholder="Enter Phone Number" style="width: 200px;" required>
                        </div>
                        <div class="form-group mb-4">
                            <img id="image" src="#">
                            <br>    
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*"
                            class="upload" onchange="readURL(this);" style="width: 250px;">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
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
                    <div class="col-sm-6 text-right">
                        Created By Project Team
                    </div>
                </div>
            </div>
        </footer>
<script>
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection