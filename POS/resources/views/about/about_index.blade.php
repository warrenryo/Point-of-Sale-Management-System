@extends('layouts.app')
<div class="load">
        <img src="{{asset('assets/img/three-dots.svg') }}">
        <img class="logoPOS" src="{{asset('assets/img/vcp.png')}}" >
    </div>
@section('content')
@include('layouts.includes.sidebar')
<style>
    .about_page{
        position: relative;
        top: 120px;
        left: 70px;
    }
</style>
    <div class="about_page">
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            This System is for Educational Purposes only for our Project Management
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Created by Project Team
        </div>
        <br>
        <br>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Project Team:
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Gandarosa, Norhana
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Glorioso, Michael Angelo
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Pena, Warren Ryo
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Sanchez, Daniel
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
            Sebusa, Roel
        </div>
    </div>
    
@endsection
