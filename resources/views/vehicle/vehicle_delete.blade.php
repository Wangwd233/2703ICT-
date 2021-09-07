@extends('layouts.master')

@section('section')
    Vehicle Delete
@endsection
  
@section('content') 
       <h1>Are you sure to delete this item?</h1>
       <h2>Warning: Once delete, the item will not be restored again.</h2>
       <form method="post" action="{{url("vehicle_delete_comfirm")}}">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{$id}}">
          <input type="submit" value="delete now">
        </form>
        <p><a href="{{url("item_detail/$id")}}">Go back</a></p>
@endsection