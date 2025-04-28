<!DOCTYPE html>
<html>

<head>
<style>

    .nav-item .nav-link:hover {
        background-color: #d6d6d6;
        color: white;
        border-color: #007bff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px); /* Slight upward movement */
        text-decoration: none; /* Removing underline */
    }

  

    .time-text {
        opacity: 1;
    }

    .nav-item .nav-link:hover .time-text {
        opacity: 0.8; /* Slight fade effect on hover */
    }
</style>
    @include('dashboard.layouts.head')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('dashboard.layouts.navbar')

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('dashboard.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('dashboard.layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('dashboard.layouts.scripts')

</body>

</html>
