@extends('layouts.master')

@section('title')
   Vehicle List
@endsection

@section('content')
   <h1>Vehicle list</h1>
   @if($vehicle)
   <ul>
       @foreach($vehicle as $vehicle_list)
          <li><a href="{{url("vehicle_detail/$vehicle_list->vehicle_id")}}">{{$vehicle_list->rego}}</a></li>
       @endforeach
   </ul>
   @else
    No item found
   @endif
   

   <p><button><a href="{{url('add_vehicle')}}">Add a new vehicle</a></button></p>
   <!-- <p><a href="{{url('clients_detail')}}">List of clients</a></p>
   <p><a href="{{url("booking_list")}}">Book a vehicle</a></p> -->
@endsection