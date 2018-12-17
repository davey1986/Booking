@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


        <div class="card mb-3 card-rounded-footer">
          <div class="card-header warning-color ">

              <h3 > Occupied</h3>

          </div>
          <div class="card-header center-text">
            <h2>Guest: dave</h2>
          </div>
          <div class="card-body" style="text-align:center;">
            <div class="left" style="text-align:left;">

              <p class="card-text">No contact details available!</p>

                <p class="card-text">Breakfast & Supper</p>

              <p class="card-text">Check-in: </p>
              <p class="card-text">Check-in: </p>

            </div>

          </div>

          <div class="card-footer-warning bg-transparent border-success card-rounded-footer" style="text-align:center; ">
            <div class="row">
              <div class="one-third right-border-wall">
                <div ><h4>Total cost for stay : </h4></div>
                <div ><h4 >R<a id="totalCost">2533.33</a></h4></div>
              </div>

              <a href="/check_out/" class="one-third right-border-wall " style="color:white;">
                <div > <h4>Check out: </h4> </div>
                <div ><h4>adsa Vincent</h4></div>
              </a>

              <div class="one-third ">
                <div > <h4>Room</h4> </div>
                <div class=""><h4>Cleaned</h4> </div>
              </div>
            </div>

          </div>
        </div> <!-- End of Card -->


      </div>
  </div>
</div>


@endsection

@section('script')

@endsection
