<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <style>
    .nav-bar {
      background-color: #333;
      overflow: hidden;
    }

    .nav-bar a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    .nav-bar a:hover {
      background-color: #ddd;
      color: black;
    }

    .nav-bar a.active {
      background-color: #04AA6D;
      color: white;
    }

    button {
      color: white;
      padding: 10px 24px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      background-color: white;
      color: black;
      border: 2px solid blue;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="{{asset ('css/wp.css')}}" >
</head>

<body> 
    <div class="nav-bar">
      <a class="active" href="{{url("/")}}">Home</a>
      <a href="{{url('clients_detail')}}">Clients Detail</a>
      <a href="{{url("booking_list")}}">Booking a Vehicle</a>
      <a href="{{url("vehicle_total")}}">Total booking time</a>
    </div>  

    @yield('content')
</body>