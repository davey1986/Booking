<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Guest;

class BookingController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
  */
  public function __construct()
  {
      $this->middleware('auth');
  }


  protected $fillable = [
    'title',
    'name',
    'surname',
    'request',
    'cell',
    'inputState'
  ];

    /**
     * Return guest view with guests
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::all();

        return view('admin/guests/index')->with('guests', $guests);
    }


    /**
     * Store a booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $request->validate([
        'title'=>'Nullable',
        'name'=> 'required|string',
        'surname'=> 'required|string',
        'request'=> 'Nullable|string',
        'cell'=> 'required',
        'email'=> 'Nullable|email',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'beds' => 'Nullable|integer'
      ]);


      // Gett the standard check in and check out time, stored in app file
      // and merge it with the check in and check out dates.
      $checkIn = date("Y/m/d h:i:s", strtotime($request->input('check_in') . config('app.check_out') ) );
      $checkOut = date("Y/m/d h:i:s", strtotime($request->input('check_out') . config('app.check_in') ));

      $guests = Guest::getAllGuest($request->input('room_id'));

      if(count($guests) > 0 ){

        foreach($guests as $guest){

          // If the guests is checked in, between another guests stay, don't book room.
          if(strtotime($checkIn) >= strtotime($guest->check_in) && strtotime($checkIn) < strtotime($guest->check_out) ){

            // If a guest is checked in at the same time as this guest, return back.
            $request->session()->flash('status', "Guest, $guest->name $guest->surname, is already booked in between $guest->check_in and $guest->check_out.");
            return redirect('check_in/'.$request->input('room_id') );

          }elseif (strtotime($checkOut) >= strtotime($guest->check_in) && strtotime($checkOut) < strtotime($guest->check_out) ) {
            // If a guest is checked in at the same time as this guest, return back.
            $request->session()->flash('status', "Guest, $guest->name $guest->surname, is already booked in between $guest->check_in and $guest->check_out.");
            return redirect('check_in/'.$request->input('room_id') );
          }

        }

      }

      // If no guests check in for this time frame, check in this guest.
      $guest = new Guest();

      $guest->title = $request->input('title');
      $guest->name = $request->input('name');
      $guest->surname = $request->input('surname');
      $guest->cell = $request->input('cell');
      $guest->email = $request->input('email');
      $guest->check_in = $checkIn;
      $guest->check_out = $checkOut;
      $guest->requests = $request->input('requests');
      $guest->accompanying = ($request->input('beds') - 1);

      // Check date, and if date is not today don't change to vacant
      $guest->vacant = 1;
      $guest->room_id = $request->input('room_id');
      $guest->eta = '14:00';
      //$guest->accompanying = $request->input('accompanying');

      $meals = $request->input('meals');
      if($meals == 'none'){
        $guest->breakfast = 0;
        $guest->supper = 0;
      }elseif ($meals === 'Breakfast') {
        $guest->breakfast = 1;
        $guest->supper = 0;
      }elseif ($meals === 'Supper') {
        $guest->breakfast = 0;
        $guest->supper = 1;
      }else{
        $guest->breakfast = 1;
        $guest->supper = 1;
      }

      $room = Room::find($request->input('room_id'));
      $guest->cost_per_night = $room->cost_per_night;

      $guest->save();

      $room = Room::find($request->input('room_id'));
      $room->guest_id = $guest->id;
      $room->vacant = 1;
      $room->cleaned = 0;
      $room->save();

      return  redirect('/admin/room/'.$room->id)->with('room', $room);
    }


    /**
     * Future use for editing a booking...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Future use for updating a booking ...
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
