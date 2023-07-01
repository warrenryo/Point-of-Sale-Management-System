@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/add_customer.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">Add Customers</p>
</div>
<div class="container">
    <div class="row justify-content-center" style="position: relative; top: 20px; left: 120px;">
        <div class="col-md-8">
            <div class="card">
                <br>
                <div class="card-body">
                <form action="{{ url('/add-customer')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <label>Customer Name</label>
                            <input type="text "class="form-control" name="customer_name"  placeholder="Enter Customer Name" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="customer_email"   placeholder="Enter Customer Email" required>
                        </div>
                        <div class="modal-footer">
                        <a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
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
@endsection