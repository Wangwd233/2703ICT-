@extends('layouts.master')

@section('title')
   Delete complete
@endsection

@section('content')
   <h1>Item has been deleted!</h1>
   <a href= "{{url("/")}}">Back to Home Page</a><br>
@endsection