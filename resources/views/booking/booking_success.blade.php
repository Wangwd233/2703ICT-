@extends('layouts.master')

@section('title')
   Booking success
@endsection

@section('content')
   <p>Your request has been created successfully!</p>
   <button><a class="active" href="{{url("/")}}">Go back to Homepage</a></button>
@endsection