@extends('layouts.master')

@section('title')
   Delete complete
@endsection

@section('content')
   <h1>Item has been deleted!</h1>
   <button><a href= "{{url("/")}}">Back to Home Page</a></button><br>
@endsection