@extends('layouts.master')

@section('title')
   Update Vehicle
@endsection

@section('content')
    <h1>Edit Vehicle information</h1>
    <form method="post" action="{{url("update_vehicle_action")}}">
       {{csrf_field()}}
       <input type="hidden" name="id" value="{{$id}}">
       <p>
       <label>rego</label>
       <input type="text" name="rego" maxlength="7" placeholder="000-OMO" pattern="[A-Z0-9][A-Z0-9][A-Z0-9]-[A-Z0-9][A-Z0-9][A-Z0-9]" required></p>
       <p><strong>Format: </strong>The rego format is a string with six characters which combined with numbers and upper case letters like "000-OMO".</p>
       <p>
       <label>model</label>
       <input type="text" name="model" maxlength="50" required></p>
       <p><strong>Format: </strong>Max length are 50 characters.</p>
       <p>
       <label>year</label>
       <input type="number" name="year" min="2000" max="2021" required></p>
       <p><strong>Format: </strong>Year should between 2000 to 2021.</p>
       <p>
       <label>odometer</label>
       <input type="number" name="odometer" min="0" max="9999999999" required></p>
       <p><strong>Format: </strong>Odometer should be number which have maxmium length at 10.</p>
       <p>
       <label>seats</label>
       <input type="number" name="seats" min="4" max="30" required></p>
       <p><strong>Format: </strong>Seats are not less than 1 or greater than 30.</p>
       <input type="submit" value="update vehicle">
    </form>
       <a href="{{url("vehicle_detail/$id")}}">Go back </a>
@endsection