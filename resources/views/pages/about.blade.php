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


    <div class="page-header header-filter header-small" data-parallax="true" style="background: linear-gradient(0deg, rgba(42, 147, 31, 0.859), rgba(15, 148, 8, 0.804)), url(https://jimmy.dev/material/img/wheat.jpg);;background-repeat-x: repeat;min-height: 100px;">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h1 class="title" style="
              color: #fff;">About Us</h1>
              <h4>The Farmers Assistant.</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="main main-raised">
        <div class="container">
          <div class="about-description text-center">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                <h5 class="description text-primary">The Platform thats is all about the African <span class="text-success">Farmer</span> For the African People.</h5>
              </div>
            </div>
          </div>
          <div class="about-services features-2">
            <div class="row">
              <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">What We Have To Offer</h2>
                <h5 class="description">The platform will connect the <span class="text-success">Farmer</span> , to the proffesionals, suppliers and Customers</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">emojipeople</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title"> The <span class="text-success">Farmers</span></h4>
                    <p>A <span class="text-success">Farmer</span>, registered or not will be able to gain from this platform in the following ways .
                      <h5> Unregistered <span class="text-success">Farmers</span>.</h5>
                      <strong>Unregistered</strong> <span class="text-success">Farmer</span>s will can <span class="text-warning">Query </span> the system and or the  <span class="text-primary">proffesionals</span> via the <span class="text-success">USSD</span> services and a <strong class="text-info">SMS<span></span></strong> Reply will be availed conatining the queried data.
                      <br>
                      <h5> Registered <span class="text-success">Farmer</span>s.</h5>
                      Apart Form the USSD querring ability , The <span class="text-success">Farmer</span> will recieve prompts and alerts , that will advice him or her according to the <span class="tesxt-succes"><span class="text-success">Plants</span></span>  or <span class="text-primary">Animals</span>  he or she is rearing.
                    </p>

                  </div>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">emojischool</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">Proffesionals</h4>
                    <p>
                      For a Supplier to be Part of this Great case, he or she must avail the necessary <span class="text-primary">Documents</span> For Qualification reasons. if the proffessional papers check out , an account is created. The account will enable the Vet to get request alerts and sms from farmers and also provide <span class="text-info">advice</span> to <span class="text-success">farmers</span> .
                    </p>

                  </div>
                </div>
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons">emojiapartment</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">Suppliers</h4>
                    <p>
                      For a Supplier to be Part of this Great case, he or she must avail the necessary <span class="text-primary">Documents</span> For legality reasons. if the suppliers papers check out , an account is created. The account will enable the supplier to get request alerts and sms from farmers  be it for farm inputs or transport requests.
                    </p>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info info-horizontal">
                  <div class="icon icon-rose">
                    <i class="material-icons"> emojiadd_shopping_cart</i>
                  </div>
                  <div class="description">
                    <h4 class="info-title">3. Customers</h4>
                    <p>
                      The customer can now Buy <span class="text-primary">Tested </span> and <span class="text-warning">Verified</span> Animals and Crop Produce and have them delivered to them at <span class="text-info">Home</span> or pick them at a local station
                    </p>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <footer class="footer">
        <div class="container">
            <nav class="float-left">
            <ul>

                <li>
                <a href="/">
                    {{ __('Back') }}
                </a>
                </li>

            </ul>
            </nav>
            <div class="copyright float-right">
            &copy;
            <script type="application/javascript">
                document.write(new Date().getFullYear())
            </script>, Made with <i class="material-icons">favorite</i> ,For A Happier
            <a href="/" style="color: green"><span class="text-success">Farmer</span></a> and A Happier Better Africa.
            </div>
        </div>
    </footer>



</body>

</html>
