<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Dixie Philamerah Atay">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'HSG Portal') }}</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->

  <div id="app">
    <app></app>
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <form method="POST" action="{{ route('logout') }}" id="logout-form">
      @csrf
  </form>

  @javascript('allthedata', $allthedata)
  <script type="text/javascript" src="{{ mix('js/app.compiled.min.js') }}"></script>
</body>

</html>
