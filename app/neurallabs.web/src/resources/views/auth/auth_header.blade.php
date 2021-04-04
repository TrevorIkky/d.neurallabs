<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Neural-Labs-Tb-Api') }}</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
      rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />


    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ asset('assets/css/sleek.css') }}" />

    <!-- FAVICON -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="shortcut icon" />




    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{ asset('assets/plugins/nprogress/nprogress.js') }}"></script>
  </head>

</head>

<body class="" id="body">
  @if ($errors->any())
  <div class="p-3" style="background-color: red; color: white;" class="row">
    <h6>We encountered the following issues...</h6>
    @foreach ($errors->all() as $error)
    <ol class="mr-3">
      <li>{{ $error}}</li>
    </ol>
    @endforeach
  </div>
  @endif

  <div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">

      <div class="col-xl-5 col-lg-6 col-md-10">
        <div class="card">
          <div class="card-header bg-primary">
            <div class="app-brand">
              <a href="/index.html">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                  height="33" viewBox="0 0 30 33">
                  <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>
                <span class="brand-name">{{ config('app.name', 'Neural-Labs-Tb-Api') }}</span>
              </a>
            </div>
          </div>
          @yield('content')
          @include('auth.auth_footer')