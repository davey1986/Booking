<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Only load data tables if needed -->
    @if(\Request::is('admin/guests/index'))
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    @endif

    <style>
      @media only screen and (max-width: 1024px) {
        #apple-mini, #apple-mini-left{
          font-size: 12px;
        }
      }

      .card {
          /* Add shadows to create the "card" effect */
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
          transition: 0.3s;
      }

      /* On mouse-over, add a deeper shadow */
      .card:hover {
          box-shadow: 0 8px 18px 0 rgba(0,0,0,0.4);
      }

      /* Add some padding inside the card container */
      .container {
          padding: 2px 16px;
      }

      .card-no-hover {
          /* Remove effects */
          box-shadow: 0 0  0 rgba(0,0,0,0.0);
      }

      .point {
        cursor: pointer;
      }

      .show{
        display: block;
      }

      .hidden{
        display: none;
      }

      .lineOfIn{
        display: inline;
      }

      .lineOfIn li{
        display: inline;
      }

      .vertical-menu {
        width: 150px;
      }

      .vertical-menu a {
        background-color: #eee;
        color: black;
        display: block;
        padding: 12px;
        text-decoration: none;
      }

      .vertical-menu a:hover {
        background-color: #ccc;
      }

      .vertical-menu a.active {
        background-color: #4CAF50;
        color: white;
      }

      .right{
        float: right!important;
      }

      .card-stretch{
        max-width: 18rem;
      }

      .move{
        color:#778189;
        font-weight: bold;
        float: right;
      }

      .check-in-button{
        background-color:#1c3144;
      }

      @media only screen and (max-width: 740px) {
        .card-stretch{
          max-width: 30rem;
        }

        .card-header h1{
          font-size: 28px;
        }
        .card-header h2{
          font-size: 26px;
        }
        .card-header h3{
          font-size: 24px;
        }

        h4.card-text {
          font-size: 16px;
        }

        .btn-info{
          font-size: 16px;
        }

        .move{
          float: left;
        }
      }

      .card-footer{
        background: linear-gradient(-174deg, #377A9B, #383241);
        color: white;
        font-weight: 700;
      }

      .card-footer-warning{
        background: linear-gradient(96deg, #4D252E, #D76D6E);
        background: linear-gradient(-55deg, #564C61, #BC2542);
        background: linear-gradient(52deg, #B5081A, #B50811);
        background: linear-gradient(-56deg, #7D2028, #FFBD2C);
      }

      .check-out {
        background: linear-gradient(-174deg, #377A9B, #383241);
        color: white;
        font-weight: 700;
      }

      .one-third {
        width: 33%;
        float: left;
        display: block;
        padding: 20px 15px;
      }


      .card-rounded-footer{
        border-bottom-left-radius: 18px!important;
        border-bottom-right-radius: 18px!important;
      }

      .vacant-color{
        background: linear-gradient(-174deg, #A2E6E3 , #82BB30);
        /* background-color: #82BB30; */
      }

      .warning-color{
        background: linear-gradient(149deg, #CD401C, #61486A);
        background: linear-gradient(-56deg, #7D2028, #FFBD2C);
      }

      .clean-color{
        color: #fbfff1;
        background: linear-gradient(134deg, #4FBB76, #6FE927);
        background: linear-gradient(-163deg, #89EC5E, #539DF7);
      }
      @media only screen and (min-width: 740px) {
        .right-border-wall{
          border-right: 2px solid #778189;
          height: 100%;
        }

      }

      @media only screen and (max-width: 740px) {
        .one-third {
          width: 100%;
        }

      }

      .center-text{
        text-align:center;
      }


      .header-warning{
        background: linear-gradient(57deg, #E91827, #653C07);
      }

      .card:link{
        text-decoration: none;
      }

      .bg-reserved{
        /* background-color: #5a7d7c; */
        background: linear-gradient(-151deg, #51706f, #5a7d7c);
      }

      .bg-open{
        /* background-color: #a0c1d1; #76c659 */
        /* background-color: #84dd63; */
        background: linear-gradient(-151deg, #76c659, #84dd63);
      }

      .bg-occupied{
        /* background-color: #08b2e3; */
        background: linear-gradient(-151deg, #07a0cc, #08b2e3);
      }

      .bg-double{
        /* background-color: #E91827; */
        background: linear-gradient(-151deg, #A62A35, #E44B4A);
      }


      @media only screen and (max-width: 740px) {
        .danger h2{
          font-size: 22px;
          color:red;
        }

        .halffu{
          width:50%;
          max-width:50%;
        }
      }

      /*Animate CSS Hinge effect*/
      @-webkit-keyframes hinge {
        0% {
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
        }

        20%,
        60% {
          -webkit-transform: rotate3d(0, 0, 1, 80deg);
          transform: rotate3d(0, 0, 1, 80deg);
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
        }

        40%,
        80% {
          -webkit-transform: rotate3d(0, 0, 1, 60deg);
          transform: rotate3d(0, 0, 1, 60deg);
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
          opacity: 1;
        }

        to {
          -webkit-transform: translate3d(0, 700px, 0);
          transform: translate3d(0, 700px, 0);
          opacity: 0;
        }
      }

      @keyframes hinge {
        0% {
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
        }

        20%,
        60% {
          -webkit-transform: rotate3d(0, 0, 1, 80deg);
          transform: rotate3d(0, 0, 1, 80deg);
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
        }

        40%,
        80% {
          -webkit-transform: rotate3d(0, 0, 1, 60deg);
          transform: rotate3d(0, 0, 1, 60deg);
          -webkit-transform-origin: top left;
          transform-origin: top left;
          -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
          opacity: 1;
        }

        to {
          -webkit-transform: translate3d(0, 700px, 0);
          transform: translate3d(0, 700px, 0);
          opacity: 0;
        }
      }

      .hinge {
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -webkit-animation-name: hinge;
        animation-name: hinge;
      }

      #easter-egg{
        -webkit-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -ms-user-select: none;
      }

    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Laravel not reading jQuery code, so this is a temp fix -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Only load data tables if needed -->
    @if(\Request::is('admin/guests/index'))
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    @else
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    @yield('script')

</body>
</html>
