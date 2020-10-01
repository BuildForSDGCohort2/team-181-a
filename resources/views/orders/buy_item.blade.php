@extends('layouts.app', ['activePage' => 'orders', 'titlePage' => __('On Sale')])

@section('content')

<!--Section: Block Content-->
<section class="mb-5" style="background: #f0f0f0">

    <div class="row" style="width: 70%; margin: auto;">
        <div class="col-md-6 mb-4 mb-md-0" style="margin-top: 100px">

            <div id="mdb-lightbox-ui">

            <div class="mdb-lightbox">

                    <div class="col-12 mb-0">
                        <figure class="view overlay rounded z-depth-1 main-img">
                            <a href=""
                                data-size="710x823">
                                @if ($prod->prod_id === 'ANML')
                                    <img src="{{ asset('material') }}/img/{{lcfirst($prod->animal->species)}}.jpg"class="img-fluid z-depth-1"><br>
                                @elseif($prod->prod_id === 'BROOD')
                                    <img src="{{ asset('material') }}/img/{{lcfirst($prod->brood->species)}}.jpg"class="img-fluid z-depth-1"><br>

                                @elseif($prod->prod_id === 'PLT')
                                    <img src="{{ asset('material') }}/img/{{lcfirst($prod->storage->plantation->species)}}.jpg"class="img-fluid z-depth-1"><br>

                                @endif
                                    
                            </a>
                        </figure>

                        <div>
                            <p><span class="mr-1"><strong>KES 1200</strong></span></p>
                            <p class="pt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit
                                error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio,
                                officia quis dolore quos sapiente tempore alias.</p>
                        </div>
                    </div>
                </div>

            </div>
            

        </div>
        <div class="col-md-6" style="margin-top: 100px">

            <div class="table-responsive">
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="pl-0 w-25" scope="row">
                            <strong>
                                @if ($prod->prod_id === 'ANML')
                                <span style="color: rgb(15, 28, 8)">{{$prod->animal->name}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                                    (@if ($prod->animal->species=='cow')
                                      {{($prod->animal->gender == 'male')? 'Bull' : 'Cow' }}
                                    @elseif ($prod->animal->species=='sheep')
                                      {{($prod->animal->gender == 'male')? 'Ram' : 'Ewe' }}
                                    @elseif ($prod->animal->species=='goat')
                                        {{($prod->animal->gender == 'male')? 'Billy-Goat' : 'nanny-goat' }}
                                    @else
                                      {{($prod->animal->gender == 'male')? 'Male' : 'Female' }}
                                    @endif)                        
                                    </span>
                                @elseif($prod->prod_id === 'POULT')
                                <span style="color: rgb(15, 28, 8)">{{ ucfirst($prod->brood->species)}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                                    @if ($prod->brood->species=='chicken' || $prod->brood->species=='turkey')
                                      {{($prod->brood->gender == 'male')? 'Broiler' : 'Layer' }}
                                    @endif                       
                                    </span>
                                @else
                                    {{$prod->storage->plantation->species}}                                    
                                @endif
                            </strong>
                            </th>
                        </tr>
                        @if ($prod->prod_id === 'PLT')
                            <tr>
                                <th class="pl-0 w-25" scope="row"><strong>Strain Number</strong></th>
                            <td>{{ucfirst($prod->storage->plantation->plant_fact_sheet->type)}}</td>
                        </tr>
                        @endif

                        <tr>
                            <th class="pl-0 w-25" scope="row"><strong>Delivery</strong></th>
                            {{-- here.... --}}
                            {{-- <td>{{ucfirst($prod->storage->plantation->user->location)}}</td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
            @if ($prod->prod_id === 'PLT' || $prod->prod_id === 'POULT' )
            <div class="table-responsive mb-2">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="pl-0 pb-0 w-25">Quantity</td>
                        </tr>
                        <tr>
                            <td class="pl-0">
                                <div class="def-number-input number-input safari_only mb-0">

                                    <input class="quantity" min="0" name="quantity" value="1" type="number">

                                </div>
                            <small >{{$prod->amount.' are '.($prod->prod_id=== 'PLT'?'Sacks':'Birds').' available'}}</small>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>  
            @endif

            <button type="button" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
            <button type="button" class="btn btn-light btn-md mr-1 mb-2"><i class="fas fa-shopping-cart pr-2"></i>Add to
                cart</button>
        </div>
    </div>

</section>
<!--Section: Block Content-->
@endsection

@push('js')
<script>

});
</script>
@endpush
