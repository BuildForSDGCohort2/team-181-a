<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('T.FA.') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        @if (!auth()->user()->hasRole('vet')&&!auth()->user()->hasRole('feo')&&!auth()->user()->hasRole('supplier'))
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
                <p>{{ __('Dashboard') }}</p>
            </a>
        </li>
        @endif
        <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#user_management" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/user.svg"></i>
          <p>{{ __('User Operations') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="user_management">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
          @can('admin')
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          @endcan

          </ul>
        </div>
      </li>
      @can('farmer_permisions','vet_permissions')
      <li class="nav-item{{ $activePage == 'animals-table'||$activePage== 'animal-show'||$activePage== 'animal-show' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('animal.index') }}">
          <i class="material-icons">pets</i>
            <p>{{ __('My Animals') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'broods-table'||$activePage == 'broods-info' ||$activePage == 'brood-show' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('brood.index') }}">
          <i class="fa fa-bold" aria-hidden="true"></i>
          <p>{{ __('My Broods') }}</p>
        </a>
      </li>
      @endcan
      @can('farmer_permisions','feo_permissions')
      <li class="nav-item{{ $activePage == 'plants-table'||$activePage == 'plants-info' ||$activePage == 'plants-show' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('plant.index') }}">
          <i class="fa fa-pagelines "></i>
          <p>{{ __('My Plantations') }}</p>

        </a>
      </li>
      @endcan

      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{auth()->user()->hasRole('admin')?route('notifications'):(auth()->user()->hasRole('reciever')?route('receivers_dash'):route('issues')) }}">
          <i class="material-icons">notifications</i>
          <p>{{ auth()->user()->hasRole('supplier')|| auth()->user()->hasRole('customer')?'My orders':'To Do' }}</p>
        </a>
      </li>
      @can('farmer_permisions')
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="">
          <i class="material-icons">Support</i>
          <p>{{ __('Support') }}</p>
        </a>
      </li>
      @endcan

    </ul>
  </div>
</div>
