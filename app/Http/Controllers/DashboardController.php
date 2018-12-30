<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Guest;


class DashboardController extends Controller
{
    //properties
    protected $rooms;
    protected $check_in;
    protected $check_out;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['facilities', 'rooms', 'roomCount']]);
        $this->check_in = config('app.check_in');
        $this->check_out = config('app.check_out');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->rooms = Room::all();
        $today = date("Y-m-d " .$this->check_in. '00');

        //Foreach through rooms and assign guest
        foreach ($this->rooms as $room) {
            $guests = Guest::getAllGuest($room->id, "desc");
            if (count($guests) > 0) {
                foreach ($guests as $guest) {
                    if (date($guest->check_in) <= date($today) && date($guest->check_out) >= date($today)) {
                        $room['type'] = 'current';
                        $room['cost'] = RoomController::roomCost($guest->check_out,$guest->check_in, $room->cost_per_night);
                        $room['guests'] = $guest->name;
                        $room['guest_lastname'] = $guest->surname;
                        $room['checkout'] = $guest->check_out;
                        $room['vacant'] = $guest->vacant;
                        $room['cleaned'] = $guest->cleaned;
                    } elseif (date($guest->check_in) > date($today)) {
                        $room['type'] = 'future';
                        $room['cost'] = $room->cost_per_night;
                    } else {
                        $room['type'] = 'warning';
                        $room['cost'] = $room->cost_per_night;
                    }
                }
            } else {
                $this->room['vacant'] = 0;
            }
        }
        return view('dashboard')->with('rooms', $this->rooms);
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
     * Test blade, use this to replicate a function for testing
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
    public function roomCount()
    {
        return view('index')->with('count', Room::roomCount());
    }
}
