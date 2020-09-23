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
                <form action="{{route('brood.store')}}" method="POST">
                  @csrf 
                <div class="first-column" style='width:45%; float: left;'>
 
                  <fieldset> 
                    
                    {{-- We coulld use a Dropdown or the user couold input if the brood is not in the list --}}
                    <label>Species:</label><br>            
                    <input type = "radio"
                           name = "species"
                           id = "turkey"
                           value = "turkey"  />
                    <label for = "turkey">Turkey</label>
                  
                    <input type = "radio"
                           name = "species"
                           id = "chicken"
                           value = "chicken" />
                    <label for = "chicken">Chicken</label>
                  
                    <input type = "radio"
                           name = "species"
                           id = "duck"
                           value = "duck" />
                    <label for = "duck">Duck</label>
                    

                    <div class="form-group">
                      <label for="others">Others</label>
                      <input type="text" name ='others'class="form-control" id="others" aria-describedby="others" placeholder="Please indicate">
                      <small id="others" class="form-text text-muted">Please indicate</small>
                    
                    </div> 
                </fieldset>                    
                      <fieldset required>                
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


                       
                       <div class="form-group">
                        <label for="breed">Breed</label>
                        <input type="text" name ='breed'class="form-control" id="breed" aria-describedby="breedname" placeholder="Select Breed">
                        <small id="momsname" class="form-text text-muted">Select the Breed</small>
                      </div> 


                      


                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                     
                      <div class="form-group">
                        <label for="name">Hatched on...</label>
                        <input type="date" class="form-control" name='hatch_date' id="age" aria-describedby="hatch_date" required>
                        <small id="hatch_date" class="form-text text-muted">Enter the Hatching date....</small>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="number">Number of Birds</label>
                        <input type="text" class="form-control" name='number' id="number" aria-describedby="broods_number" placeholder="Enter Number of Birds" required>
                        <small id="broods_number "  class="form-text text-muted">Enter the broods number</small>
                      </div>

                      <div class="form-group">
                        <label for="sellers_name">Sellers Name</label>
                        <input type="text" class="form-control" name='sellers_name' id="sellers_name" aria-describedby="suppliers_name" placeholder="Enter Name" required>
                        <small id="suppliers_name" class="form-text text-muted">Enter The Suppliers Name or id</small>
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
                    @foreach ($broods as $brood)
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
                            <a class="dropdown-item" href="#">Sell</a>
                            @if ($age->y > 0 || $age->m > 4 )                                
                            <a class="dropdown-item" href="#"><span class="text-primary">View production Records</span>  </a> {{-- the pop up would record the various varibles that would accopany that eg number etc--}}
                            @endif
                            <a class="dropdown-item" href="#"><span class="text-danger">Record Death</span>  </a> {{-- the pop up would record the various varibles that would accopany that eg number etc--}}

                          </div>
                        </div>

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

<!-- Modal -->

@endsection