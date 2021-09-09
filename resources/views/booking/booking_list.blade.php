@extends('layouts.master')

@section('title')
   Booking List
@endsection

@section('content')
   <h1>Book a vehicle</h1>
   <form method="post" action="{{url("booking_action")}}">
      {{csrf_field()}}
      <h2><label>Choose your name</label></h2>
      <select name="id" id="client">
        @foreach($clients as $client)
          <option value="{{$client->client_id}}">{{$client->client_name}}</option>
        @endforeach
      </select>

      <h2><label>Choose The vehicle your prefer by rego</label></h2>
      <select name="rego" id="vehicle">
        @foreach($vehicle_rego as $rego)
          <option value="{{$rego->vehicle_id}}">{{$rego->rego}}</option>
        @endforeach
      </select>
      
      <h2><label>Choose a start time</label></h2>
      <input type="datetime-local" name="startdate">

      <h2><label>Choose a return time</label></h2>
      <input type="datetime-local" name="enddate">

      <p><input type="submit" value="submit your request"></p>
   </form>
@endsection