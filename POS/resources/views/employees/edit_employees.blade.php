@extends('layouts.app')

@section('content')
@include('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/edit_employees.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">Edit Employees</p>
</div>
<div class="container">
    <div class="row justify-content-center" style="position: relative; top: 20px; left: 120px;">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                <form action="{{ url('/update-employee/'.$emp->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>Employee Name</label>
                            <input type="text "class="form-control" name="name"  value="{{$emp->name}}" placeholder="Enter Employee Name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="email"  value="{{$emp->email}}" placeholder="Enter Email Address" required>
                        </div>
                        <div class="form-group mb-4" >
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="phone"  value="{{$emp->phone}}" placeholder="Enter Phone Number" style="width: 200px;" required>
                        </div>
                        <div class="form-group">
                            <label>Employe Photo</label>
                            <br>
                            <img src="{{ URL::to($emp->photo) }}" style="width: 200px;">
                        </div>
                        <div class="form-group mb-4">
                            <img id="image" src="#">
                            <br>    
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*"
                            class="upload" onchange="readURL(this);" style="width: 250px;">
                            <input type="hidden" name="old_photo" value="{{$emp->photo}}">
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('list_employees')}}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary" >Submit</button>
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