@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Tasks</p>
              <h3 class="card-title">{{count($proffesionals)+count($suppliers)}}
                <small>Requests</small>
              </h3>
            </div>
            <div class="card-footer">
              {{-- enable the db to auto calculations --}}
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
               {{-- would calculate the number from the confirmed orders --}}
              <h3 class="card-title">Ksh 34,245</h3>
            </div>
            <div class="card-footer">
              {{-- date of last harvest --}}
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              {{-- done Tasks will be displayed here--}}
              <p class="card-category">Pending Orders</p>
              {{-- Will check be updated fromm the database --}}
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                 View pending orders
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fa fa-handshake-o "></i>
              </div>
              <p class="card-category">On Board</p>
            <h3 class="card-title">+{{count($latest_logins)-1}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          {{-- this chart eill display :
            Daily dairy sales for the farmer , 
            Monlthly Births for the vet, 
            Suggest something for the Field extention oficer,
            And maybe the daily orders from farmers a supplier has recieved
              --}}
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Logins</h4>
              <p class="card-category">
                {{-- calculate the percentage and sisplay --}}
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today Logins.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                {{-- The last access time will the creation date read the last entry on the orders list --}}
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              {{-- this will display the :
                Number of orders completed for the farmer  and the supplier accounts ,
                Number of completed home cals for both the field ext officer and the Vet  --}}
              <h4 class="card-title">Completed Orders In The Last Year </h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> From January last year
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              {{-- This will contain the Number of deaths on:
                The farmers Animals
                The Vets 'Patients'
                Loss on a field That a Field ext officer had worked on--}}
              <h4 class="card-title">Losses </h4>
              <p class="card-category">Losses</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Pending Aprovals</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#vets" data-toggle="tab">
                        <i class="material-icons" >biotech</i>
                        Vets
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#feo" data-toggle="tab">
                        <i class="fa fa-pagelines "></i>
                          Field Ext Officers
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#supplier" data-toggle="tab">
                        <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i>
                        Suppliers
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="vets">
                  <table class="table">
                    <tbody>                        
                        @forelse ($proffesionals as $proffesional)
                        
                            @if ($proffesional->specialty == 'vet')
                            <tr>
                              <td>      
                                {{'Dr :'}}
                              </td>
                                <td>        
                                  {{$proffesional->name.'  From '.$proffesional->location}} 
                                </td>
                                <td class="td-actions text-right">
                                  <button type="button" rel="tooltip" title="Expirience" class="btn btn-primary btn-link btn-sm">
                                    @if ($proffesional->exp>0)
                                      @for ($i = 0; $i < strval($proffesional->exp); $i++)
                                      <span class="fa fa-star"></span>
                                      @if ($i == 5)
                                          @break
                                      @endif
                                      @endfor
                                    @endif

                                  </button>
                                </td>
                            </tr>
                              @else
                                @continue
                              @endif
                            @empty
                              {{__('No reqyests')}}                     
                          @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="feo">
                  <table class="table">
                    <tbody>                        
                        @forelse ($proffesionals as $proffesional)
                        
                            @if ($proffesional->specialty == 'feo')
                            <tr>
                              <td>      
                                {{'Officer :'}}
                              </td>
                                <td>        
                                  {{$proffesional->name.'  From '.$proffesional->location}} 
                                </td>
                                <td class="td-actions text-right">
                                  <button type="button" rel="tooltip" title="Expirience" class="btn btn-primary btn-link btn-sm">
                                    @if ($proffesional->exp>0)
                                      @for ($i = 0; $i < strval($proffesional->exp); $i++)
                                      <span class="fa fa-star"></span>
                                      @if ($i == 5)
                                          @break
                                      @endif
                                      @endfor
                                    @endif

                                  </button>
                                </td>
                            </tr>
                              @else
                                @continue
                              @endif
                            @empty
                              {{__('No reqyests')}}                     
                          @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="supplier">
                  <table class="table">
                    <tbody>                        
                        @forelse ($suppliers as $supplier)
                            <tr>
                              <td>      
                                {{$supplier->id}}
                              </td>
                                <td>        
                                  {{$supplier->name.'  From '.$supplier->location}} 
                                </td>
                                <td class="td-actions text-right">
                                  <button type="button" rel="tooltip" title="Expirience" class="btn btn-primary btn-link btn-sm">
                                    @if ($supplier->transport == 'able')
                                    <i class="fa fa-truck" style="font-size:20px;" aria-hidden="true"></i>
                                    @endif

                                  </button>
                                </td>
                            </tr>

                            @empty
                              {{__('No reqyests')}}                     
                          @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <span class="nav-tabs-title">Logins.. : </span>

                    <li class="nav-item">
                      <a class="nav-link active" href="#animals" data-toggle="tab">
                        <i class="material-icons" >biotech</i>
                        Vets
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#crops" data-toggle="tab">
                        <i class="fa fa-pagelines "></i>
                          F-E-O s
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#orders" data-toggle="tab">
                        <i class="material-icons">content_paste</i> Farmers
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="animals">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Location</th>
                      <th>date</th>
                    </thead>
                    <tbody>
                      @forelse ($latest_logins as $user)
                      
                      @if ($user->hasRole('vet'))
                          
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{ucfirst($user->name)}}</td>
                        <td>{{ucfirst($user->location)}}</td>
                        @if ( now()->diff(date_create($user->last_login))->d == 0)
                            <td>{{'Today'}}</td>
                        @else
                        <td>{{ now()->diff(date_create($user->last_login))->d.(now()->diff(date_create($user->last_login))->d >1 ?' days ': ' day ').' ago '}}</td>
                        @endif
                    </tr>

                      @endif
  
                      @empty
                      <tr>
                        <td>--</td>
                        <td>No</td>
                        <td>Priveous</td>
                        <td>logins</td>
                      </tr>                          
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="crops">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Location</th>
                      <th>date</th>
                    </thead>
                    <tbody>
                      @forelse ($latest_logins as $user)
                      
                      @if ($user->hasRole('feo'))
                          
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{ucfirst($user->name)}}</td>
                        <td>{{ucfirst($user->location)}}</td>
                        @if ( now()->diff(date_create($user->last_login))->d == 0)
                            <td>{{'Today'}}</td>
                        @else
                        <td>{{ now()->diff(date_create($user->last_login))->d.(now()->diff(date_create($user->last_login))->d >1 ?' days ': ' day ').' ago '}}</td>
                        @endif
                    </tr>

                      @endif
  
                      @empty
                      <tr>
                        <td>--</td>
                        <td>No</td>
                        <td>Priveous</td>
                        <td>logins</td>
                      </tr>                          
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="orders">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Location</th>
                      <th>date</th>
                    </thead>
                    <tbody>
                      @forelse ($latest_logins as $user)
                      
                      @if ($user->hasRole('farmer'))
                          
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{ucfirst($user->name)}}</td>
                          <td>{{ucfirst($user->location)}}</td>
                          @if ( now()->diff(date_create($user->last_login))->d == 0)
                              <td>{{'Today'}}</td>
                          @else
                          <td>{{ now()->diff(date_create($user->last_login))->d.(now()->diff(date_create($user->last_login))->d >1 ?' days': ' day').' ago'}}</td>
                          @endif
                      </tr>

                      @endif
  
                      @empty
                      <tr>
                        <td>--</td>
                        <td>No</td>
                        <td>Priveous</td>
                        <td>logins</td>
                      </tr>                          
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush