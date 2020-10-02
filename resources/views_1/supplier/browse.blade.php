@extends('layouts.home', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('The Famers
Assistant.')])

@section('content')
<v-app>
<my-supplier />
</v-app>
@endsection
