@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/view_employee.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">View Employee</p>
</div>
<div class="container">
    <div class="title">
        <a href="{{ route('list_employees') }}" class="btn btn-outline-secondary">Back to Employee List <i class="fa-solid fa-arrow-right"></i> </a>
    </div>
    <div class="row justify-content-center" style="position: relative; top: 100px;">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <div class="rowItem">
                        <div class="info">
                            <img class="ig" src="{{ URL::to($singleEmploy->photo) }}">
                        </div>
                        <div class="empInfo">
                            <h1>Name:</h1>
                            <p>{{$singleEmploy->name}}</p>
                            
                            <h1>Email:</h1>
                            <p>{{$singleEmploy->email}}</p>

                            <h1>Contact No.</h1>
                            <p>{{$singleEmploy->phone}}</p>
                        </div>
                    </div>
                    <br>
                    <br>
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