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
                    @foreach ($animals as $animal)
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
                      {{$age->y}}yrs
                      {{$age->m}} mnths  
                      {{$age->d}} days                      
                        
                      </td>
                      {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                      <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">{{$animal->weight}}</span>
                      </td>
                      <td>
                        {{-- if the animals healthy --}}
                        @if ($animal->health_status == 0)
                            {{-- if the animal is an Adolescent --}}
                            @if ($animal->reproductive_status >0 )
                                {{-- gender checker --}}
                                @if ($animal->gender == 'female')
                                  {{-- ternary to check pregnancy --}}
                                  <span class="text-success">{{$animal->reproductive_status == 2? 'Pregnant & Healthy':'Healthy Adolescent' }}</span>
                                @else
                                  {{-- productive male --}}
                                    <span class="text-success">Healthy Adolescent</span>
                                @endif
                            @else
                                <span class="text-success">Healthy</span>
                            @endif
                        @else
                            <span class="text-danger">Unhealthy</span>
                        @endif

                      </td>
                      <td>
                        {{-- if the animals healthy --}}
                        @if ($animal->health_status == 0)
                            {{-- if the animal is an Adolescent --}}
                                {{-- gender checker --}}
                                @if ($animal->gender == 'female' && $animal->reproductive_status >0 )
                                  {{-- ternary to check pregnancy  and summon vet accordingly  will add the time calculator.. time to birth --}}
                                  @if ($animal->reproductive_status==1)
                                    <button type="button" class="btn btn-outline-warning btn-sm" style=" white-space: normal;">Summon Vet For Ai Procedure</button>
                                  @elseif($animal->reproductive_status==2)
                                    <button type="button" class="btn btn-outline-success btn-sm" style=" white-space: normal;">Summon Vet For Checkup</button> 
                                  @endif
                            @endif
                        @else
                          <button type="button" class="btn btn-outline-danger btn-sm" style="whitespace:normal;">Summon Vet </button> 
                        @endif

                      </td>
                    </tr>  
                    @endforeach
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

