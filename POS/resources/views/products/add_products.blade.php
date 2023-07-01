@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<link rel="stylesheet" href="{{asset('assets/css/add_products.css')}}">
<div class="head">
    <p style="position: relative; bottom: 20px;">Add Products</p>
</div>
<div class="container" style="position: relative; left: 130px; top: 20px;">
    <div class="card">
        <div class="card-header bg-white">
            <div class="grid-container">
                <div class="grid-item"><p></p></div>
                <div class="grid-item"><a href="{{ route('list_product') }}" class="btn btn-outline-secondary" >Go to Product List <i class="fa-solid fa-arrow-right"></i></a></div>
            </div>
            
        </div>
        <div class="card-body">
            <form action="{{ url('/add-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <select name="brand" class="form-select">
                            <option disabled selected>Choose Brand...</option>
                            @foreach($brand as $row)
                            <option value="{{ $row->brand_name }}">{{$row->brand_name}}</option>
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
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Price" required>
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
                
                <div class="form-row">
                <div class="form-group mb-4">
                            <img id="image" src="#">
                            <br>    
                            <label>Product Photo</label>
                            <input type="file" class="form-control" name="product_photo" accept="image/*"
                            class="upload" onchange="readURL(this);" style="width: 250px;">
                </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                         <ul>
                             @foreach($errors->all() as $error)
                                <li id="err">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
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
