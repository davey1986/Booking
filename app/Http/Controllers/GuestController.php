<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;


class GuestController extends Controller
{
    protected $guests;

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
     * Display all guests
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->guests = Guest::all();
        return view('admin/guests/index')->with('guests', $this->guests);
    }


    /**
     * Display a specified guest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->guests = Guest::where('id','=',$id)->first();
        return view('admin/guests/view')->with('guest', $this->guests);
    }


}
