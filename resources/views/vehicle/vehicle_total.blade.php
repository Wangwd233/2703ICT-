@extends('layouts.master')

@section('title')
  Total amount of booking time for vehicle
@endsection

@section('content')
  <h1>Vehicle with booking time</h1>
  @foreach($vehicle_total as $vehicle)
     <h2>Vehicle Rego: {{$vehicle[0]}}</h2>
     <h3>Total Booking time is: {{$vehicle[1]}} days</h3>
  @endforeach
@endsection