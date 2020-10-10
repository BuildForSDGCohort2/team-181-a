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


    <div class="page-header header-filter header-small" data-parallax="true" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.52), rgba(0, 0, 0, 0.34)), url(https://jimmy.dev/material/img/wheat.jpg);;background-repeat-x: repeat;min-height: 100px;">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h1 class="title" style="
              color: #fff;">About Us</h1>
              <h4>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="main main-raised">
        <div class="container">
          <div class="about-description text-center">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <h5 class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum, at hic! Tenetur harum, ab commodi rerum ut voluptatum</h5>
              </div>
            </div>
          </div>
          <div class="about-services features-2">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">We build awesome products</h2>
                <h5 class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed velit, adipisci blanditiis illum, beatae doloremque ratione, reprehenderit dignissimos animi nostrum aliquid iure veritatis inventore laborum accusantium error magnam officia vitae!</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">gesture</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">1. Farmers</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime odio tempore corrupti, eos ipsum iste provident quisquam quibusdam sed perferendis porro repudiandae illo exercitationem quasi aut numquam consectetur distinctio officia.</p>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">build</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">2. Suppliers</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo similique sit, libero, modi quae praesentium quisquam repellat id maxime doloremque iusto. Deserunt debitis totam magnam ratione. Repellat velit ipsa consequatur?</p>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">mode_edit</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">3. Customers</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo similique sit, libero, modi quae praesentium quisquam repellat id maxime doloremque iusto. Deserunt debitis totam magnam ratione. Repellat velit ipsa consequatur?</p>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- @include('layouts.footers.guest') --}}
    <footer class="footer">
        <div class="container">
            <nav class="float-left">
            <ul>

                <li>
                <a href="/about-us">
                    {{ __('About Us') }}
                </a>
                </li>

            </ul>
            </nav>
            <div class="copyright float-right">
            &copy;
            <script type="application/javascript">
                document.write(new Date().getFullYear())
            </script>, Made with <i class="material-icons">favorite</i> ,For A Happier
            <a href="/" style="color: green">Farmer</a> and A Happier Better Africa.
            </div>
        </div>
    </footer>



</body>

</html>
