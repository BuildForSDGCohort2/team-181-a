@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('The Famers Assistant.')])

@section('content')
<div class="container" style="background: black !important,height: auto;">
  <div class="row c">
      <div class="col-lg-7 col-md-8 text-center">
          <h1 class="text-white text-center">{{ __("The Farmer's Assistant.") }}</h1>
      </div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px; margin:0.1px; ">
          <h3>Agricultural Services</h3>
          <hr style="height: 1px;background-color: white; border: none;">
          <i class="fa fa-thermometer-full" style="font-size: 48px" aria-hidden="true"></i>
          <a href="{{ route('register') }}">
            <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal; "> <i class="material-icons">person_add</i> Register as A <span style="color: rgb(255, 179, 0)">proffessional</span> </button> 
          </a>
          <p style="padding-top: 20%">  
            Farmers Can now seek Veterinary services and slso field extention services on this platform.
            A Group of Readily available Professionals are readily available.
          </p>
      </div>
      <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px; margin:0.1px;">
        <h3>Agricultural Products</h3>
        <hr style="height: 1px;background-color: white; border: none;">
        <i class="fa fa-envira" style="font-size: 48px" aria-hidden="true"></i>
        <a href="{{ route('register') }}">
        <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; "> <i class="material-icons">person_add</i> Register as A <span style="color: greenyellow">farmer</span> </button> 
        </a>
        <p style="padding-top: 20%">
          The Farmer of couse is the center of our Sysytem. 
          When The produce is ready the farmer will get a Notification from the system alerting him/her to this very fact. 
          If comfortable the farmer will confirm the notification, and the system will automatically post the product for sale. 
        </p>
      </div>
      <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px;margin:0.1px; ">
        <h3>Agricultural Supplies</h3>
        <hr style="height: 1px;background-color: white; border: none;">
        <i class="material-icons" style="font-size:42px;">sync</i>
        <a href="{{ route('register') }}">
          <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; "> <i class="material-icons">person_add</i> Register as A <span style="color: rgb(243, 162, 12)">Supplier</span> </button>         <p style="padding-top: 20%">
        </a>

          Suppliers Too can enroll in this system. The system will coodinate the Buying of thr various farm inputs needed. the farmer will only worry about the farm, all the logistics wil be handled by his 'Assistant'.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
