@extends('layout.master')
@section('css')
<style>
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 300px;
      margin: auto;
      text-align: center;
      font-family: arial;
    }
    
    .title {
      color: grey;
      font-size: 18px;
    }
    
    button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }
    
    a {
      text-decoration: none;
      font-size: 22px;
      color: black;
    }
    
    button:hover, a:hover {
      opacity: 0.7;
    }
    </style>

@endsection
@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper">

        <h2 style="text-align:center">Admin Profile</h2>

        <div class="card">
          <img src="{{URL::asset($admin->image)}}" alt="Admin" style="width:100%">
          <h1>{{$admin->name}}</h1>
          <p class="title"><p>{{$admin->email}}</p></p>
          <p>{{$admin->phone}}</p>
          <p>{{$admin->address}}</p>
          <br>
        </div><!-- form-layout-footer -->
        </div><!-- form-layout -->

@endsection
