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
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
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
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'animals-table'||$activePage== 'animal-show'||$activePage== 'animal-show' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('animals_table') }}">
          <i class="material-icons">pets</i>
            <p>{{ __('My Animals') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'plants-table'||$activePage == 'plants-info' ||$activePage == 'plants-show' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('plants_table') }}">
          <i class="fa fa-pagelines "></i>
            <p>{{ __('My Plantations') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('To Do....') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('Support') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>