@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-sx-12">
                                <h4>Available between {{$checkIn}} and {{$checkOut}}</h4>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h3><a href="/dashboard" style="float:right;">Back</a> </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"></div>
                </div>
                <!-- Start of room block -->
                <div class="container col-lg-12 col-md-12">
                    <div class="row">
                        <div id="searchRooms"></div>
                        @foreach($rooms as $room)
                            <div class="col-lg-4 col-md-4">
                                <!-- Start of card -->
                                <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2 mt-2">
                                    <a href="/admin/room/{{$room->id}}" class="border-secondary" >
                                        <div class="card-header">
                                            <div class="row">
                                                <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="apple-mini-left">{{$room->name}}</h4>
                                                <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="float:right!important;"></h6>
                                            </div>
                                        </div>
                                        <div class="card-body text-secondary">
                                            <h5 class="card-title">Number of beds: {{$room->beds}}</h5>
                                            <hr />
                                            <p class="card-text">Cost for the room: {{$room->cost_per_night}}</p>
                                        </div>
                                    </a>
                                </div> <!-- End of card -->
                            </div>
                        @endforeach
                    </div>
                </div> <!-- End of room block -->
            </div> <!-- Start of row div -->
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
