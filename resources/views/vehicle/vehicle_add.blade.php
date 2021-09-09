@extends('layouts.master')

@section('title')
   Add Vehicle
@endsection

@section('content')
    <h1>Add a new vehicle</h1>
    <p class="error">{{$errormsg}}</p>
    <form method="post" action="{{url("add_vehicle_action")}}">
       {{csrf_field()}}
       <p>
       <label>rego</label>
       <input type="text" name="rego" ></p>
       <p><strong>Format: </strong>The rego format is a string with six characters which combined with numbers and upper case letters like "000-OMO".</p>
       <p>
       <label>model</label>
       <input type="text" name="model" ></p>
       <p><strong>Format: </strong>Max length are 50 characters.</p>
       <p>
       <label>year</label>
       <input type="text" name="year"></p>
       <p><strong>Format: </strong>Year should between 2000 to 2021.</p>
       <p>
       <label>odometer</label>
       <input type="text" name="odometer"></p>
       <p><strong>Format: </strong>Odometer should be number which have maxmium length at 10.</p>
       <p>
       <label>seats</label>
       <input type="text" name="seats"></p>
       <p><strong>Format: </strong>Seats are not less than 1 or greater than 30.</p>
       <input type="submit" value="add vehicle">
    </form>
@endsection