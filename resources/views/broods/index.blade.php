@extends('layouts.app', ['activePage' => 'broods-table', 'titlePage' => __('Broods List')])

@section('content')
<div class="content">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Brood List</h4>
            <p class="card-category">Showing Various Poultry</p>
            <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#brood_r_modal" style="float: right;">Register New Brood</button>
          </div>
          <div id="brood_r_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Register Brood</h4>
                    </div>
                    <div class="modal-body">
                        <div class="first-column" style='width:45%; float: left;'>

                            <fieldset>

                                <label>Species:</label><br>
                                <input type="radio" v-model="form.species" id="turkey" value="turkey" />
                                <label for="turkey">Turkey</label>

                                <input type="radio" v-model="form.species" id="chicken" value="chicken" />
                                <label for="chicken">Chicken</label>

                                <input type="radio" v-model="form.species" id="duck" value="duck" />
                                <label for="duck">Duck</label>

                                <small class="has-text-danger" v-if="errors.species">@{{ errors.species[0] }}</small>
                                <div class="form-group" v-if="!form.species">
                                    <label for="others">Others</label>
                                    <input type="text" v-model='form.others' class="form-control" id="others" aria-describedby="others" placeholder="Please indicate">
                                    <small id="others" class="form-text text-muted">Please indicate</small>
                                    <small class="has-text-danger" v-if="errors.others">@{{ errors.others[0] }}</small>
                                </div>
                            </fieldset>
                            <fieldset required>
                                <label>Gender:</label><br>
                                <input type="radio" v-model="form.gender" id="male" value="male" />
                                <label for="male">Male</label>

                                <input type="radio" v-model="form.gender" id="female" value="female" />
                                <label for="female">Female</label>

                            </fieldset>
                            <small class="has-text-danger" v-if="errors.gender">@{{ errors.gender[0] }}</small>

                            <div class="form-group">
                                <label for="breed">Breed</label>
                                <input type="text" v-model='form.breed' class="form-control" id="breed" aria-describedby="breedname" placeholder="Select Breed">
                                <small id="momsname" class="form-text text-muted">Select the Breed</small>
                                <small class="has-text-danger" v-if="errors.breed">@{{ errors.breed[0] }}</small>
                            </div>

                        </div>
                        <div class="second-column" style='width:45%; float: right;'>

                            <div class="form-group">
                                <label for="name">Hatched on...</label>
                                <input type="date" class="form-control" v-model='form.hatch_date' id="age" aria-describedby="hatch_date" required>
                                <small id="hatch_date" class="form-text text-muted">Enter the Hatching date....</small>
                                <small class="has-text-danger" v-if="errors.hatch_date">@{{ errors.hatch_date[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label for="number">Number of Birds</label>
                                <input type="text" class="form-control" v-model='form.number' id="number" aria-describedby="broods_number" placeholder="Enter Number of Birds" required>
                                <small id="broods_number " class="form-text text-muted">Enter the broods number</small>
                                <small class="has-text-danger" v-if="errors.number">@{{ errors.number[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label for="sellers_name">Sellers Name</label>
                                <input type="text" class="form-control" v-model='form.sellers_name' id="sellers_name" aria-describedby="suppliers_name" placeholder="Enter Name" required>
                                <small id="suppliers_name" class="form-text text-muted">Enter The Suppliers Name or id</small>
                                <small class="has-text-danger" v-if="errors.sellers_name">@{{ errors.sellers_name[0] }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="save_item('brood')" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-success">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Breed
                  </th>
                  <th>
                    Age
                  </th>
                  <th>
                    Number
                  </th>
                  <th>
                    Status
                  </th>
                  <th class="text-warning">
                    Actions
                  </th>
                </thead>
                <tbody>
                    @forelse ($broods as $brood)
                    <tr>
                      <td>
                        {{$brood->id}}
                      </td>
                      <td>
                        {{-- here is the link to the show modal --}}
                        <a data-target="#brood_s_modal" data-toggle="modal" class="MainNavText" id="MainNavHelp"
                        href="#brood_s_modal">
                         <span style="color: rgb(15, 28, 8)">{{ ucfirst($brood->species)}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                          @if ($brood->species=='chicken' || $brood->species=='turkey')
                            {{($brood->gender == 'male')? 'Broilers' : 'Layers' }}
                          @endif
                          </span>
                        {{-- </a> --}}
                        </a>
                      </td>
                      <td>
                        <a href="breed_info"><span style="color: black">{{$brood->breed->breed}}</span></a>
                      </td>
                      <td>
                      {{-- convert the birthday to date object --}}
                      @php
                        $age= now()->diff(date_create($brood->date_of_hatching))
                      @endphp
                        {{$age->y  == 0  ?'':$age->y.'yrs'}}
                        {{$age->m  == 0 ?'':$age->m.'mnths'}}
                        {{$age->d.'days'}}
                      </td>
                      {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                      <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">{{$brood->number}}</span>
                      </td>
                      <td>
                          {{ $age->y == 0 && $age->m < 5 ? 'Maturing':'Mature'}}
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#sell">Sell</a>
                            @if ($age->y > 0 || $age->m > 4 )
                            <a class="dropdown-item" href="#"><span class="text-primary">View production Records</span>  </a> {{-- the pop up would record the various varibles that would accopany that eg number etc--}}
                            @endif
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#death" ><span class="text-danger">Record Death / Slaughter</span>  </a> {{-- the pop up would record the various varibles that would accopany that eg number etc--}}

                          </div>
                        </div>

                      </td>
                      <div id="sell" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Sell</h4>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('sell_poultry',$brood)}}" method="post">
                              @csrf

                                <div class="first-column" style='width:45%; float: left;'>
                                  <div class="form-group">
                                    <label for="birds_for_sell">Number of Birds</label>
                                  <input type="number" class="form-control" name='birds_for_sell'id="birds_for_sell" aria-describedby="birds_for_sell" placeholder="{{$brood->number}} is the max" min='1' max="{{$brood->number}}">
                                    <small id="birds_for_sell" class="form-text text-muted">{{$brood->number}} Birds Remaining.</small>
                                  </div>
                                  <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="sell_all" name="sell_all"  >
                                      <label class="custom-control-label" for="sell_all"><span class="text-success"> Sell <span class="text-warning">All</span> </span>?</label>
                                    </div>
                                  </div>



                                  {{-- incremental... will depend on the remaining size of farm --}}


                                </div>
                                <div class="second-column" style='width:45%; float: right;'>


                                  <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name='price'id="price" aria-describedby="price" placeholder="Enter the bird price">
                                    <small id="price" class="form-text text-muted">The price Per bird.</small>
                                  </div>
                                  <div class="form-group">
                                    <label for="species" ><small>Recommendations</small> </label>
                                    <textarea class="form-control" id="recomendations" rows="3"  readonly>
                                    </textarea>
                                  </div>


                                </div>



                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                          </form>
                          </div>

                        </div>
                      </div>
                      <div id="death" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Record Death</h4>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('deduct_brood_number',$brood)}}" method="post">
                              @csrf

                                <div class="first-column" >
                                  <div class="form-group">
                                    <label for="birds_for_sale">Number of birds</label>
                                  <input type="number" class="form-control" name='birds_for_sale'id="birds_for_sale" aria-describedby="birds_for_sale" placeholder="{{$brood->number}} is the max" min='1' max="{{$brood->number}}">
                                    <small id="birds_for_sale" class="form-text text-muted">{{$brood->number}} birds Remaining.</small>
                                  </div>
                                  <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="all" name="all"  >
                                      <label class="custom-control-label" for="all"><span class="text-success"> Take <span class="text-warning">All</span> </span>?</label>
                                    </div>
                                  </div>



                                  {{-- incremental... will depend on the remaining size of farm --}}


                                </div>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                          </form>
                          </div>

                        </div>
                      </div>
                    </tr>
                    @empty
                    <tr>
                      <td>
                        0
                      </td>
                      <td>
                        No Broods Registerd
                      </td>
                      <td>
                        No Broods Registerd
                      </td>
                      <td>
                        No Broods Registerd
                      </td>
                      <td>
                        No Broods Registerd
                      </td>
                      <td>
                        No Broods Registerd
                      </td>
                      <td>
                        No Broods Registerd
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

<!-- Modal -->

@endsection
