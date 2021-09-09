@extends('layouts.master')

@section('title')
   Return a vehicle
@endsection

@section('content')
   <h1>Return a vehicle</h1>
   <form method="post" action="booking_return_action">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$id}}">
      <label>Enter the odometer</label>
      <input type="number" name="odometer" min="0" max="9999999999" required></p>
       <p><strong>Format: </strong>Odometer should be number which have maxmium length at 10.</p>
       <input type="submit" value="return vehicle">
   </form>
@endsection