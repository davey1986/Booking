@foreach($reservations as $room)

  <div class="col-lg-4 col-md-4">

    <!-- Start of card -->
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2 mt-2">
      <a href="admin/room/{{$room->id}}" class="border-secondary" >
      <div class="card-header">
        <div class="row">
          <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="apple-mini-left" >{{$room->name}}</h4>
          <h6 class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="apple-mini" style="float:right!important;">
              <span style="color: #931621; font-weight: bold; float:right!important;"><u>Occupied</u> </span>
          </h6>
        </div>

      </div>
      <div class="card-body text-secondary">

      </div>
      </a>
    </div> <!-- End of card -->

  </div>
@endforeach
