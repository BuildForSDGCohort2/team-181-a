@extends('layouts.app')

@section('content')


<my-header :user="{{ json_encode($auth_user) }}"></my-header>
<router-view :user="{{ json_encode($auth_user) }}"></router-view>


@endsection
