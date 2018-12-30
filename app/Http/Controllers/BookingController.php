<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Room;
use App\Guest;

class BookingController extends Controller
{
    protected $room;
    protected $guest;
    protected $guests;
    protected $meals;
    protected $fillable = [
        'title',
        'name',
        'surname',
        'request',
        'cell',
        'inputState'
    ];

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Return guest view with guests
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/guests/index')->with('guests', Guest::all());
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

        /*
        * Get the standard check in and check out time, stored in app file
        * and merge it with the check in and check out dates.
        */
        $checkIn = date("Y/m/d h:i:s", strtotime($request->input('check_in') . config('app.check_out')));
        $checkOut = date("Y/m/d h:i:s", strtotime($request->input('check_out') . config('app.check_in')));
        $this->guests = Guest::getAllGuest($request->input('room_id'));

        if (count($this->guests) > 0) {
            foreach ($this->guests as $guest) {
                // If the guests is checked in, between another guests stay, don't book room.
                if (strtotime($checkIn) >= strtotime($guest->check_in) && strtotime($checkIn) < strtotime($guest->check_out)) {
                    // If a guest is checked in at the same time as this guest, return back.
                    $request->session()->flash('status', "Guest, $guest->name $guest->surname, is already booked in between $guest->check_in and $guest->check_out.");
                    return redirect('check_in/'.$request->input('room_id'));
                } elseif (strtotime($checkOut) >= strtotime($guest->check_in) && strtotime($checkOut) < strtotime($guest->check_out)) {
                    // If a guest is checked in at the same time as this guest, return back.
                    $request->session()->flash('status', "Guest, $guest->name $guest->surname, is already booked in between $guest->check_in and $guest->check_out.");
                    return redirect('check_in/'.$request->input('room_id'));
                }
            }
        }

        // If no guests check in for this time frame, check in this guest.
        $this->guest = new Guest();
        $this->guest->title = $request->input('title');
        $this->guest->name = $request->input('name');
        $this->guest->surname = $request->input('surname');
        $this->guest->cell = $request->input('cell');
        $this->guest->email = $request->input('email');
        $this->guest->check_in = $checkIn;
        $this->guest->check_out = $checkOut;
        $this->guest->requests = $request->input('requests');
        $this->guest->accompanying = ($request->input('beds') - 1);

        // Check date, and if date is not today don't change to vacant
        $this->guest->vacant = 1;
        $this->guest->room_id = $request->input('room_id');
        $this->guest->eta = '14:00';

        $this->meals = $request->input('meals');
        if ($this->meals == 'none') {
            $this->guest->breakfast = 0;
            $this->guest->supper = 0;
        } elseif ($this->meals === 'Breakfast') {
            $this->guest->breakfast = 1;
            $this->guest->supper = 0;
        } elseif ($this->meals === 'Supper') {
            $this->guest->breakfast = 0;
            $this->guest->supper = 1;
        } else {
            $this->guest->breakfast = 1;
            $this->guest->supper = 1;
        }

        //Find the room for this guest then save guest details
        $this->room = Room::find($request->input('room_id'));
        $this->guest->cost_per_night = $this->room->cost_per_night;
        $this->guest->save();
        //Save room details
        $this->room->guest_id = $this->guest->id;
        $this->room->vacant = 1;
        $this->room->cleaned = 0;
        $this->room->save();
        // Return to room blade
        return  redirect('/admin/room/'.$this->room->id)->with('room', $this->room);
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
