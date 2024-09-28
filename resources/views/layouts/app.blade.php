<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CScorp LLC | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.header')

        @include('layouts.sidebar')
        <!-- Include the header -->

        <div class="content-wrapper">
            <!-- Main Content Section -->
            @yield('content')
        </div>

    </div>

    <script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('asset/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('asset/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('asset/dist/js/demo.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script>
        $(document).ready(function() {
            let $profile = $('.profile');
            let $menu = $('.menu');

            $profile.on('click', function() {
                $menu.toggleClass('active');
            });
        });
    </script>
</body>

</html>
