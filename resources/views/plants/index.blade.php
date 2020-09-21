@extends('layouts.app', ['activePage' => 'plants-table', 'titlePage' => __('Plants List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
      <div class="col-md-12">
        <my-plantation />
      </div>
    </div>
  </div>
</div>
@endsection
