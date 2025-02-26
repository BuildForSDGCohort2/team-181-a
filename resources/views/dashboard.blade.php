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
              <p class="card-category">Used Farm Allocations</p>
              <h3 class="card-title">{{count(auth()->user()->plantations)}}
                <small>Partitions</small>
              </h3>
            </div>
            <div class="card-footer">
              {{-- enable the db to auto calculations --}}
              <div class="stats">
                <a href="#pablo">Registered Plantations</a>
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
            <h3 class="card-title">KSH.{{(auth()->user()->sales->filter(function($sale){return $sale->order_status == 1;}))->pluck('price')->sum()}}</h3>
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
              <h3 class="card-title">{{count(auth()->user()->sales->filter(function($sale){return $sale->order_status == 0;}))}}</h3>
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
              <p class="card-category">Completed Orders</p>
              <h3 class="card-title">{{count(auth()->user()->sales->filter(function($sale){return $sale->order_status == 1;}))}}</h3>
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
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                {{-- calculate the percentage and sisplay --}}
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
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
                  <span class="nav-tabs-title">To Do ...:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">pets</i> Animals
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="fa fa-pagelines "></i>
                          Plants
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">content_paste</i> Orders/Deliveries
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      @forelse ($issues as $issue)
                      @if (in_array('ANML' ,explode('-', $issue->identifier))||in_array('POLTR' ,explode('-', $issue->identifier)))
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="" checked>
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </td>
                          <td>{{$issue->reason}}</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" title="View Info" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">visibility</i>
                            </button>
                          </td>
                        </tr>
                      @endif
                      @empty
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"> </span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>No issues at hand</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                      @forelse ($issues as $issue)
                      @if (in_array('PLT' ,explode('-', $issue->identifier)))
                        <tr>
                          <td>
                            <div class="form-check">
                              <i class="fa fa-pagelines "></i>
                            </div>
                          </td>
                          <td>{{$issue->reason}}</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" title="View Info" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">visibility</i>
                            </button>
                          </td>
                        </tr>
                      @endif
                      @empty
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>No issues at hand</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>No Orders So far</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              </span>
                            </label>
                          </div>
                        </td>

                        </td>
                        <td class="td-actions text-right">

                        </td>
                      </tr>

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
                    <span class="nav-tabs-title">Top Earners ... : </span>

                    <li class="nav-item">
                      <a class="nav-link active" href="#animals" data-toggle="tab">
                        <i class="material-icons">pets</i> Animals
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#crops" data-toggle="tab">
                        <i class="fa fa-pagelines "></i>
                          Plants
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#orders" data-toggle="tab">
                        <i class="material-icons">content_paste</i> Orders/Deliveries
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
                      <th>Amount</th>
                      <th>Delivery</th>
                    </thead>
                    <tbody>
                      @forelse (auth()->user()->sales->filter(function($sale){return $sale->product_identifier=='ANML';}) as $item)
                      <tr>
                      <td>{{$item->id}}</td>
                      <td>{{'Animal'}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->type_of_delivery}}</td>
                      </tr> 
                      @empty
                    <tr>
                      <td>No</td>
                      <td>Orders</td>
                      <td>So Far</td>
                      <td>...</td>
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
                      <th>Amount</th>
                      <th>Delivery</th>
                    </thead>
                    <tbody>
                      @forelse (auth()->user()->sales->filter(function($sale){return $sale->product_identifier=='PLT';}) as $item)
                      <tr>
                      <td>{{$item->id}}</td>
                      <td>{{'CROP PRODUCE'}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->type_of_delivery}}</td>
                      </tr> 
                      @empty
                    <tr>
                      <td>No</td>
                      <td>Orders</td>
                      <td>So Far</td>
                      <td>...</td>
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
                      <th>Amount</th>
                      <th>Delivery</th>
                    </thead>
                    <tbody>
                      @forelse (auth()->user()->sales->filter(function($sale){return $sale->product_identifier=='brood';}) as $item)
                      <tr>
                      <td>{{$item->id}}</td>
                      <td>{{'CROP PRODUCE'}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->type_of_delivery}}</td>
                      </tr> 
                      @empty
                    <tr>
                      <td>No</td>
                      <td>Orders</td>
                      <td>So Far</td>
                      <td>...</td>
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
    var chart_1_label = ['M', 'T', 'W', 'T', 'F', 'S', 'S']
    var chart_1_series = [
        [0, 0, 0, 0, 0, 0, 0]
        ]

    var chart_2_label = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D']
    var chart_2_series = [
          [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ]
    var chart_3_label = ['0p', '0p', '0p', '0p', '0p', '0p', '0p', '0p']
    var chart_3_series = [
          [0, 0, 0, 0, 0, 0, 0, 0]
        ]
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts(chart_1_label,chart_1_series,chart_2_label,chart_2_series,chart_3_label,chart_3_series);
    });
</script>
@endpush
