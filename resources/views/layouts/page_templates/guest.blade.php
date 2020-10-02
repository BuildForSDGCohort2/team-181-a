@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page" style="background: linear-gradient(0deg, rgb(0, 0, 0), rgba(12, 12, 12, 0.55)) center top / cover, url(/material/img/login.jpg);">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('material') }}/img/login.jpg'); background-size: cover; background-position: top center;align-items: center;" data-color="purple">
  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>
