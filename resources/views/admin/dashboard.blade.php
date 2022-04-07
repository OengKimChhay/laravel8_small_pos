<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">
    <img src="" alt="Logo" style="width:40px;">
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-home fa-lg mr-1"></span>Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}"><span class="fa fa-user fa-lg mr-1"></span>User</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('products.index')}}"><span class="fa fa-truck fa-lg mr-1"></span>Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('ordersDetail.index')}}"><span class="fa fa-list fa-lg mr-1"></span>Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-money fa-lg mr-1"></span>Transaction</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-files fa-lg mr-1"></span>Reports</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-desktop fa-lg mr-1"></span>Cashier</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-users fa-lg mr-1"></span>Customers</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#"><span class="fa fa-chart fa-lg mr-1"></span>Suppliers</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Dropdown link
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Link 1</a>
            <a class="dropdown-item" href="#">Link 2</a>
            <a class="dropdown-item" href="#">Link 3</a>
        </div>
        </li>
    </ul>
  </div>
</nav>
<!-- end nav -->
<div class="m-2"><marquee behavior="" direction="rtl"><h3>WELCOME PRODUCTS MANAGMENT POS</h3></marquee></div>

  @yield('content')

<!-- for jquery -->
<script src="{{asset('jquery-3.6.0/jquery-3.6.0.min.js')}}"></script>  
  @yield('script')
</body>
</html>