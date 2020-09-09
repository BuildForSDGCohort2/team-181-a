@extends('layouts.app')

@section('content')
    <router-view :user="{{ json_encode($auth_user) }}"></router-view>

        <my-header :user="{{ json_encode($auth_user) }}"></my-header>
@endsection
