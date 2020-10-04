
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
          @php
            if ($prod->prod_id== "ANML") {
                $product_information = $prod->animal;
            } elseif($prod->prod_id== "POULT") {
                $product_information = $prod->brood;
            }else {
                $product_information = $prod->storage->plantation;
            }

          @endphp

          <div class="card" style="width: 300px;height:400px;margin:10px;margin-top: 100px;" >
            <div class="bg-image hover-overlay ripple" data-ripple-color="light">
              <img data-size ='34' src="{{ asset('material') }}/img/{{lcfirst($product_information->species)}}.jpg"
              class="img-fluid z-depth-1" alt="{{ asset('material') }}/img/default.jpg"><br>


              <a href="#!">
                <div class="mask rgba-white-slight"></div>
              </a>
              <span class="badge badge-success" style="float: right;margin:5px;">Tested <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
            </div>
            <div class="card-body">
            <h5 class="card-title">
              @if ($prod->prod_id === 'ANML')
              <span style="color: rgb(15, 28, 8)">{{$product_information->name}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                  (@if ($product_information->species=='cow')
                    {{($product_information->gender == 'male')? 'Bull' : 'Cow' }}
                  @elseif ($product_information->species=='sheep')
                    {{($product_information->gender == 'male')? 'Ram' : 'Ewe' }}
                  @elseif ($product_information->species=='goat')
                      {{($product_information->gender == 'male')? 'Billy-Goat' : 'nanny-goat' }}
                  @else
                    {{($product_information->gender == 'male')? 'Male' : 'Female' }}
                  @endif)
                  </span>
              @elseif($prod->prod_id === 'POULT')
              <span style="color: rgb(15, 28, 8)">{{ ucfirst($product_information->species)}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                  @if ($product_information->species=='chicken' || $product_information->species=='turkey')
                    {{($product_information->gender == 'male')? 'Broiler' : 'Layer' }}
                  @endif
                  </span>
              @else
                  {{$product_information->species.'( '.$product_information->plant_fact_sheet->type.' )'}}
              @endif
            </h5>


          <small><strong>{{$prod->prod_id==='ANML'? 'Weight': 'Number'}}   </strong>: {{$prod->amount}} {{$prod->prod_id === 'PLT'?' Sacks'
            :($prod->prod_id === 'ANML'?' KGS' :'Birds')}}</small><br>
          <small><strong>Location </strong>: {{ucfirst($product_information->farmer->location)}}</small><br>
          <small><strong>Price</strong>: {{$prod->price}} {{($prod->prod_id !== 'ANML'? ($prod->prod_id === 'PLT'? 'Per Sack': 'Per Bird'):'')}}</small><br>
            <a href="{{route('viewprod',$prod)}}" class="btn btn-primary">View Product</a>
            </div>
          </div>
        @empty
            <span class="text-primary"><h1>No Products For Sale...</h1></span>
        @endforelse
      </div>

    </div>
  </div>
@endsection

