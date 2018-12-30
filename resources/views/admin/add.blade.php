@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('inc/alert')
            <div class="card mt-2">
                <div class="card-header">
                    <h3> New Room Details  <a href="/dashboard" style="float:right;">Back</a> </h3>
                </div>
                <div class="card-body">
                    <form action="room_store" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="room_name">Room Name:</label>
                            <input type="text" placeholder="Room Name" class="form-control" id="room_name" name="room_name" required>
                        </div>
                        <div class="form-group">
                            <label for="cost_per_night">Cost of Room per night:</label>
                            <input type="number" step=".01" min="0" class="form-control" id="cost_per_night" name="cost_per_night" required>
                        </div>
                        <div class="form-group">
                            <label for="number_of_beds">Beds in Room:</label>
                            <select id="number_of_beds" name="number_of_beds" class="form-control" required>
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col col-md-12 col-sm-12 col-xs-12">
                                <input type="submit" class="btn btn-info btn-block btn-lg" value="Create Room">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
