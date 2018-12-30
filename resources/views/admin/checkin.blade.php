@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('inc/alert')
            <div class="card mt-2">
                <div class="card-header">
                    <h3> {{$room->name}}  <a href="/admin/room/{{$room->id}}" style="float:right;">Back</a> </h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Fill in Guest details</h5>
                    <form method="post" action="{{ route('check_in_guest') }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="room_id" name="room_id" value="{{$room->id}}">
                        <div class="form-row mb-1">
                            <div class="col col-md-2 col-sm-12 col-xs-12">
                                <label for="formGroupExampleInput">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Guest title Mr. Mrs. etc">
                            </div>
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label for="formGroupExampleInput2">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Guest Name">
                            </div>
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <label for="formGroupExampleInput2">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Guest Surname">
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col">
                                <label for="formGroupExampleInput2">Requests</label>
                                <textarea type="text" class="form-control" rows="10"  id="request" name="request" placeholder="Special Requests"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 mb-1">
                                    <label for="formGroupExampleInput2">Cell Phone</label>
                                    <input type="text" class="form-control" id="cell" name="cell" placeholder="Cell Phone Number">
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="formGroupExampleInput2">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group col-md-12 mb-1">
                                    <label for="meals">Kitchen Options</label>
                                    <select id="meals" name="meals" class="form-control">
                                        <option selected>Breakfast</option>
                                        <option>Supper</option>
                                        <option>Breakfast & Suppper</option>
                                        <option>None</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 mb-1">
                                    <label for="beds">How many guests in room</label>
                                    <select id="beds" name="beds" class="form-control">
                                        <?php
                                            $i = 1;
                                            while ($i <= $room->beds) {
                                                if ($i == 1) {
                                                    echo '<option selected>'.$i.'</option>';
                                                } else {
                                                    echo '<option>'.$i.'</option>';
                                                }
                                                $i++;
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="date" class="control-label">Check In Date</label>
                                    <input type="date" class="form-control" id="check_in" name="check_in">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="date" class="control-label">Check Out Date</label>
                                    <input type="date" class="form-control" id="check_out" name="check_out">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" class="btn btn-info btn-block btn-lg" value="Check In">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
