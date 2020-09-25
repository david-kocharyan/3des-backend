<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3Des Admin Panel | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    @stack('header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <b>{{ Auth::user()->name }}</b>
                    <span>&#9660;</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <i class="fa fa-power-off"></i> Logout
                                </h3>
                            </div>
                        </div>
                    </a>
                    <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <img src="{{asset('admin/dist/img/logo.png')}}" alt="3DES" width="200px">
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="/contact-us" class="nav-link">
                            <i class="nav-icon fas fa-phone-alt"></i>
                            <p>
                                Contact Us
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/subscribers" class="nav-link">
                            <i class="nav-icon fas fa-share-alt"></i>
                            <p>
                                Subscribers
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/video" class="nav-link">
                            <i class="nav-icon fas fa-video"></i>
                            <p>
                                Video
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/faqs" class="nav-link">
                            <i class="nav-icon fas fa-question"></i>
                            <p>
                                FAQ
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/partners" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Partners
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/coupons" class="nav-link">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>
                                Coupons
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="/shipping-methods" class="nav-link">
                                    <i class="fas fa-shipping-fast"></i>
                                    <p>Shipping Methods</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/taxes" class="nav-link">
                                    <i class="fas fa-percent"></i>
                                    <p>Taxes</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 ">

                        @yield('content')

                    </section>
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <footer class="main-footer text-center">
        <strong>Copyright &copy; 2020 <a href="https://aimtech.am">Aimtech LLC</a>.</strong>
        All rights reserved.
    </footer>
</div>

</body>
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- SWAL -->
<script src="{{asset('admin/plugins/swal/sweetalert.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('admin/dist/js/custom.js')}}"></script>

@stack('footer')
</html>
