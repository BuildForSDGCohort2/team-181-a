@extends('layouts.app', ['activePage' => 'animals-table', 'titlePage' => __('Plants List')])

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Animals List</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
            <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#animal_r_modal" style="float: right;">Register Animal</button>
          </div>
          {{--                Add Animal modal                          --}}
          <div id="animal_r_modal" class="modal fade " role="dialog">
            <div class="modal-dialog">          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Register Animal</h4>
                </div>
                <div class="modal-body">
                  
                <form action="{{route('animal.store')}}" method="POST">
                {{-- <form id="add_animal">> --}}
                  @csrf
                    <div class="first-column" style='width:45%; float: left;'>
                      <div class="form-group">
                        <label for="name">Name Of Animal</label>
                        <input type="text" class="form-control" name='name'id="name" aria-describedby="name" placeholder="Enter Name">
                        <small id="name" class="form-text text-muted">Enter Disired name of animal.</small>
                      </div>
                      
                      <fieldset>                
                        <label>Gender:</label><br>            
                        <input type = "radio"
                              name = "gender"
                              id = "male"
                              value = "male" />
                        <label for = "male">Male</label>
                      
                        <input type = "radio"
                              name = "gender"
                              id = "female"
                              value = "female" />
                        <label for = "female">Female</label>

                    </fieldset>

                      <fieldset>                
                           <label>Species:</label><br>            
                           <input type = "radio"
                                  name = "species"
                                  id = "cow"
                                  value = "cow" />
                           <label for = "cow">Cow</label>
                         
                           <input type = "radio"
                                  name = "species"
                                  id = "goat"
                                  value = "goat" />
                           <label for = "goat">Goat</label>
                         
                           <input type = "radio"
                                  name = "species"
                                  id = "sheep"
                                  value = "sheep" />
                           <label for = "sheep">Sheep</label>
                       </fieldset>
                       
                       <div class="form-group">
                        <label for="breed">Breed</label>
                        <select class="form-control form-control-sm" name="breed_id" required>
                          <option value="1">Charolais</option>
                          <option value="2">Merino</option>
                          
                        </select>
                        <small id="momsname" class="form-text text-muted">Select the Breed</small>
                      </div> 


                      
                      <div class="form-group">
                        <label for="mothers_name">Mothers Name/id</label>
                        <input type="text" class="form-control" name='mothers_name' id="mothers_name" aria-describedby="momsname" placeholder="Enter Name" >
                        <small id="momsname" class="form-text text-muted">Enter The Mothers Name or id</small>
                      </div>                        


                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                      
                      <div class="form-group">
                        <label for="name">Birth-day</label>
                        <input type="date" class="form-control" name='birthday' id="birthday" aria-describedby="birthday">
                        <small id="age" class="form-text text-muted">Enter date of birth.</small>
                      </div>
                      
                      <div class="form-group">
                        <label for="weight">If Not Sure?... </label>
                        <input type="text" class="form-control" name='approx_age' id="approx_age" aria-describedby="approx_age" placeholder="Approximate Age">
                        <small id="approx_age "  class="form-text text-muted">Enter Approximate Age</small>
                      </div>
                      <label>Approximatin in:</label><br>            
                      <input type = "radio"
                             name = "approximation"
                             id = "months"
                             value = "months" />
                      <label for = "months">Months</label>
                    
                      <input type = "radio"
                             name = "approximation"
                             id = "years"
                             value = "years" />
                      <label for = "years">Years</label>
                                  
                      <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" name='weight' id="weight" aria-describedby="animals_weight" placeholder="Enter Weight" required>
                        <small id="animals_weight "  class="form-text text-muted">Enter the animals Weight</small>
                      </div>
                      
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="pregnancy_status" name="pregnancy_status"  >
                          <label class="custom-control-label" for="pregnancy_status"> Is the animal <span class="text-success">Pregnant</span>?</label>
                        </div>                   
                      </div> 

                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="health_status" name="health_status"  >
                          <label class="custom-control-label" for="health_status"> Is the animal <span class="text-danger">Sick </span>?</label>
                        </div>                   
                      </div>  
                      
                    
                
                    
                    </div>               
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
              </div>
          
            </div>
          </div>  
        {{--                                   end                     --}}

        
        {{--                      Show animal modall                    --}}
        <div id="animal_s_modal" class="modal fade " role="dialog">
          <div class="modal-dialog">          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Animal name</h4>
              </div>
              <div class="modal-body">
                
              {{-- If eddited the form would submitt to the update  method on the controller --}}
              <form action="{{route('animal.store')}}" method="POST">
              {{-- <form id="show_animal"> --}}
                @csrf
                  <div class="first-column" style='width:45%; float: left;'>
                    <div class="form-group">
                      <label for="name">Name Of Animal</label>
                      <input type="text" class="form-control" name='name'id="name" aria-describedby="name" placeholder="Enter Name">
                      <small id="name" class="form-text text-muted">Enter Disired name of animal.</small>
                    </div>
                    
                    <fieldset>                
                      <label>Gender:</label><br>            
                      <input type = "radio"
                            name = "gender"
                            id = "male"
                            value = "male" />
                      <label for = "male">Male</label>
                    
                      <input type = "radio"
                            name = "gender"
                            id = "female"
                            value = "female" />
                      <label for = "female">Female</label>

                  </fieldset>

                    <fieldset>                
                         <label>Species:</label><br>            
                         <input type = "radio"
                                name = "species"
                                id = "cow"
                                value = "cow" />
                         <label for = "cow">Cow</label>
                       
                         <input type = "radio"
                                name = "species"
                                id = "goat"
                                value = "goat" />
                         <label for = "goat">Goat</label>
                       
                         <input type = "radio"
                                name = "species"
                                id = "sheep"
                                value = "sheep" />
                         <label for = "sheep">Sheep</label>
                     </fieldset>
                     
                     <div class="form-group">
                      <label for="breed">Breed</label>
                      <select class="form-control form-control-sm" name="breed_id" required>
                        <option value="1">Charolais</option>
                        <option value="2">Merino</option>
                        
                      </select>
                      <small id="momsname" class="form-text text-muted">Select the Breed</small>
                    </div> 


                    
                    <div class="form-group">
                      <label for="mothers_name">Mothers Name/id</label>
                      <input type="text" class="form-control" name='mothers_name' id="mothers_name" aria-describedby="momsname" placeholder="Enter Name" >
                      <small id="momsname" class="form-text text-muted">Enter The Mothers Name or id</small>
                    </div>                        


                  </div>
                  <div class="second-column" style='width:45%; float: right;'>
                    
                    <div class="form-group">
                      <label for="name">Birth-day</label>
                      <input type="date" class="form-control" name='birthday' id="birthday" aria-describedby="birthday">
                      <small id="age" class="form-text text-muted">Enter date of birth.</small>
                    </div>
                    
                    <div class="form-group">
                      <label for="weight">If Not Sure?... </label>
                      <input type="text" class="form-control" name='approx_age' id="approx_age" aria-describedby="approx_age" placeholder="Approximate Age">
                      <small id="approx_age "  class="form-text text-muted">Enter Approximate Age</small>
                    </div>
                    <label>Approximatin in:</label><br>            
                    <input type = "radio"
                           name = "approximation"
                           id = "months"
                           value = "months" />
                    <label for = "months">Months</label>
                  
                    <input type = "radio"
                           name = "approximation"
                           id = "years"
                           value = "years" />
                    <label for = "years">Years</label>
                                
                    <div class="form-group">
                      <label for="weight">Weight</label>
                      <input type="text" class="form-control" name='weight' id="weight" aria-describedby="animals_weight" placeholder="Enter Weight" required>
                      <small id="animals_weight "  class="form-text text-muted">Enter the animals Weight</small>
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="health_status" name="health_status"  >
                        <label class="custom-control-label" for="health_status"> Is the animal <span class="text-danger">Healthy</span>?</label>
                      </div>                   
                    </div>  
                    
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pregnancy_status" name="pregnancy_status"  >
                        <label class="custom-control-label" for="pregnancy_status"> Is the animal <span class="text-success">Pregnant</span>?</label>
                      </div>                   
                    </div>                     
              
                  
                  </div>               
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
        
          </div>
        </div> 
        {{--                                        end                                    --}}
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
                    Info
                  </th>
                  <th>
                    Status
                  </th>
                  <th class="text-warning">
                    Actions
                  </th>
                </thead>
                <tbody>
                    @forelse ($animals as $animal)
                    <tr>
                      <td>
                        {{$animal->id}}
                      </td>
                      <td>
                        {{-- here is the link to the show modal --}}
                        <a data-target="#animal_s_modal" data-toggle="modal" class="MainNavText" id="MainNavHelp" 
                        href="#animal_s_modal">
                         <span style="color: rgb(15, 28, 8)">{{$animal->name}}</span><span style="color: rgb(19, 197, 108)">&nbsp;
                          (@if ($animal->species=='cow')
                            {{($animal->gender == 'male')? 'Bull' : 'Cow' }}
                          @elseif ($animal->species=='sheep')
                            {{($animal->gender == 'male')? 'Ram' : 'Ewe' }}
                          @elseif ($animal->species=='goat')
                              {{($animal->gender == 'male')? 'Billy-Goat' : 'nanny-goat' }}
                          @else
                            {{($animal->gender == 'male')? 'Male' : 'Female' }}
                          @endif)                        
                          </span>
                        {{-- </a> --}}
                        </a>                      
                      </td>
                      <td>
                        <a href="breed_info"><span style="color: black">{{$animal->breed->breed}}</span></a>                       
                      </td>
                      <td>
                      {{-- convert the birthday to date object --}}
                      @php
                        $age= now()->diff(date_create($animal->birthday)) 
                      @endphp
                      {{$age->y > 0?$age->y.'yrs':''}}
                      {{$age->m > 0?$age->m.'mnths ':''}}  
                      {{$age->d}} days                      
                        
                      </td>
                      {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                      <td class="text-">
                      <span style="color: rgb(19, 197, 108)">{{$animal->weight}} </span>KG
                      </td>
                      <td>
                        {{-- if the animals healthy --}}
                        @if ($animal->health_status == 0)
                            {{-- if the animal is an Adolescent --}}
                            @if ($animal->reproductive_status >0 )
                                {{-- gender checker --}}
                                @if ($animal->gender == 'female')
                                  {{-- ternary to check pregnancy --}}
                                  <span class="text-success">{{$animal->reproductive_status == 2? 'Pregnant & Healthy':($animal->age > 2 && $animal->age < 4 ? 'Healthy Adolescent':'Healthy Adult') }}</span>
                                @else
                                  <span class="text-success"> Healthy Male</span>
                                @endif
                            @else
                                <span class="text-success">{{($age->y < 2? 'Healthy Child': ($age->y < 4 ? 'Healthy Adolescent':'Healthy Adult')) }}</span>
                            @endif
                        @else
                            <span class="text-danger">Unhealthy</span>
                        @endif
                        |<span class="text-info"> {{$animal->sale_status > 0 ? 'On-Sale':''}}</span>
                      </td>
                      <td>
                        {{-- if the animals healthy --}}
                        @if ($animal->health_status == 0)
                            {{-- if the animal is an Adolescent --}}
                                {{-- gender checker --}}
                                @if ($animal->gender == 'female' && $animal->reproductive_status >0 )
                                  {{-- ternary to check pregnancy  and summon vet accordingly  will add the time calculator.. time to birth --}}
                                  <div class="dropdown">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sell_animal">Sell</a>
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#death">Dead </a>
                                      @if ($animal->reproductive_status==1)
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#summon_vet">Summon Vet For Ai Procedure</a>
                                    @elseif($animal->reproductive_status==2)
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#summon_vet">Summon Vet For Checkup</a> 
                                    @endif
                                    </div>
                                  </div> 
                                 
                                @else
                                <div class="dropdown">
                                  <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sell_animal">Sell</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#summon_vet">Summon Vet</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#death">Dead / <span class="text-success">Slaughter</span></a>
                                  </div>
                                </div> 
                                @endif
                            @else
                              <button type="button" class="btn btn-outline-danger btn-sm" style="whitespace:normal;">Summon Vet </button> 
                          @endif

                      </td>
                    </tr> 
                    <div id="sell_animal" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                          <h4 class="modal-title">Sell {{ucfirst($animal->name)}}</h4>
                          </div>
                          <div class="modal-body">
                          <form action="{{route('sell_animal',$animal)}}" method="post">
                            @csrf
                              
                              <div class="first-column">
                                <div class="form-group">
                                  <label for="animal_weight">Enter Current Animal Weight</label>
                                <input type="number" class="form-control" name='animal_weight'id="animal_weight" aria-describedby="animal_weight" placeholder="" min='1'>
                                  <small id="animal_weight" class="form-text text-muted"> Current Weight.</small>
                                </div>

                                <div class="form-group">
                                  <label for="price">Price</label>
                                <input type="number" class="form-control" name='price'id="price" aria-describedby="price" placeholder="{{$animal->breed->price}} is the Recommended price">
                                  <small id="price" class="form-text text-muted">Price.</small>
                                </div>  
                                <div class="form-group">
                                  <label for="species" ><small>Recommendations</small> </label>
                                  <textarea class="form-control" id="recomendations" rows="3"  readonly>
                                  </textarea>
                                </div> 
                                <div class="form-group">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="call_vet" name="call_vet"  >
                                    <label class="custom-control-label" for="call_vet"><span class=""> Summon the  <span class="text-success">vet</span> </span>?</label><br>
                                    <label > <small><span class="text-warning"> Recommended * </span></small></label>
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
                    <div id="death" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Record Death</h4>
                          </div>
                          <div class="modal-body">
                          <form action="{{route('death_of_animal',$animal)}}" method="post">
                            @csrf
                              
                              <div class="first-column" >
                                <label > Reason...</label> <hr>
                                <div style="float: left ;width:45%;">
                                  <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="slaughter" name="all"  >
                                      <label class="custom-control-label" for="slaughter"><span class="text-"> Personal  <span class="text-success">uses</span> </span>?</label> <br>
                                      <small class="text-info"> Check this option if you want to use the animal for personal uses.</small>

                                    </div>                   
                                  </div>
                                </div>
                                <div style="float: right; width:45%;">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="summon_vet" name="all"  >
                                    <label class="custom-control-label" for="summon_vet"><span class="text-success"><span class="text-warning">Sickkness / Accident</span> </span>?</label><br>
                                    <small class="text-info"> A Local Vet will be automatically be summoned...</small>
                                  </div> 
                                </div>

                  
                                </div>
                                
                                
                                
                                {{-- incremental... will depend on the remaining size of farm --}}                  
          
          
                              
    
                            
                            
                            
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                        </div>
                    
                      </div>
                    </div>
                    <div id="summon_vet" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Sell</h4>
                          </div>
                          <div class="modal-body">
                          <form action="" method="post">
                            @csrf
                              
                              <div class="first-column" style='width:45%; float: left;'>
                                <div class="form-group">
                                  <label for="birds_for_sell">Number of Birds</label>
                                <input type="number" class="form-control" name='birds_for_sell'id="birds_for_sell" aria-describedby="birds_for_sell" placeholder=" is the max" min='1' max="">
                                  <small id="birds_for_sell" class="form-text text-muted"></small>
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
                    @empty
                    
                    
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

<!-- Modal -->

@endsection

