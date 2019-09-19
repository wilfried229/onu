<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('tab-title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/morris-bundle/morris.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/c3charts/c3.css')}}">
        @yield('extra-head')
        @yield('custom-css')
  </head>
  <body class="skin-green">
    <div class="wrapper">

        {{-- Header navbar --}}
    @include('partials.dashboard.navbar')
    {{-- Left sidebar --}}
    @include('partials.dashboard.sidebar')


      <!-- Left side column. contains the logo and sidebar -->


      <!-- Right side column. Contains the navbar and content of the page -->
      < <div class="dashboard-wrapper">
       
      @yield('header')
      @yield('content')

      @include('partials.dashboard.footer')

      </div><!-- /.content-wrapper -->





    @include('partials.dashboard.javascript')
@yield('extra-js')
@yield('custom-js')
    </body>
</html>
