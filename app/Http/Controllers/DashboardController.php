<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Guest;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['facilities', 'rooms', 'roomCount']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rooms = Room::all();
        $room['check_out'] = config('app.check_out');
        $room['check_in'] = config('app.check_in');
        $today = date("Y-m-d " .$room['check_in']. '00');

        foreach ($rooms as $room) {

          $guests = Guest::getAllGuest($room->id, "desc");

          if(count($guests) > 0 ){

            foreach($guests as $guest){

              if( date($guest->check_in) <= date($today) && date($guest->check_out) >= date($today) ){

                $room['type'] = 'current';
                $room['cost'] = RoomController::roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);
                $room['guests'] = $guest->name;
                $room['guest_lastname'] = $guest->surname;
                $room['checkout'] = $guest->check_out;
                $room['vacant'] = $guest->vacant;
                $room['cleaned'] = $guest->cleaned;

              }elseif(date($guest->check_in) > date($today) ){

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
     * Future use
     *
     * @return \Illuminate\Http\Response
     */
    public function facilities()
    {

      return view('facilities');

    }


    /**
     * Test blade
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {

      return view('/test');

    }

    /**
     * Show available rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomCount(){

      $count = Room::roomCount();
      return view('index')->with('count', $count);

    }

}
