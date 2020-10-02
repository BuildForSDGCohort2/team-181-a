<div class="wrapper ">
  @if (! auth()->user()->hasRole('customer'))
  <div class="main-panel" >
    @include('layouts.navbars.sidebar')     
  @else
    <div class="main-panel" style="width: 95%;padding-right:48px;" >  
  @endif
  
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>