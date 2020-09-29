
  @extends('layouts.app', ['activePage' => 'onsale', 'titlePage' => __('On Sale')])

@section('content')
  <div class="content">
    @if (auth()->user()===null)
      <div class="container-fluid" style="margin-top:40px;">
    @else
       <div class="container-fluid">
    @endif
    
      <div class="row justify-content-center">
        @forelse ($prods_on_sale as $prod)
          <div class="card" style="width: 300px;height:400px;margin:10px" >
            <div class="bg-image hover-overlay ripple" data-ripple-color="light">
              <img
                src="{{ asset('material') }}/img/default.jpg"
                class="img-fluid" alt="'"
              />
              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
              <span class="badge badge-success" style="float: right;margin:5px;">Tested <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Breed | Gender</h5>
                <small><strong>Weight | Prod rate  </strong>: Quantity</small><br>
                <small><strong>Location </strong>: Quantity</small><br>
                <small><strong>Price</strong>: Quantity</small><br>
            <a href="{{route('viewprod',$prod)}}" class="btn btn-primary">View Product</a>
            </div>
          </div> 
        @empty
            
        @endforelse

        
        <div class="card" style="width: 300px;height:400px;margin:10px" >
          <div class="bg-image hover-overlay ripple" data-ripple-color="light">
            <img
              src="{{ asset('material') }}/img/default.jpg"
              class="img-fluid" alt="'"
            />
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
             </a>
             <span class="badge badge-success" style="float: right;margin:5px;">Tested <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
          </div>
          <div class="card-body">
            <h5 class="card-title">Plant  Species</h5>
              <small><strong>Price Per Sack  </strong>: Quantity | available</small><br>
              <small><strong>Location </strong>: Quantity</small><br>
            <a href="#!" class="btn btn-primary">Buy</a>
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