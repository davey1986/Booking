@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="card mt-2">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    <h1>Guests</h1>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <h3><a href="/dashboard" style="float:right;">Back</a> </h3>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>

      </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="card mt-2">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                </div>

              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">

              </h5>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table class="table table-striped table-hover table-light" id="guestTable">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Surname</th>
                      <th scope="col">Check In</th>
                      <th scope="col">Check Out</th>
                      <th scope="col">Charged per night</th>
                      <th scope="col">Accompanying</th>
                      <th scope="col">Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($guests as $guest)

                      <tr onclick="window.location='/admin/guests/view/{{$guest->id}}';" >
                        <th scope="row">{{$guest->name}}</th>
                        <td>{{$guest->surname}}</td>
                        <td>{{$guest->check_in}}</td>
                        <td>{{$guest->check_out}}</td>
                        <td>{{$guest->cost_per_night}}</td>
                        <td>{{$guest->accompanying}}</td>
                        <td>{{$guest->room['name']}}</td>
                      </tr>

                    @endforeach

                  </tbody>
                </table>

              </div>

            </div>
          </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>

$(document).ready( function () {
    $('#guestTable').DataTable();
} );

</script>
@endsection
