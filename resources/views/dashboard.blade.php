@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- <div class="row"> -->
            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12 halffu">
                      <h2 id="easter-egg">Rooms</h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12  halffu">
                      <div class="dropdown" style="float:right;">
                        <a class="btn btn-primary dropdown-toggle" type="button" id="rooms" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Options
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="room_add">Add a Room</a>
                          <a class="dropdown-item" href="admin/guests/index">All Guests</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="text"></div>
                  <form class="form-inline" id="checkInSubmit" action="search_room">
                    @csrf
                    @method('POST')
                    <div class="form-group col-lg-4 col-md-4 col-sm-3 col-xs-12">
                      <label for="date" class="control-label">Check In Date : </label>
                      <input type="date" class="form-control" id="check_in" name="check_in">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-3 col-xs-12">
                      <label for="date" class="control-label">Check Out Date : </label>
                      <input type="date" class="form-control" id="check_out" name="check_out">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-info btn-lg btn-block" value="Check In"> Check for a Room </button>
                    </div>
                  </form>
                </div>
            </div>
            <!-- Start of room block -->
            <div class="container col-lg-12 col-md-12">
              <div class="row">
                <div id="searchRooms">
                </div>
                @foreach ($rooms as $room)
                  @if ($room['type'] == 'current')
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="admin/room/{{$room->id}}" class="card card-stretch border-light mb-2 mt-2" >
                      <div class="card-header bg-occupied" > <!-- style="background-color:#b26e63;" -->
                        <div class="row">
                          <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini-left" style="color: #fff;">{{$room->name}}</h4>
                          <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini" style="float:right!important;">
                              <span style="color: #fff; font-weight: bold; float:right!important;"><u>Occupied</u> </span>
                          </h6>
                        </div>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">{{$room['guests']}}</h5>
                        <p class="card-text">{{$room->beds}} beds</p>
                      </div>
                    </a>
                  </div>
                  @elseif($room['type'] == 'future')
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="admin/room/{{$room->id}}" class=" card card-stretch border-light mb-2 mt-2">

                      <div class="card-header bg-reserved" > <!-- style="background-color:#829399;" -->
                        <div class="row">
                          <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini-left" style="color: #fff;">{{$room->name}}</h4>
                          <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini" style="float:right!important;">
                              <span style="color: #fff; font-weight: bold; float:right!important;"><u>Reserved</u> </span>
                          </h6>
                        </div>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">R{{$room->cost_per_night}} per night</h5>
                        <p class="card-text">{{$room->beds}} beds</p>
                      </div>
                    </a>
                  </div>
                  @elseif($room['type'] == 'warning')
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="admin/room/{{$room->id}}" class="card card-stretch border-light mb-2 mt-2">
                      <div class="card-header bg-double"> <!-- header-warning -->
                        <div class="row">
                          <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini-left" style="color: #fff;">{{$room->name}}</h4>
                          <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini" style="float:right!important;">
                              <span style="color: #fff; font-weight: bold; float:right!important;"><u>Warning</u> </span>
                          </h6>
                        </div>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">R{{$room->cost_per_night}} per night</h5>
                        <p class="card-text">{{$room->beds}} beds</p>
                      </div>
                    </a>
                  </div>
                  @else
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="admin/room/{{$room->id}}" class="card card-stretch border-light mb-2 mt-2" >
                      <div class="card-header bg-open" > <!-- style="background-color:#b1cc74;" -->
                        <div class="row">
                          <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini-left" style="color: #fff;" >{{$room->name}}</h4>
                          <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 halffu" id="apple-mini" style="float:right!important;">
                              <span style="color: #fff; font-weight: bold; float:right!important;"><u>Open</u> </span>
                          </h6>
                        </div>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">R{{$room->cost_per_night}} per night</h5>
                        <p class="card-text">{{$room->beds}} beds</p>
                      </div>
                    </a>
                  </div>
                  @endif
                @endforeach
              </div>
            </div> <!-- End of room block -->
          <!-- </div> Start of row div -->
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
  // Happy hunting, maybe more else where.
  let eggs = 0;
  $('#easter-egg').on('click', function(event){
    eggs++;
    if(eggs == 7){
      $(this).addClass('animated hinge');
      eggs = 0;
    }
    if(eggs == 2){
      $(this).removeClass('animated hinge');
    }

  });
</script>
@endsection
