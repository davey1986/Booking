@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Flash and Error messages -->
            @include('inc/alert')
            <div class="card mt-2">
                <div class="card-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5" style="width:50%; max-width:50%;">
                            <h2>{{$room->name}}</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 " style="width:50%; max-width:50%;">
                            <div class="dropdown right" >
                                <a class="btn btn-primary dropdown-toggle right" type="button" id="rooms" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Room Options
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/admin/room_delete/{{$room->id}}">Delete a Room</a>
                                    <a class="dropdown-item point"  id="priceOfroom" >Change Room prices</a>
                                    <a class="dropdown-item point"  id="bedsInRoom" >Change Room beds</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2 center-text" >
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4 style=" font-weight: bold; ">Cost per night: R<a id="cost">{{$room->cost_per_night}}</a> </h4>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4 style=" font-weight: bold; ">Beds in room: <a id="totalBeds">{{$room->beds}}</a> </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="/check_in/{{$room->id}}" class="btn btn-primary btn-block btn-lg check-in-button" >Check in guest </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @foreach($guests as $guest)
                    @if( $guest['type'] == 'current' )
                        <div class="card mb-3 card-rounded-footer">
                            <div class="card-header check-out">
                                @if($guest->vacant)
                                    <h3 > Occupied</h3>
                                @else
                                    <h3 > Vacant </h3>
                                @endif
                            </div>
                            <div class="card-header center-text">
                                <h2 style="color:#778189; font-weight: bold;"><a href="/admin/guests/view/{{$guest->id}}">{{$guest->title}} {{$guest->name}} {{$guest->surname}}</a></h2>
                            </div>
                            <div class="card-body" style="text-align:center;">
                                <div class="left" style="text-align:left;">
                                    <!-- Contact details -->
                                    @if(isset($guest->cell))
                                        <p class="card-text">Mobile number: {{$guest->cell}}</p>
                                    @elseif(isset($guest->email))
                                        <p class="card-text">Email: {{$guest->email}}</p>.
                                    @else
                                        <p class="card-text">No contact details available!</p>
                                    @endif
                                    <!-- Breakfast and Supper -->
                                    @if($guest->breakfast && $guest->supper)
                                        <p class="card-text">Breakfast & Supper</p>
                                    @elseif($guest->breakfast)
                                        <p class="card-text">Breakfast Only</p>
                                    @elseif($guest->supper)
                                        <p class="card-text">Supper Only</p>
                                    @endif
                                    <p class="card-text">Check-In: {{$guest->check_in}}</p>
                                    <p class="card-text">Check-Out: {{$guest->check_out}}</p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-success card-rounded-footer" style="text-align:center; ">
                                <div class="row">
                                    <div class="one-third right-border-wall">
                                        <div ><h4>Total cost for stay : </h4></div>
                                        <div ><h4 >R<a id="totalCost">{{$room->cost}}</a></h4></div>
                                    </div>
                                    <a href="/check_out/{{$room->id}}/{{$guest->id}}" class="one-third right-border-wall">
                                        <div><h4>Check out: </h4></div>
                                        <div><h4>{{$guest->title}} {{$guest->name}} {{$guest->surname}}</h4></div>
                                    </a>
                                    <div class="one-third ">
                                        @if($room->cleaned)
                                            <div > <h4>Room</h4> </div>
                                            <div class=""><h4>Cleaned</h4> </div>
                                        @else
                                        <a href="/clean_room/{{$room->id}}">
                                            <div class="">
                                                <h4>Room</h4>
                                                <h3>Not Cleaned</h3>
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End of Card -->

                    @elseif ($guest['type'] == 'future')

                        @if (count($guest) == 0)
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <span style="font-weight: bold; text-align:center;">
                                                    <h3>No reservations for this room.</h3>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Future Guests section -->
                        @endif
                        <!--Start Future Guests section -->
                        @if (count($guest) > 0)
                        <div class="row justify-content-center mt-3">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card mt-2 ">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reserved text-center">
                                                            <h3>Reservation</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                            <h2 style="color:#778189; font-weight: bold;"><a href="/admin/guests/view/{{$guest->id}}">{{$guest->title}} {{$guest->name}} {{$guest->surname}}</a></h2>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h4 style=" color: #1b1b1e; font-weight: bold;">Check-in: {{$guest->check_in}}  </h4>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h4 style=" color: #1b1b1e; font-weight: bold;">Check-out: {{$guest->check_out}} </h4>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1 mb-2 text-center">
                                                            <h3 class="card-text">Cost of stay : R <a id="totalCost">{{$room->cost}}</a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body-->
                                    <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <a href="/cancel_reservation/{{$room->id}}/{{$guest->id}}" class="btn btn-warning btn-block btn-lg">Cancel Reservation</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Future Guests section -->
                        @endif
                    @else
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card mt-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 text-center danger">
                                            <h2 class="">Guest hasn't been checked out. </h2>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <h2 style="color:#778189; font-weight: bold;"><a href="/admin/guests/view/{{$guest->id}}">{{$guest->title}} {{$guest->name}} {{$guest->surname}}</a></h2>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h4 style=" color: #1b1b1e; font-weight: bold;">Check-in: {{$guest->check_in}}  </h4>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h4 style=" color: #1b1b1e; font-weight: bold;">Check-out: {{$guest->check_out}} </h4>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1 mb-2 text-center">
                                                        <h2 class="card-text">Total cost for stay : R <a id="totalCost">{{$room->cost}}</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a href="/check_out/{{$room->id}}/{{$guest->id}}" class="btn btn-primary btn-block btn-lg">Check out guest </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Future Guests section -->
                    @endif
                @endforeach
            </div>
        </div> <!-- <div class="row justify-content-center"> -->
    </div> <!-- End Main section -->

    <!-- Modal -->
    <div class="modal fade" id="room" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10-col-xs-10">
                                <h4 class="modal-title" style="float:left;">Update Room Details</h4>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <button type="button" class="close" data-dismiss="modal" style="float:right;">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="modalForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="price" id="text">Cost of Room per night:</label>
                            <input type="number" step=".01" min="0" value="{{$room->cost_per_night}}" class="form-control" id="price">
                            <input type="beds" value="{{$room->beds}}" class="form-control" id="beds">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>

    var option = '';
    $('.cancel-reservation').on('click', function( event ){
        event.preventDefault();
        alert($(this).val());
    });

    $('#bedsInRoom').on('click', function(){
        var text = document.getElementById('text');
        var beds = document.getElementById('beds');
        var price = document.getElementById('price');
        text.innerHTML = "Beds in Room: ";
        $(beds).removeClass('hidden');
        $(beds).addClass('show');
        $(price).addClass('hidden');
        option = 'beds';
        $('#room').modal('show')
    });

    $('#priceOfroom').on('click', function(){
        var text = document.getElementById('text');
        var beds = document.getElementById('beds');
        var price = document.getElementById('price');
        text.innerHTML = "Cost of Room per night: ";
        $(price).removeClass('hidden');
        $(beds).addClass('hidden');
        $(price).addClass('show');
        option = 'price';
        $('#room').modal('show')
    });

    $(document).on('submit', '#modalForm', function( event ){
        event.preventDefault();
        var price = document.getElementById('price').value;
        var beds = document.getElementById('beds').value;
        var cost = document.getElementById('cost');
        var totalBeds = document.getElementById('totalBeds');
        var totalCost = document.getElementById('totalCost');

        if (option == 'price') {
            $.ajax({
                url:'/ajax_room_price/'+ {{$room->id}} + '/' + price,
                type:'get',
                data: {"_token": "{{ csrf_token() }}"},
                success: function(data) {
                    cost.innerHTML= price;
                    $('#room').modal('hide');
                        //Update the room total stay cost, if room cost is changed while a guest is in the room.
                        if(totalCost != undefined){
                        totalCost.innerHTML = data;
                    }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            });

        } else {

            $.ajax({
                url:'/ajax_room_bed/'+ {{$room->id}} + '/' + beds,
                type:'get',
                data: {"_token": "{{ csrf_token() }}"},
                success: function(data) {
                    totalBeds.innerHTML= beds;
                    $('#room').modal('hide');
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            });
        } /* }else{ */
    });

</script>

@endsection
