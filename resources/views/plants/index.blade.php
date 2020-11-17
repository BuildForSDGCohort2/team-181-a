@extends('layouts.app', ['activePage' => 'plants-table', 'titlePage' => __('Plants List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Plantations On Farm..</h4>
            <p class="card-category"> Showing  {{count($plantations)}} Plantations</p>
            <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#plant_modal" style="float: right;">Add plantation</button>

          </div>
          <div id="plant_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">New Plantation</h4>
                </div>
                <div class="modal-body">
                <form action="{{route('plant.store')}}" method="POST">
                  @csrf
                    <div class="first-column" style='width:45%; float: left;'>
                      <div class="form-group">
                        <label for="species">Type Of Plant</label>
                        <input type="text" class="form-control" v-model='form.species'id="species" aria-describedby="species" placeholder="Enter plant type" @change="fact_sheet">
                        <small id="species" class="form-text text-muted">Select the Appropriate plant or Enter name.</small>
                        <small class="has-text-danger" v-if="errors.species">@{{ errors.species[0] }}</small>
                    </div>

                       <div class="form-group">
                        <label for="type_id">Number / Strain</label>
                        {{-- <input type="text" v-model ='form.type_id'class="form-control" id="type_id" aria-describedby="type_id" placeholder="Select Strain"> --}}

                        <el-select v-model="form.type_id" filterable placeholder="select a breed"  style="width: 100%;">
                            <el-option v-for="(item, index) in options" :key="item.id" :label="item.type" :value="item.id">
                            </el-option>
                        </el-select>


                        <small id="type_id" class="form-text text-muted">Select the type..</small>
                        <small class="has-text-danger" v-if="errors.type_id">@{{ errors.type_id[0] }}</small>
                    </div>

                      {{-- incremental... will depend on the remaining size of farm --}}



                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                      <div class="form-group">
                        <label for="size">Size OF Allocation</label>
                        <input type="text" v-model ='form.size'class="form-control" id="size" aria-describedby="size" placeholder="Enter Total Size">
                        <small id="size" class="form-text text-muted">Enter size of the allocation</small>
                        <small class="has-text-danger" v-if="errors.size">@{{ errors.size[0] }}</small>
                    </div>
                      <label>Calibration in:</label><br>
                      <input type = "radio"
                             v-model = "form.callibration"
                             id = "meters"
                             value = "meters" />
                      <label for = "meters">Meters &sup2; </label>

                      <input type = "radio"
                             v-model = "form.callibration"
                             id = "acres"
                             value = "acres" />
                      <label for = "acres">Acres</label>

                      <input type = "radio"
                             v-model = "form.callibration"
                             id = "hactares"
                             value = "hactares" />
                      <label for = "hactares">Hactares</label>
                        <small class="has-text-danger" v-if="errors.callibration">@{{ errors.callibration[0] }}</small>
                    </fieldset>

                      <div class="form-group">
                        <label for="planting_date">Date Of Planting</label>
                        <input type="date" class="form-control" v-model='form.planting_date' id="planting_date" aria-describedby="planting_date" placeholder="Enter Date of planting">
                        <small id="planting_date" class="form-text text-muted">Select date time Defaut date is today.</small>
                            <small class="has-text-danger" v-if="errors.planting_date">@{{ errors.planting_date[0] }}</small>
                    </div>


                    </div>



                </div>
                <div class="modal-footer">
                  <button @click="save_item('plant')" class="btn btn-info" value="Submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </form>
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
                    Species
                  </th>
                  <th>
                    Area Covered
                  </th>
                  <th>
                    Remaining Time To Expected harvest
                  </th>
                  <th>
                    Expected Produce
                  </th>
                </thead>
                <tbody>

                  @forelse ($plantations as $plantation)

                  <tr>
                    <td>
                      {{$plantation->id}}
                    </td>
                    <td>
                      <a data-target="#plant_s_modal" data-toggle="modal" class="MainNavText" id="MainNavHelp"
                      href="#plant_s_modal">
                       <span style="color: rgb(15, 28, 8)">{{$plantation->species}}</span><span style="color: rgb(19, 197, 108)">&nbsp;

                        </span>
                      {{-- </a> --}}
                      </a>
                    </td>
                    <td>
                     {{$plantation->size_of_plantation}} Acres
                    </td>
                    <td>

                      @php
                          $time = $plantation->time_to_harvest()
                      @endphp
                       @if ($time > 10 )
                          <span class="text-success">{{substr($time,1)}}</span> Days

                       @elseif( $time < 10 )
                      <div class="dropdown">
                      <button class="btn btn-outline-{{$time< 0 ? 'danger':'warning'}} btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Access {{substr($time,1).'Days overdue'}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#scheduleHarvest" @click="open_edit( {{ $plantation }} )">{{($plantation->status==1?'Reschedule':'Schedule Harvest' )}} </a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#harvest" @click="open_edit( {{ $plantation }} )">Harvest</a>
                        </div>
                      </div>


                      @endif
                    </td>
                    <td class="text-success">

                        {{($plantation->plant_fact_sheet->production_rate * $plantation->size_of_plantation)}} Sacks
                        {{-- @if ($age['days'] < 0 && $age['months'] < 0 && $age['years'] < 0) --}}
                        {{-- @endif --}}
                    </td>
                  </tr>
                  <div id="scheduleHarvest" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Schedule Harvest</h4>
                        </div>
                        <div class="modal-body">
                        {{-- <form action="{{route('scheduleharvest',$plantation)}}" method="POST">
                          @csrf --}}

                            <div class="first-column" style='width:45%; float: left;'>
                              <div class="form-group">
                                <label for="species">Date</label>
                                <input type="date" class="form-control" v-model='form.scheduled_date'id="scheduled_date" aria-describedby="scheduled_date" required >
                                <small id="species" class="form-text text-muted">Set harvest Reminder</small>
                            <small class="has-text-danger" v-if="errors.scheduled_date">@{{ errors.scheduled_date[0] }}</small>
                        </div>

                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="schedule_transport" v-model="form.schedule_transport"  >
                                  <label class="custom-control-label" for="schedule_transport">Do you need <span class="text-warning"> Transport</span>?</label>
                                </div>
                              </div>

                              {{-- incremental... will depend on the remaining size of farm --}}



                            </div>
                            <div class="second-column" style='width:45%; float: right;'>

                              <div class="form-group">
                                <label for="species" ><small>Recommendations</small> </label>
                                <textarea class="form-control" id="recomendations" rows="3"  readonly>
                                </textarea>
                              </div>

                           </div>

                        </div>
                        <div class="modal-footer">
                          <button @click="save_item('plantation/'+edit_form.id+'/schedule_harvest')" class="btn btn-info" value="Submit">Submit</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      {{-- </form> --}}
                      </div>
                    </div>
                  </div>
                  <div id="harvest" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Harvest Plantation</h4>
                        </div>
                        <div class="modal-body">
                        {{-- <form action="{{route('harvest',$plantation)}}" method="post">
                          @csrf --}}

                            <div class="first-column" style='width:45%; float: left;'>
                              <div class="form-group">
                                <label for="sacks">Number of full Sacks</label>
                                <input type="text" class="form-control" v-model='form.sacks'id="sacks" aria-describedby="sacks" placeholder="X sacks">
                                <small id="sacks" class="form-text text-muted">The number of Sacks.</small>
                            <small class="has-text-danger" v-if="errors.sacks">@{{ errors.sacks[0] }}</small>
                        </div>

                              <div class="form-group">
                                <label for="species" ><small>Recommendations</small> </label>
                                <textarea class="form-control" id="recomendations" rows="3"  readonly>
                                </textarea>
                              </div>

                              {{-- incremental... will depend on the remaining size of farm --}}


                            </div>
                            <div class="second-column" style='width:45%; float: right;'>
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="sell" v-model="form.sell"  >
                                  <label class="custom-control-label" for="sell">Immediate  <span class="text-success"> Sell</span>?</label>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" v-model='form.price'id="price" aria-describedby="price" placeholder="Enter the sack price">
                                <small id="price" class="form-text text-muted">The price Per sack.</small>
                            <small class="has-text-danger" v-if="errors.price">@{{ errors.price[0] }}</small>
                        </div>
                        <div v-if="!form.sell">

                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="sell_all" v-model="form.sell_all"  >
                                  <label class="custom-control-label" for="sell_all">All   <span class="text-success"> Sacks</span>?</label>
                                </div>
                              </div>

                              <div class="form-group" v-if="!form.sell_all">
                                <label for="amount">Number of Sacks</label>
                                <input type="text" class="form-control" v-model='form.amount'id="amount" aria-describedby="amount" placeholder="Number of sacks">
                                <small id="amount" class="form-text text-muted">How many sacks Would You like to sell?</small>
                            <small class="has-text-danger" v-if="errors.amount">@{{ errors.amount[0] }}</small>
                        </div>
                    </div>

                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="harvest_transport" v-model="form.harvest_transport"  >
                                  <label class="custom-control-label" for="harvest_transport">Do you need <span class="text-warning"> Transport</span>?</label>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button @click="save_item('/plantation/'+edit_form.id +'/harvest')" class="btn btn-info" value="Submit">Submit</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      {{-- </form> --}}
                      </div>

                    </div>
                  </div>
                  @empty
                    <tr class="text-primary">
                      <td>
                        No Plantations Registered

                      </td>
                      <td>
                        No Plantations Registered
                      </td>
                      <td>
                        No Plantations Registered
                      </td>
                      <td>
                        No Plantations Registered
                      </td>
                      <td>
                        -------------
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
</div>
@endsection
