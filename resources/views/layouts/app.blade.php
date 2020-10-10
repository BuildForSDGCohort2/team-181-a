<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
     name='viewport' />

    <title>{{ __('The Farmers Assistant') }}</title>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('material') }}/css/material-dashboard.css" rel="stylesheet" />
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png"> --}}
    {{-- <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png"> --}}
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <script src="{{ asset('js/app.js') }}" defer type="application/javascript"></script>

</head>

<body class="{{ $class ?? '' }}">
        <div id="app"  v-loading="loading"
        element-loading-text="Loading..."
        element-loading-spinner="el-icon-loading"
        element-loading-background="rgba(0, 0, 0, 0.8)">
            @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @include('layouts.page_templates.auth')
            @endauth
            @guest()
            @include('layouts.page_templates.guest')
            @endguest


  <v-snackbar v-model="snackbar" v-html="text">
    {{-- @{{ text }} --}}
    <template v-slot:action="{ attrs }">
        <v-btn color="red" text v-bind="attrs" @click="snackbar = false">
            Close
        </v-btn>
    </template>
</v-snackbar>
    </div>


    <!--   Core JS Files   -->
    <script type="application/javascript" src="{{ asset('material') }}/js/core/jquery.min.js"></script>

    <script type="application/javascript">
        $(document).ready( function() {
        $("#loadOverlay").css("display","none");
        });
    </script>


    <script type="application/javascript" src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script type="application/javascript" src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js">
    </script>
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js">
    </script>
    <!-- Plugin for the momentJs  -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js">
    </script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
    <!-- Chartist JS -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script type="application/javascript" src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script type="application/javascript" src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1"
        type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script type="application/javascript" src="{{ asset('material') }}/demo/demo.js"></script>
    <script type="application/javascript" src="{{ asset('material') }}/js/settings.js"></script>
    @stack('js')
</body>

</html>
