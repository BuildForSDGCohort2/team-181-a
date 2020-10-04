@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Orders')])

@section('content')


<div class="content">
    <nav ">
        <ul class="nav nav-pills">
        @if (auth()->user()->hasRole('admin'))
        
            <li class="nav-item">
              <a class="nav-link " href="{{ route('notifications') }}">Proffesionals</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('pending_suppliers')}}">Suppliers</a>
            </li>
            <li class="nav-item">
            <a class="nav-link "  href="{{route('orders')}}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" style="background-color: blueviolet" href="{{route('dispatch')}}">Dispatch</a>
              </li>
            <li class="nav-item">
              <a class="nav-link "  href="{{route('issues')}}">User Requests</a>
            </li>

          @else
            <li class="nav-item">
              <a class="nav-link "  href="{{route('issues')}}">issues</a>
            </li>
            @if (auth()->user()->hasRole('farmer'))
              <li class="nav-item">
               <a class="nav-link "  href="{{route('storage')}}">Store</a>
              </li> 
            @endif  
  
          <li class="nav-item">
            <a class="nav-link active" style="background-color: blueviolet" href="#">Orders</a>
          </li> 
          
          @endif
        
      </ul>
    </nav>
    <div class="col-md-12">
    <div class="card card-plain">
      <div class="card-header card-header-info">
        <h4 class="card-title mt-0">Dispatch Orders</h4>
        <p class="card-category"> Orders have beeen Grouped By Location</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="">
              <th>
                ID
              </th>
              <th>
                Destination
              </th>
              <th>
                Quantity Of Goods
              </th>
              <th>
                Value
              </th>
              <th>
                Actions
              </th>
            </thead>
            <tbody>
                @forelse ($grouped_orders as $group=>$items)
                <tr>
                    <td>
                      1
                    </td>
                    <td>
                        {{ucfirst($group)}}
                    </td>
                    <td>
                      {{count($items)}}
                    </td>
                    <td>
                      KSH {{array_sum(array_column($items->toArray(),'price'))}}
                    </td>
                    <td>
                      <button class="btn btn-small btn-primary"> Dispatch </button>
                    </td>
                  </tr> 
                @empty
                <tr>
                    <td>
                      No Orders To dispatch
                    </td>
                    <td>
                        No Orders To dispatch
                    </td>
                    <td>
                        No Orders To dispatch
                    </td>
                    <td>
                        No Orders To dispatch
                    </td>
                    <td>
                        No Orders To dispatch
                    </td>
                  </tr>
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection