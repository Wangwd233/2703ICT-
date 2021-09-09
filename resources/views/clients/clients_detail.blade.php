@extends('layouts.master')

@section('title')
   Client list
@endsection

@section('content')
   <h1>Client List</h1>
   @foreach($clients as $client)
      <h2>Client id: {{$client->client_id}}</h2>
      <ul>
         <h3><li>Client name: {{$client->client_name}}</li></h3>
         <h3><li>{{$client->age}}</li></h3>
         <h3><li>{{$client->license_num}}</li></h3>
         <h3><li>{{$client->license_type}}</li></h3>
         <h3><li>{{$client->DoB}}</li></h3>
      </ul>
   @endforeach

   <p><a href="{{url('/')}}">Home</p>
@endsection