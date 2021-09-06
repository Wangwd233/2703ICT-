<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $sql = "select * from vehicle";
    $vehicle = DB::select($sql);
    //dd($vehicle);
    return view('vehicle.vehicle_list')->with("vehicle", $vehicle);
});

Route::get('vehicle_detail/{vehicle_id}', function($vehicle_id){
   $vehicle = get_vehicle($vehicle_id);
   return view('vehicle.vehicle_detail')->with("vehicle", $vehicle);
});

Route::get('add_vehicle', function(){
   return view('vehicle.vehicle_add');
});

Route::post('add_vehicle_action', function(){
   $rego = request('rego');
   $model = request('model');
   $year = request('year');
   $odometer = request('odometer');
   $seats = request('seats');
   $id = add_vehicle($rego, $model, $year, $odometer, $seats);
   if($id) {
      return redirect("vehicle_detail/$id");
  } else{
      die ("Error while adding item. ");
  };
});

Route::get('vehicle_update/{vehicle_id}', function($vehicle_id){
   return view('vehicle.vehicle_update')->with('id', $vehicle_id);
});

Route::post('update_vehicle_action', function(){
   $id = request('id');
   $rego = request('rego');
   $model = request('model');
   $year = request('year');
   $odometer = request('odometer');
   $seats = request('seats');
   update_vehicle($id, $rego, $model, $year, $odometer, $seats);
   $vehicle = get_vehicle($id);
   return view('vehicle.vehicle_detail')->with("vehicle", $vehicle);
});

Route::get('test', function (){
   return view('test');
});

Route::post('test_action', function(){
   $test = request('test');
   $id = convert_date($test);
   dd($id);
});

function get_vehicle($id){
   $sql = "select * from vehicle where vehicle_id=?";
   $vehicle = DB::select($sql, array($id));
   if (count($vehicle)!=1){
       die("Something has gone wrong, invalid query or result: $sql");
   };
   $vehicle_detail = $vehicle[0];
   return $vehicle_detail;
};

function add_vehicle($rego, $model, $year, $odometer, $seats){
   $sql = 'insert into vehicle (rego, model, year, odometer, seats) values(?, ?, ?, ?, ?)';
   DB::insert($sql, array($rego, $model, $year, $odometer, $seats));
   $id = DB::getPdo()->lastInsertId();
   return($id);
};

function update_vehicle($id, $rego, $model, $year, $odometer, $seats){
   $sql = 'update vehicle set rego = ?, model = ?, year = ?, odometer = ?, seats = ? where vehicle_id = ?';
   DB::update($sql, array($rego, $model, $year, $odometer, $seats, $id));
};

function convert_date($date){
   //$cdate = "convert(datetime, ?, 20)";
   //DB::select($cdate, array($date));
   $sql = "insert into test (summary) values (?)";
   DB::insert($sql, array($date));
   $id = DB::getPdo()->lastInsertId();
   return($id);
};