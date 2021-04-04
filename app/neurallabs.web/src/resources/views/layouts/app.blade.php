<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

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
    <link href="{{asset('assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <link href="assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet" />
    <link href="assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet" />


    <!-- No Extra plugin used -->

    <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{asset('assets/css/sleek.css')}}" />

    <!-- FAVICON -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" />



    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{asset('assets/plugins/nprogress/nprogress.js')}}"></script>
    <style>
        .dt-head-center,
        .dt-center {
            text-align: center;
        }
    </style>
</head>

<link href="{{ asset('assets/plugins/ladda/ladda.min.css') }}" rel="stylesheet" />

<body class="header-fixed sidebar-fixed sidebar-light header-light compact-spacing" id="body">

    <script>
        NProgress.configure({ showSpinner: false });
    NProgress.start();
    </script>

    <div id="toaster"></div>


    <div class="wrapper">
        <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="/index.html" title="{{ config('app.name', 'Neural-Labs-Tb-Api') }}">
                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                            width="30" height="33" viewBox="0 0 30 33">
                            <g fill="none" fill-rule="evenodd">
                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                            </g>
                        </svg>
                        <span class="brand-name text-truncate">{{ config('app.name', 'Neural-Labs-Tb-Api') }}</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">

                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">



                        <li>
                            <a class="sidenav-item-link" href="{{route('dashboard')}}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Dashboard</span> <b class="caret"></b>
                            </a>

                        </li>


                        @can('viewAdminDashboardElements', Auth::user())
                        <li>
                            <a class="sidenav-item-link" href="{{route('manage_users')}}">
                                <i class="mdi mdi-account-group-outline"></i>
                                <span class="nav-text">Manage Users</span> <b class="caret"></b>
                            </a>

                        </li>

                        <li>
                            <a class="sidenav-item-link" href="{{route('manage_api_tokens')}}">
                                <i class="mdi mdi-shield-key-outline"></i>
                                <span class="nav-text">Api Tokens</span> <b class="caret"></b>
                            </a>

                        </li>
                        @endcan
                    </ul>

                </div>

                <div class="sidebar-footer"></div>

            </div>
        </aside>


        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <div class="search-form d-none d-lg-inline-block">
                        <div class="input-group">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <input type="text" name="query" id="search-input" class="form-control"
                                placeholder="requests, invite, tokens ..." autofocus autocomplete="off" />
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>

                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">
                            <!-- User Account -->
                            <li class="right-sidebar-2-menu">
                                <i href="#" class="mdi mdi-account dropdown-toggle nav-link" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- User image -->
                                    <li class="dropdown-header">
                                        <div class="d-inline-block">
                                            {{ Auth::user()->name}} <small
                                                class="pt-1">{{ Auth::user()->email }}</small>
                                        </div>
                                    </li>


                                    <li>
                                        <form action="{{ url('/logout')}}" method="post">
                                            <button class="p-2 mb-2 ml-2" type="submit">Sign Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="right-sidebar-in right-sidebar-2-menu">
                                <i class="mdi mdi-settings mdi-spin"></i>
                            </li>

                        </ul>
                    </div>
                </nav>


            </header>

            @yield('content')

            @include('layouts.footer')