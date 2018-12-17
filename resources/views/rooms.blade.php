@extends('layouts.frontend.app')

@section('content')

<section class="bg-dark col-lg-12">
  <div id="photo"></div>
  <!-- JavaScript call for photos-->
  <script>

    var counter = 11;
    for (i = 1; i <= counter; i++) {

      var output = '<a class="photo-basic col-lg-4 col-md-6 col-sm-6 col-xs-12" data-lightbox="photo-set" href="img/full-size/Comfort Zone-'
            + i + '.jpg " ><img src="img/resize/ComfortZone'
            + i + '-50.jpg " alt="Rooms" width="100%" height="300"></a>';

      document.getElementById('photo').innerHTML += output;
    }
  </script>
</section>
<br />
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="top">
  <br />
  <a href="#page-top">
  <i class="fa fa-arrow-circle-o-up fa-4x" aria-hidden="true"></i>
  </a>
</div>
  <section id="contact" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <!-- Contact Us -->
  <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <h2 class="section-heading">Let's Get In Touch!</h2>
                  <hr class="primary">
              </div>
          </div>
      </div>

  <div class="col-lg-12">
    <div>
      <!-- Phone Box -->
      <div class="col-lg-3  text-center">
        <i class="fa fa-phone fa-3x sr-contact"></i>
        <p>Phone: 083 279 0454</p>
      </div>
      <!-- Email Box -->
      <div class="col-lg-3 text-center">
        <i class="fa fa-envelope-o fa-3x sr-contact"></i>
        <p><a href="mailto:comfortzone@imaginet.co.za">comfortzone@imaginet.co.za</a></p>

      </div>
      <!-- Address Box -->
      <div class="col-lg-3 text-center"> <!-- col-lg-offset-2 -->
        <i class="fa fa-home fa-3x sr-contact"></i>
        <p>24 Willow drive, Fortgale, Mthatha</p>
      </div>
      <!-- Fax Box -->
      <div class="col-lg-3 text-center">
        <i class="fa fa-fax fa-3x sr-contact"></i>
        <p>Fax: 047 532 2201</p>
      </div>
    </div>
  </div>
  <!-- Google Maps -->
  <div id="googleMap" style="width:90%; height:300px; margin-left: auto; margin-right: auto; "></div>
  </section>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="js/scrollreveal.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/jquery.fittext.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="js/creative.js"></script>

<!-- Lightbox -->
<script src="light/dist/js/lightbox-plus-jquery.min.js"></script>

<!-- Google Maps API, center is Comfort Zone Mthatha (-31.5798207,28.7628619) -->
<script
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAuXkPOOexS1Vzd3U98DQk0hOh6WnCKy3k">
</script>
<script>
  /* Map Position */
  var myCenter=new google.maps.LatLng(-31.5798207,28.7628619);
  /*end*/
  function initialize()
  {
  /* Zooma, Map type and centering */
  var mapProp = {
    center:myCenter,
    zoom:18,
    panControl:true,
    zoomControl:true,
    zoomControlOptions: {
      style:google.maps.ZoomControlStyle.DEFAULT
    },
    mapTypeControl:true,
    scaleControl:true,
    streetViewControl:true,
    overviewMapControl:true,
    rotateControl:true,
    mapTypeId:google.maps.MapTypeId.HYBRID
    };
  /*end*/
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  map.setTilt(50);
  /* Maker */
  var marker=new google.maps.Marker({
    position:myCenter,
    });

  marker.setMap(map); /*->  Need to view marker*/
  }
  /*Maker end*/
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endsection
