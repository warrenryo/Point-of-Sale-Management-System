@extends('layouts.app')
<link rel="stylesheet" href="{{asset('assets/css/receipt.css')}}">
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<!--receipt start-->
<div class="page-tools">
    <div class="action-buttons">
        <a class="btn bg-white btn-light mx-1px text-95 hidden-print" href="#" onclick="window.print()" data-title="Print">
            <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                 Print
        </a>
        <a href="{{ route('transaction') }}" class="btn btn-primary">Go back to Transaction <i class="fa-solid fa-arrow-right"></i></a>
    </div>
 </div>
 <br>
 <br>
 <br>
<div class="print-container">
<div class="card">
    <br>
 <div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: {{$orders->transaction_code}}
            </small>
        </h1>

        
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <span class="text-default-d3">Vape Central Ph</span>
                            <div class="text-grey-m2">
                                <div style="font-size: 15px;"> <b class="text-sm">31 Matino, Diliman, Lungsod Quezon, Kalakhang Maynila</b></div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{$orders->customer_name}}</span>
                        </div>
                        <br>
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Email:</span>
                            <div class="text-grey-m2">
                                <div class="my-1"><i class="fa-solid fa-envelope"></i> <b class="text-600"></b></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID: {{$orders->customer_id}} </span></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date: {{$orders->order_date}}</span> </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-success badge-pill px-25">Paid</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

              

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>
                        @php
                            $sl=1;
                        @endphp
                    <tbody class="text-95 text-secondary-d3">
                        @foreach($order_details as $ord)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$ord->product_name}} - {{$ord->brand}}</td>
                                <td>{{$ord->quantity}}</td>
                                <td><i class="fa-solid fa-peso-sign"></i> {{$ord->unit_price}}</td>
                                <td><i class="fa-solid fa-peso-sign"></i> {{$ord->total}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            Extra note such as company or payment information...
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">{{$orders->sub_total}}</span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax 
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">{{$orders->tax}}</span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2" id="total">{{$orders->total}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
             
                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        
                    </div> 
                    
                    
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

</div>

</div>
<footer class="sites-footer">
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