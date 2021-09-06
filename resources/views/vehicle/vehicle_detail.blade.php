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

   <a href= "{{url("vehicle_update/$vehicle->vehicle_id")}}">Edit vehicle information</a><br>
   <a href= "{{url("/")}}">Delete this vehicle</a><br>
   <a href= "{{url("/")}}">Home</a><br>
@endsection