<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
  <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/stisla/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/stisla/css/components.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/quill.snow.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet" type="text/css"/>
  <title>Gamification</title>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      @include('layouts.report_navbar')
        <div>
          @yield('content')
        </div>

    </div>
  </div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/stisla/js/stisla.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

@yield("scripts")
</html>
