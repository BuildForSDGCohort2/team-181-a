@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('The Famers Assistant.')])

@section('content')
<div class="container" style="background: black !important,height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __("The Farmer's Assistant.") }}</h1>
      </div>
  </div>
</div>
@endsection
