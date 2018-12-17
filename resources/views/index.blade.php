@extends('layouts.frontend.app')

@section('content')


<div class="col-lg-12">
  <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 container mid">
      <h1 class="large-heading-left text-center font-weight-light" id="availableNumber">{{$count}}</h1>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 container mid mid-right text-center">
      <h1 class="large-heading-right text-center font-weight-light ">Rooms Available</h1>
    </div>
  </div>
</div>


@endsection


@section('script')

<script>

  $(document).ready(function() {

    // Set refresh timer
    let timer = setInterval(autoRefresh, 50000);
    let availableRooms = document.getElementById('availableNumber');

    function autoRefresh(){

      $.ajax({
        url:'ajax_room_count',
        type:'get',
        success: function(data){
          availableRooms.innerHTML = data;
        },
        error:function(){
          console.log('error' + data);
        }
      });
    }


  });

</script>

@endsection
