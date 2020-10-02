@extends('layouts.app', ['activePage' => 'broods-table', 'titlePage' => __('Broods List')])

@section('content')
<div class="content">

<my-brood :broods="{{ $broods }}" />
</div>
@endsection
