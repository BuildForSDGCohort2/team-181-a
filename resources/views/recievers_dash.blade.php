@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Orders')])

@section('content')


<div class="content">

  <div class="container-fluid">


    <nav>
      <ul class="nav nav-pills">

        <li class="nav-item">
          <a class="nav-link active" style="background-color: blueviolet" href="#">Orders in Transit</a>
        </li>
        <li class="nav-item">
        <a class="nav-link "  href="{{route('ready_for_pickup')}}">Ready For Pickup</a>
          </li>

      

    </ul>
  </nav>

 


    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">View the orders placed</h4>
            <p class="card-category"> Orders</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" ">
                  <th>
                    Id
                  </th>

                    @hasanyrole('admin|farmer|supplier|vet|feo|reciever')
                    <th>
                      Customer Name
                    </th>
                    @endhasanyrole
                    @can('admin')
                      <th>
                        Seller
                      </th>
                    @endcan
                  <th>
                    Product
                  </th>
                  <th>
                    Price
                  </th>
                  <th>
                    Status
                  </th>
                </thead>
                <tbody>

                @forelse ($transit_orders as $order)
                <tr>
                    <td>
                     {{$order->id}}
                    </td>
                    @hasanyrole('admin|farmer|supplier|vet|feo|reciever')
                    <td>
                     {{(auth()->user()->id === $order->user_id? 'Me' : ucfirst($order->user->name))}}
                    </td>
                    @endhasanyrole
                    @can('admin')
                    <td>
                      {{($order->get_seller($order->seller_id)->name)}}
                    </td>
                  @endcan
                    <td>
                    @if ($order->product_identifier === 'PLT')
                      <i class="fa fa-pagelines "></i>&nbsp; {{$order->quantity.' Sacks of '}}
                      {{$order->sales->storage->plantation->species}} {{auth()->user()->id === $order->user_id ? 'From' : 'To'}} {{ucfirst($order->sales->storage->plantation->farmer->location)}}

                    @elseif($order->product_identifier == 'ANML')
                    <i class="material-icons">pets</i> The
                    {{$order->sales->animal->species}} {{auth()->user()->id === $order->user_id ? 'From' : 'To'}}  {{ucfirst($order->sales->animal->farmer->location)}}

                    @elseif($order->product_identifier == 'POULT')
                    <i class="fa fa-bold" aria-hidden="true"></i>&nbsp;{{$order->quantity}} &nbsp;
                    {{$order->sales->brood->species}}&nbsp; {{auth()->user()->id === $order->user_id ? 'From' : 'To'}} {{ucfirst($order->sales->brood->farmer->location)}}

                    @else
                    <i class="material-icons">api</i>
                    @endif
                    </td>
                    <td>
                      KSH &nbsp; {{$order->price}}
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#professional_modal" @click="oder_info({{ $order }})">View info</button>

                    </td>
                </tr>
                @empty
                <tr>
                  @hasanyrole('admin|farmer|supplier|vet|feo')
                  <td>
                    <span class="text-primary"> No Orders In Transit</span>
                  </td>
                  @endhasanyrole
                  <td>
                    <span class="text-primary"> No Orders In Transit</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Orders In Transit</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Orders In Transit</span>
                  </td>
                  <td>
                    <span class="text-primary"> No orders In Transit</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Orders In Transit</span>
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
  </div>
<div id="professional_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <small  class="form-text text-muted">Order information</small>
        </div>
        <div class="modal-body">
            <ul class="list-group" v-if="order">
                <li class="list-group-item">@{{ order.sales.species }}</li>

                <li class="list-group-item" v-if="order.product_identifier === 'PLT'">
                    @{{order.quantity}}  Sacks of @{{order.sales.storage.plantation.species}} @{{userid === order.user_id ? 'From' : 'To'}} @{{(order.sales.storage.plantation.farmer.location)}}
                </li>
                <li class="list-group-item" v-else-if="order.product_identifier === 'ANML'">
                    <i class="material-icons">pets</i> The
                    @{{order.sales.animal.species}} @{{userid === order.user_id ? 'From' : 'To'}}  @{{(order.sales.animal.farmer.location)}}
                </li>
                <li class="list-group-item" v-else-if="order.product_identifier === 'POULT'">
                    <i class="fa fa-bold" aria-hidden="true"></i>&nbsp;@{{order.quantity}} &nbsp;
                    @{{order.sales.brood.species}}&nbsp; @{{userid === order.user_id ? 'From' : 'To'}} @{{(order.sales.brood.farmer.location)}}
                </li>

                <li class="list-group-item" v-else>
                    <i class="material-icons">api</i>
                </li>

                <li class="list-group-item"><b>Quantity:</b> <span style="float: right">@{{ order.quantity }}</span></li>
                <li class="list-group-item"><b>Price:</b> <span style="float: right">@{{ order.price }}</span></li>
                <li class="list-group-item"><b>Type of delivery:</b> <span style="float: right">@{{ order.type_of_delivery }}</span></li>
                <li class="list-group-item"><b>Customer name:</b> <span style="float: right">@{{ order.user.name }}</span></li>
                <li class="list-group-item"><b>location:</b> <span style="float: right">@{{ order.user.location }}</span></li>
                <li class="list-group-item"><b>email:</b> <span style="float: right">@{{ order.user.email }}</span></li>
              </ul>
      </div>

    </div>
</div>
</div>
</div>
@endsection
