<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use DateTime;

use App\Room;
use App\Guest;
use App\Reservation;

class RoomController extends Controller
{

    use SoftDeletes;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['facilities', 'rooms']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/index');
    }


    /**
     * Search for available rooms.
     *
     * @return \App\rooms
     */
     public function ajax_room_search($checkIn, $checkOut){

        $NotAvailable = new Collection();
        //Perfect this Dave
        $NotAvailable = Guest::where('check_in', '>=', $checkIn)->get();
        $plucked = $NotAvailable->pluck('room_id')->toArray();

        $rooms = Room::whereNotIn('id', $plucked)->get();

        $checkIn = date("l jS \of F Y", strtotime($checkIn));
        $checkOut = date("l jS \of F Y", strtotime($checkOut));

        // Maybe return $checkIn and Check out as days? Example Monday 28th
        return view('admin/search')->with('rooms', $rooms)->with('checkIn', $checkIn)->with('checkOut', $checkOut);

     }

    /**
     * Search for available rooms.
     *
     * @return \view\search_room
     */
     public function search(Request $request){

        $request->validate([
          'check_in' => 'required|date',
          'check_out' => 'required|date|after:check_in',
        ]);

        $today = date("Y-m-d");
        $checkIn = date("Y/m/d h:i:s", strtotime($request->input('check_in') . config('app.check_out') ) );
        $checkOut = date("Y/m/d h:i:s", strtotime($request->input('check_out') . config('app.check_in') ));

        $NotAvailable = Guest::where(function ($query) use($checkIn, $checkOut, $today){
            $query->where('vacant', '>', 0)
                  ->where('check_in', '<=', $checkOut)
                  ->where('check_out', '>=', $checkIn);
        })->get();

        $plucked = $NotAvailable->pluck('room_id')->toArray();

        $rooms = Room::whereNotIn('id', $plucked)->get();

        foreach ($rooms as $room) {

          $guests = Guest::getAllGuest($room->id, "desc");
          if(count($guests) > 0 ){

            foreach($guests as $guest){

              if($guest->check_in <= $today && $guest->check_out >= $today){

                $room['type'] = 'current';
                $room['cost'] = RoomController::roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);
                $room['guests'] = $guest->name;
                $room['guest_lastname'] = $guest->surname;
                $room['checkout'] = $guest->check_out;
                $room['vacant'] = $guest->vacant;
                $room['cleaned'] = $guest->cleaned;

              }elseif($guest->check_in > $today ){

                $room['type'] = 'future';
                $room['cost'] = $room->cost_per_night;

              }else{

                $room['type'] = 'warning';
                $room['cost'] = $room->cost_per_night;

              }
            }

          }else{
            $room['vacant'] = 0;
          }

        }

       return view('dashboard')->with('rooms', $rooms);

     }


     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('admin/add');
     }

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = new Room();
        $room->name = $request->input('room_name');
        $room->beds = $request->input('number_of_beds');
        $room->cost_per_night = $request->input('cost_per_night');
        $room->save();

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $room = Room::find($id);
        $room['check_out'] = config('app.check_out');
        $room['check_in'] = config('app.check_in');
        $room['alert'] = 0;
        $room['cost'] = 0;

        $today = date("Y-m-d " .$room['check_in']. '00');
        $guests = Guest::getAllGuest($room->id);

        if(count($guests) > 0 ){

          foreach($guests as $guest){

            if( date($guest->check_in) <= date($today) && date($guest->check_out) >= date($today) ){

              $guest['type'] = 'current';
              //Get the cost of the room
              $room['cost'] = $this->roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);

            }elseif(date($guest->check_in) > date($today) ){

              $guest['type'] = 'future';
              $room['cost'] = $this->roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);

            }else{

              $guest['type'] = 'warning';
              $room['cost'] = $this->roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);

            }

          } /* foreach($guests as $guest){ */

        } /* if(count($guests) > 0 ){ */

        return view('admin/room')->with(['room' => $room, 'guests' => $guests ]);

    }

    /*
    * Remove checkIn status from a guest
    *
    * @param  int  $room_id
    * @param  int  $guest_id
    * @return \Illuminate\Http\Response
    */
    public function check_out($room_id, $guest_id){

      $room = Room::find($room_id);
      $guest = Guest::find($guest_id);

      if(isset($guest->id)){

        $guest->vacant = 0;
        $guest->save();

      }

      return redirect('admin/room/'.$room->id);

    }


    /*
    * Remove reservation, and softDelete guest so record doesn't show in guest blade
    *
    * @param  int  $room_id
    * @param  int  $guest_id
    * @redirect \Illuminate\Http\Response
    */
    public function cancel_reservation($room_id, $guest_id){

      $room = Room::find($room_id);
      $guest = Guest::find($guest_id);
      if(isset($guest->id)){

        // Assign guest to checked out, so as not to create confusion if softdeleted guests are ever read in
        $guest->vacant = 0;
        $guest->save();
        $guest->delete();

      }

      return redirect('admin/room/'.$room->id);

    }


    /*
    * Remove the clean room check
    *
    * @param  int  $room_id
    * @return \Illuminate\Http\Response
    */
    public function clean_room($room_id){

      $room = Room::find($room_id);

      $room = Room::find($room_id);
      $room->cleaned = 1;
      $room->save();

      return redirect('admin/room/'.$room_id);
    }


    /**
     * Show a single room
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function check_in($room_id){

      $room = Room::find($room_id);

      return view('admin/checkin')->with('room', $room);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  int  $beds
     * @return \Illuminate\Http\Response
     */
    public function updateBeds($id, $beds)
    {
      $room = Room::find($id);
      $room->beds = $beds;
      $room->save();

      return $beds;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  float  $cost
     * @return \Illuminate\Http\Response
     */
    public function update($id, $cost)
    {
      $costforStay = 0;
      $room = Room::find($id);
      $room->cost_per_night = $cost;
      $room->save();

      $guest = Guest::find($room['guest_id']);
      if(isset($guest) ){
        $costforStay = $this->roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);
      }

      return $costforStay;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $guests = Guest::getAllGuest($id);
        // Check no guests are booked into this room.
        if($guests->count() == 0 ){

          $room = Room::find($id);
          $room->destroy($id);

          return redirect('dashboard');
        }else{
          session()->flash('status', "Guests are still booked into to this room. Please check out guests first. ");
          return redirect('/admin/room/'.$id);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  float $cost
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prices($id, float $cost){
      $room = new Room($id);
      $room->cost_per_night = $cost;
      $room->save();

      return view('admin/room')->with('room', $room);
    }


    /**
     * Return the cost of a room for duration of guests stay
     *
     * @param  date $checkOut
     * @param  date $checkIn
     * @param  float $cost_per_night
     * @return \Illuminate\Http\Response
     */
    public static function roomCost($checkOut, $checkIn, $cost_per_night){
      // Create variables
      $days = 0;
      $cost = 0;

      $check_out = strtotime( $checkOut );
      $check_in = strtotime( $checkIn );
      $check_out_day = date('d', $check_out);
      $check_in_day = date('d', $check_in);
      $check_out_month = date('m', $check_out);
      $check_in_month = date('m', $check_in);
      $check_out_year = date('y', $check_out);
      $check_in_year = date('y', $check_in);


      $check_in = mktime(0,0,0,$check_in_month, $check_in_day, $check_in_year);
      $check_out = mktime(0,0,0,$check_out_month,$check_out_day,$check_out_year);
      $days =  floor( ($check_out - $check_in ) / ( 24 * 60 * 60 ) )  ;
      // If a new months starts a day is skipped.
      if($check_in_month < $check_out_month){
        $days += 1;
      }
      $cost = (int)$days * (float)$cost_per_night;

      return $cost;
    }

}
