<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Guest;


class Room extends Model
{

    protected $rooms;
    //Relationships

    /**
    * Get the rooms
    */
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    /**
    * Get the rooms
    */
    public function room()
    {
        return $this->hasMany(Room::class);
    }

    /* Count available rooms
    *
    * @return available rooms
    */
    public static function roomCount()
    {
        $count = 0;
        $today = date("Y-m-d ");
        $rooms = Room::all();
        $count = count($rooms);
        //Loop through rooms, and if a guest checked in minus from count
        foreach ($rooms as $room) {
            $guest = Guest::getCurrentGuest($room->id, "desc");
            if (isset($guest)) {
                if (date($guest->check_in) <= date($today) && date($guest->check_out) >= date($today)) {
                    $count--;
                }
            }
        }
        return $count;
    }
}
