@extends('layouts.app')

@section('content')

<v-app>
<my-header :user="{{ json_encode($auth_user) }}"></my-header>
<router-view :user="{{ json_encode($auth_user) }}"></router-view>
</v-app>

@endsection
