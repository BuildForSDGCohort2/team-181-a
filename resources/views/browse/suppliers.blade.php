@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <my-supplier :users="{{ json_encode($users) }}" />
      </div>
    </div>
  </div>
@endsection

