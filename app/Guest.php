<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{

  use SoftDeletes;

  /**
   * Softdelete attribute
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  // Relationships
  public function room(){
    return $this->belongsTo(Room::class);
  }

  /* Gets the current guest
  *
  * @param integer $room_id
  * @return Guest
  */
  public static function getCurrentGuest($room_id){

    $guest = Guest::where('room_id','=', $room_id)->where('vacant', '>', 0)->first();
    return $guest;

  }


  /* Gets the All guest
  *
  * @param integer $room_id
  * @param chracter $order - can be null
  * @return Guests
  */
  public static function getAllGuest($room_id, $order="asc"){

    $guests = Guest::where('room_id','=', $room_id)->where('vacant', '>', 0)->orderBy('check_in',$order)->get();
    return $guests;

  }

  /* Gets the All guest reservations
  *
  * @param integer $room_id
  * @param integer $guest_id - can be null
  * @return Guest
  */
  public static function getAllfutureGuest($room_id, $guest_id = NULL){

    if(isset($guest_id) ){
      $guests = Guest::where('room_id','=', $room_id)->where('vacant', '>', 0)->whereNotIn('id',[$guest_id])->orderBy('check_in','asc')->get();
    }else{
      $guests = Guest::where('room_id','=', $room_id)->where('vacant', '>', 0)->orderBy('check_in','asc')->get();
    }

    return $guests;

  }


}
