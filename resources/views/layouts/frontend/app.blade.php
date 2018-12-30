<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>

  <!-- <link href="{{ asset('css/app.css') }}"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Chicle|Fredoka+One|Luckiest+Guy|Mali|Merienda|Notable|Permanent+Marker');

    /*
        Some font options, some are too goofy ...? Not sure
        font-family: 'Notable', sans-serif;
        font-family: 'Chicle', cursive;
        font-family: 'Mali', cursive;
        font-family: 'Permanent Marker', cursive;
        font-family: 'Fredoka One', cursive;
        font-family: 'Merienda', cursive;
        font-family: 'Luckiest Guy', cursive;

    */
    body{
      overflow-x: hidden;
      font-family: 'Merienda', cursive;
    }

    .large-heading-left{
      font-size: 15rem;
    }

    .large-heading-right{
      font-size: 8rem;
    }

    .mid{
      padding-top: 18%;
    }

    @media only screen and (max-width: 1024px) {
      body{
        overflow-x: hidden;
      }

      .large-heading-left{
        padding-top: 15%;
        font-size: 15rem;
      }

      .large-heading-right{
        padding-top: 15%;
        font-size: 6rem;
      }

      .mid{
        padding-top: 10%;
      }

      /* For tables when vertical */
      .mid-right{
        padding-top: 14%;
      }
    }

    @media only screen and (max-width: 800px) {
      body{
        overflow-x: hidden;
      }

      .large-heading-left{
        font-size: 15rem;
      }

      .large-heading-right{
        font-size: 7rem;
      }

      .mid{
        padding-top: 10%;
      }

      /* For tables when vertical */
      .mid-right{
        padding-top: 14%;
      }
    }

    @media only screen and (max-width: 700px) {
      body{
        overflow-x: hidden;
      }

      .large-heading-left{
        font-size: 15rem;
      }

      .large-heading-right{
        font-size: 5rem;
      }

      .mid{
        padding-top: 10%;
      }
    }

    @media only screen and (max-width: 600px) {
      body{
        overflow-x: hidden;
      }

      .large-heading-left{
        font-size: 15rem;
      }

      .large-heading-right{
        font-size: 4.5rem;
      }

      .mid{
        padding-top: 10%;
      }
    }

    @media only screen and (max-width: 500px) {
      body{
        overflow-x: hidden;
      }

      .large-heading-left{
        font-size: 10rem;
      }

      .large-heading-right{
        font-size: 3rem;
      }

      .mid{
        padding-top: 5%;
      }
    }

  </style>

</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="/login">login</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    @yield('script')

</body>
</html>
