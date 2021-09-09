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

//Homepage route
Route::get('/', function () {
    $sql = "select * from vehicle";
    $vehicle = DB::select($sql);
    //dd($vehicle);
    return view('vehicle.vehicle_list')->with("vehicle", $vehicle);
});

//vehicle_detail page
Route::get('vehicle_detail/{vehicle_id}', function($vehicle_id){
   $vehicle = get_vehicle($vehicle_id);
   $orders = booking_list($vehicle_id);
   return view('vehicle.vehicle_detail')->with("vehicle", $vehicle)->with('orders', $orders);
});

//vehicle_add page
Route::get('add_vehicle', function(){
   return view('vehicle.vehicle_add');
});

//Route for submitting a new vehicle
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

//Vehicle_update page
Route::get('vehicle_update/{vehicle_id}', function($vehicle_id){
   return view('vehicle.vehicle_update')->with('id', $vehicle_id);
});

//Route for submitting changes for vehicle
Route::post('update_vehicle_action', function(){
   $id = request('id');
   $rego = request('rego');
   $model = request('model');
   $year = request('year');
   $odometer = request('odometer');
   $seats = request('seats');
   update_vehicle($id, $rego, $model, $year, $odometer, $seats);
   $vehicle = get_vehicle($id);
   $orders = booking_list($id);
   return view('vehicle.vehicle_detail')->with("vehicle", $vehicle)->with("orders", $orders);
});

//Vehicle_delete page
Route::get('vehicle_delete/{vehicle_id}', function($vehicle_id){
   return view('vehicle.vehicle_delete')->with('id', $vehicle_id);
});

//Route for comfirm delete a vehicle
Route::post('vehicle_delete_comfirm', function(){
  $id = request('id');
  delete_vehicle($id);
  return view('vehicle.delete_complete');
});


//Route for get clients_detail and display in the page
Route::get('clients_detail', function(){
  $sql = 'select * from clients';
  $client_list = DB::select($sql);
  return view('clients.clients_detail')->with('clients', $client_list);
});

//booking_list page
Route::get('booking_list', function(){
  $sql = 'select client_id, client_name from clients';
  $client_name = DB::select($sql);
  $sql = 'select vehicle_id, rego from vehicle';
  $vehicle_rego = DB::select($sql);
  return view('booking.booking_list')->with('clients', $client_name)->with('vehicle_rego', $vehicle_rego);
});

//Route for submitting a booking
Route::post('booking_action', function(){
  $client_id = request('id');
  $vehicle_id = request('rego');
  $start_date = request('startdate');
  $end_date = request('enddate');
  $id = booking_request($client_id, $vehicle_id, $start_date, $end_date);
  dd($id);
});


/* Route::get('test', function (){
   return view('test');
}); */

/* Route::post('test_action', function(){
   $test = request('test');
   $id = convert_date($test);
   dd($id);
}); */

//Function to get a vehicle detail by id
function get_vehicle($id){
   $sql = "select * from vehicle where vehicle_id=?";
   $vehicle = DB::select($sql, array($id));
   if (count($vehicle)!=1){
       die("Something has gone wrong, invalid query or result: $sql");
   };
   $vehicle_detail = $vehicle[0];
   return($vehicle_detail);
};

//Function to insert a new vehicle to the database
function add_vehicle($rego, $model, $year, $odometer, $seats){
   $i = TRUE;
   $sql = 'select * from vehicle';
   $vehicle = DB::select($sql);
   foreach($vehicle as $vehicle_detail){
     if($rego == $vehicle_detail->rego){
         $i = FALSE;
     };
   };

   if($i == TRUE){
      $sql = 'insert into vehicle (rego, model, year, odometer, seats) values(?, ?, ?, ?, ?)';
      DB::insert($sql, array($rego, $model, $year, $odometer, $seats));
      $id = DB::getPdo()->lastInsertId();
      return($id);
   }else{
      die("The vehicle with rego $rego is already exist!");
   };
   
};

//function to update a vehicle information
function update_vehicle($id, $rego, $model, $year, $odometer, $seats){
   $i = TRUE;
   $sql = 'select * from vehicle';
   $vehicle = DB::select($sql);
   foreach($vehicle as $vehicle_detail){
      if($rego == $vehicle_detail->rego AND $id != $vehicle_detail->vehicle_id){
          $i = FALSE;
      };
    };
   if($i == TRUE){
      $sql = 'update vehicle set rego = ?, model = ?, year = ?, odometer = ?, seats = ? where vehicle_id = ?';
      DB::update($sql, array($rego, $model, $year, $odometer, $seats, $id));
   }else{
      die("The vehicle with rego $rego is already exist!");
   };
};

//Function to delete a vehicle from the database
function delete_vehicle($id){
  $sql = 'delete from vehicle where vehicle_id = ?';
  DB::delete($sql, array($id));
};

//Function to insert booking to the orders table
function booking_request($client_id, $vehicle_id, $start_date, $end_date){
   $sql = 'insert into orders (client_id, vehicle_id, date_start, date_end) values(?, ?, ?, ?)';
   DB::insert($sql, array($client_id, $vehicle_id, $start_date, $end_date));
   $id = DB::getPdo()->lastInsertId();
   return($id);
};

//function to query and list booking request for each cars
function booking_list($vehicle_id){
   $sql = 'select orders.client_id, clients.client_name, clients.license_num, orders.date_start, orders.date_end 
   from orders,clients where orders.client_id = clients.client_id and orders.vehicle_id = ?';
   $orders = DB::select($sql, array($vehicle_id));
   if($orders){
     return($orders);
   }else{
      return("no booking request yet");
   }
};


/* function convert_date($date){
   $sql = "insert into test (summary) values (?)";
   DB::insert($sql, array($date));
   $id = DB::getPdo()->lastInsertId();
   return($id);
}; */