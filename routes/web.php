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
   $errormsg = "";
   return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
});

//Route for submitting a new vehicle
Route::post('add_vehicle_action', function(){
   $errormsg = "";
   $rego = request('rego');
   $model = request('model');
   $year = request('year');
   $odometer = request('odometer');
   $seats = request('seats');
   if(!empty($rego) || !empty($model) || !empty($year) || !empty($odometer) || !empty($seats)){
      if(is_string($rego) == TRUE && strlen($rego) == 6){
         if(is_string($model) == TRUE && strlen($model) <= 50){
           if(is_numeric($year) == TRUE && $year >=2000 && $year <= 2021){
              if(is_numeric($odometer) && $odometer >=0 && $odometer <= 9999999){
                if(is_numeric($seats) == TRUE && $seats >= 4 && $seats <= 30){
                   $id = add_vehicle($rego, $model, $year, $odometer, $seats);
                   if($id) {
                      if(is_string($id)){
                        $errormsg = $id;
                        return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
                      }else{
                         return redirect("vehicle_detail/$id");
                      }
                   }else{
                     $errormsg = "Error while adding item. ";
                     return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
                  };
                }else{
                  $errormsg = "Error: Seats should be a number and between 4 and 30";
                  return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
                }
              }else{
               $errormsg = "Error: Odometer should be a number and between 0 and 9999999";
               return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
              }
           }else{
            $errormsg = "Error: Year should be a number and between 2000 and 2021!";
            return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
           }
         }else{
            $errormsg = "Error: Field model is too long!";
            return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
         }
      }else{
         $errormsg = "Error: Field rego have wrong format";
         return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
      }
   }else{
      $errormsg = "Error: Field should be fulfilled before submit";
      return view('vehicle.vehicle_add')->with('errormsg', $errormsg);
   };
   
});

//Vehicle_update page
Route::get('vehicle_update/{vehicle_id}', function($vehicle_id){
   $errormsg = "";
   return view('vehicle.vehicle_update')->with('id', $vehicle_id)->with('errormsg', $errormsg);
});

//Route for submitting changes for vehicle
Route::post('update_vehicle_action', function(){
   $errormsg = "";
   $id = request('id');
   $rego = request('rego');
   $model = request('model');
   $year = request('year');
   $odometer = request('odometer');
   $seats = request('seats');
   if(!empty($rego) || !empty($model) || !empty($year) || !empty($odometer) || !empty($seats)){
      if(is_string($rego) == TRUE && strlen($rego) == 6){
         if(is_string($model) == TRUE && strlen($model) <= 50){
           if(is_numeric($year) == TRUE && $year >=2000 && $year <= 2021){
              if(is_numeric($odometer) && $odometer >=0 && $odometer <= 9999999){
                if(is_numeric($seats) == TRUE && $seats >= 4 && $seats <= 30){
                    $msg = update_vehicle($id, $rego, $model, $year, $odometer, $seats);
                    if(!empty($msg)){
                       $errormsg = $msg;
                       return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
                    }else{
                       $vehicle = get_vehicle($id);
                       $orders = booking_list($id);
                       return view('vehicle.vehicle_detail')->with("vehicle", $vehicle)->with("orders", $orders);
                    }
                }else{
                  $errormsg = "Error: Seats should be a number and between 4 and 30";
                  return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
                }
              }else{
               $errormsg = "Error: Odometer should be a number and between 0 and 9999999";
               return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
              }
           }else{
            $errormsg = "Error: Year should be a number and between 2000 and 2021!";
            return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
           }
         }else{
            $errormsg = "Error: Field model is too long!";
            return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
         }
      }else{
         $errormsg = "Error: Field rego have wrong format";
         return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
      }
   }else{
      $errormsg = "Error: Field should be fulfilled before submit";
      return view('vehicle.vehicle_update')->with('id', $id)->with('errormsg', $errormsg);
   };

   //update_vehicle($id, $rego, $model, $year, $odometer, $seats);
      //$vehicle = get_vehicle($id);
      //$orders = booking_list($id);
     //return view('vehicle.vehicle_detail')->with("vehicle", $vehicle)->with("orders", $orders);
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
  $errormsg = "";
  $sql = 'select client_id, client_name from clients';
  $client_name = DB::select($sql);
  $sql = 'select vehicle_id, rego from vehicle';
  $vehicle_rego = DB::select($sql);
  return view('booking.booking_list')->with('clients', $client_name)->with('vehicle_rego', $vehicle_rego)->with('errormsg', $errormsg);
});

