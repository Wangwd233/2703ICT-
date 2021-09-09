@extends('layouts.master')

@section('title')
   Vehicle Detail
@endsection

@section('content')
   <h1>Rego number: {{$vehicle->rego}}</h1>
   <p>Model: {{$vehicle->model}}</p>
   <p>Year: {{$vehicle->year}}</p>
   <p>Odometer: {{$vehicle->odometer}}</p>
   <p>Number of seats: {{$vehicle->seats}}</p>
   <h1>Booking informations</h1>
   @if(is_string($orders) == TRUE)
      <h2>{{$orders}}</h2>
   @else
      @foreach($orders as $order)
        <table class="bordered">
            <!-- table header -->
          <tr><th>Booking details</th><th></th></tr>
          <tr><td>Client name: </td><td>{{$order->client_name}}</td></tr>
          <tr><td>License number: </td><td>{{$order->license_num}}</td></tr>
          <tr><td>Booking start date and time: </td><td>{{$order->date_start}}</td></tr>
          <tr><td>Returning date and time: </td><td>{{$order->date_end}}</td></tr>
         </table><br>
      @endforeach
   @endif
   <button><a href= "{{url("vehicle_update/$vehicle->vehicle_id")}}">Edit vehicle information</a></button><br><br>
   <button><a href= "{{url("vehicle_delete/$vehicle->vehicle_id")}}">Delete this vehicle</a></button>
@endsection