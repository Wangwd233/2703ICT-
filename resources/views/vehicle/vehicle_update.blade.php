@extends('layouts.master')

@section('title')
   Update Vehicle
@endsection

@section('content')
    <h1>Edit Vehicle information</h1>
    <p class="error">{{$errormsg}}</p>
    <form method="post" action="{{url("update_vehicle_action")}}">
       {{csrf_field()}}
       <input type="hidden" name="id" value="{{$id}}">
       <p>
       <label>rego</label>
       <input type="text" name="rego" placeholder="000OMO"></p>
       <p><strong>Format: </strong>The rego format is a string with six characters which combined with numbers and upper case letters like "000-OMO".</p>
       <p>
       <label>model</label>
       <input type="text" name="model"></p>
       <p><strong>Format: </strong>Max length are 50 characters.</p>
       <p>
       <label>year</label>
       <input type="text" name="year"></p>
       <p><strong>Format: </strong>Year should between 2000 to 2021.</p>
       <p>
       <label>odometer</label>
       <input type="text" name="odometer"></p>
       <p><strong>Format: </strong>Odometer should be number which have maxmium length at 7.</p>
       <p>
       <label>seats</label>
       <input type="text" name="seats"></p>
       <p><strong>Format: </strong>Seats are not less than 4 or greater than 30.</p>
       <input type="submit" value="update vehicle">
    </form><br><br>
       <button><a href="{{url("vehicle_detail/$id")}}">Go back </a></button>
@endsection