//Route for submitting a booking
Route::post('booking_action', function(){
  $errormsg = "";
  $client_id = request('id');
  $vehicle_id = request('rego');
  $start_date = request('startdate');
  $end_date = request('enddate');
  $client_name = get_client_name($client_id);
  $sql = 'select vehicle_id, rego from vehicle';
  $vehicle_rego = DB::select($sql);
  $start_date_timestamp = strtotime($start_date);
  $end_date_timestamp = strtotime($end_date);
  $currenttime = date('Y-m-d h:i:s', time());
  $currenttimestamp = strtotime($currenttime);
  $booking_date_list = get_booking_date($vehicle_id);
  if($start_date_timestamp < $currenttimestamp){
     $errormsg = "Error: Start date must be a date and time in the future!";
     return view('booking.booking_list')->with('clients', $client_name)->with('vehicle_rego', $vehicle_rego)->with('errormsg', $errormsg);
  }elseif($start_date_timestamp >= $end_date_timestamp){
     $errormsg = "Error: Returning date should later than the start date!";
     return view('booking.booking_list')->with('clients', $client_name)->with('vehicle_rego', $vehicle_rego)->with('errormsg', $errormsg);
  }else{
     if(!empty($booking_date_list)){
        foreach($booking_date_list as $order){
           $order_start_timestamp = strtotime($order->date_start);
           $order_end_timestamp = strtotime($order->date_end);
           if(($start_date_timestamp <= $order_end_timestamp && $end_date_timestamp >= $order_end_timestamp)|| ($end_date_timestamp >= $order_end_timestamp && $start_date_timestamp <= $order_start_timestamp) || ($start_date_timestamp >= $order_start_timestamp && $end_date_timestamp <= $order_end_timestamp) || ($start_date_timestamp <= $order_start_timestamp && $end_date_timestamp >= $order_end_timestamp)){
              $errormsg = "Error: The booking time your have submitted overlaps with other booking!";
              return view('booking.booking_list')->with('clients', $client_name)->with('vehicle_rego', $vehicle_rego)->with('errormsg', $errormsg);
           }  
        } 
        $id = booking_request($client_id, $vehicle_id, $start_date, $end_date);
        return view('booking.booking_success');
     }else{
        $id = booking_request($client_id, $vehicle_id, $start_date, $end_date);
        return view('booking.booking_success');
     };
  } 
});

//Page booking_return
Route::post('booking_return', function(){
  $errormsg = "";
  $id = request('id');
  return view('booking.booking_return')->with('id', $id)->with('errormsg', $errormsg);
});

//Route for return submitting
Route::post('booking_return_action', function(){
  $errormsg = "";
  $id = request('id');
  $odometer = request('odometer');
  if(is_numeric($odometer) && $odometer >=0 && $odometer <= 9999999){
     $vehicle_id = booking_return($id, $odometer);
     $vehicle = get_vehicle($vehicle_id);
     $orders = booking_list($vehicle_id);
     return view('vehicle.vehicle_detail')->with("vehicle", $vehicle)->with("orders", $orders);
  }else{
     $errormsg = "Error: Odometer should be a number not less than 0 and higher than 9999999!";
     return view('booking.booking_return')->with('id', $id)->with('errormsg', $errormsg);
  }
});

//Page vehicle_total
Route::get('vehicle_total', function(){
    //$time = date('Y-m-d h:i:s', time());
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
      return("Error: The vehicle with rego $rego is already exist!");
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
      return("Error: The vehicle with rego $rego is already exist!");
   };
};

//Function to delete a vehicle from the database
function delete_vehicle($id){
  $sql = 'delete from vehicle where vehicle_id = ?';
  DB::delete($sql, array($id));
};

function get_client_name(){
   $sql = 'select client_id, client_name from clients';
   $client_name = DB::select($sql);
   return($client_name);
};

//Function to insert booking to the orders table
function booking_request($client_id, $vehicle_id, $start_date, $end_date){
   $sql = 'insert into orders (client_id, vehicle_id, date_start, date_end, order_status) values(?, ?, ?, ?, TRUE)';
   DB::insert($sql, array($client_id, $vehicle_id, $start_date, $end_date));
   $id = DB::getPdo()->lastInsertId();
   return($id);
};

//function to query and list booking request for each cars
function booking_list($vehicle_id){
   $sql = 'select orders.order_id, orders.client_id, clients.client_name, clients.license_num, orders.date_start, orders.date_end 
   from orders,clients where orders.client_id = clients.client_id and orders.vehicle_id = ? and orders.order_status = TRUE order by orders.date_start';
   $orders = DB::select($sql, array($vehicle_id));
   if($orders){
     return($orders);
   }else{
      return("no booking request yet");
   }
};

function booking_return($id, $insert){
   $sql = 'select vehicle.vehicle_id,vehicle.odometer from orders, vehicle where orders.vehicle_id = vehicle.vehicle_id and orders.order_id = ?';
   $odometer = DB::select($sql, array($id));
   if(count($odometer) != 2){
     $new = $odometer[0]->odometer + $insert;
     $sql = 'update vehicle set odometer = ? where vehicle_id = ?';
     $vehicle_id = $odometer[0]->vehicle_id;
     DB::update($sql, array($new, $vehicle_id));
     $sql = 'update orders set order_status = FALSE where order_id = ?';
     DB::update($sql, array($id));
     return($vehicle_id);
   }else{
      die("Something has gone wrong, invalid query or result: $sql");
   };
};

function get_booking_date($vehicle_id){
   $sql = 'select date_start, date_end from orders where vehicle_id = ? and order_status = TRUE';
   $orders = DB::select($sql, array($vehicle_id));
   return($orders);
};

//Function for count total time
function time_amount(){
   
   //select datediff( hour,); select current_timestamp as 'current date and time'
};

/* function convert_date($date){
   $sql = "insert into test (summary) values (?)";
   DB::insert($sql, array($date));
   $id = DB::getPdo()->lastInsertId();
   return($id);
}; */