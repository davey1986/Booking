<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;


class GuestController extends Controller
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $guests = Guest::all();

      return view('admin/guests/index')->with('guests', $guests);
    }



    /**
     * Display a specified guest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $guest = Guest::where('id','=',$id)->first();
      return view('admin/guests/view')->with('guest', $guest);
    }


}
