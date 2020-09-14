@extends('layouts.app', ['activePage' => 'broods-table', 'titlePage' => __('Broods List')])

@section('content')
<div class="content">
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
                           value = "turkey" />
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

                </fieldset>                    
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


                       
                       <div class="form-group">
                        <label for="breed">Breed</label>
                        <input type="text" name ='breed'class="form-control" id="breed" aria-describedby="breedname" placeholder="Select Breed">
                        <small id="momsname" class="form-text text-muted">Select the Breed</small>
                      </div> 

                       <div class="form-group">
                        <label for="name">Broods' Age</label>
                        <input type="text" class="form-control" name='age' id="age" aria-describedby="age" placeholder="Enter age">
                        <small id="age" class="form-text text-muted">Enter Broods age , default is zero.</small>
                      </div>
                      


                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                     
                      <div class="form-group">
                        <label for="mothers_name">Mothers Name</label>
                        <input type="text" class="form-control" name='mothers_name' id="mothers_name" aria-describedby="momsname" placeholder="Enter Name">
                        <small id="momsname" class="form-text text-muted">Enter The Mothers Name or id</small>
                      </div>                      
                      
                      <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" class="form-control" name='number' id="number" aria-describedby="broods_number" placeholder="Enter Name">
                        <small id="broods_number "  class="form-text text-muted">Enter the broods number</small>
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
                    Type
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
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Thomas</span><span style="color: rgb(19, 197, 108)">&nbsp;(Bull)</span></a>                      
                    </td>
                    <td>
                      <a href="breed_info"><span style="color: black">Charolais</span></a>                       
                    </td>
                    <td>
                      12
                    </td>
                    {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                    <td class="text-primary">
                    <span style="color: rgb(19, 197, 108)">540Kg</span>
                    </td>
                    <td>
                      Healthy
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Jane</span><span style="color: rgb(19, 197, 108)">&nbsp;(Cow)</span></a>                      
                    </td>
                    <td>
                    <a href="{{route('breed_info')}}"> <span style="color: black">Fresian</span></a>                       
                    </td>
                    <td>
                      12
                    </td>
                    <td class="text-primary">
                    <span style="color: rgb(19, 197, 108)">20lts/day</span>
                    </td>
                    <td>
                      Sick <span style="color: red">&nbsp;(Yellow Fever)</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Ndun'gu</span><span style="color: rgb(19, 197, 108)">&nbsp;(Billy Goat)</span></a>                      
                    </td>
                    <td>
                      <a href="{{route('breed_info')}}"> <span style="color: black">Saaneen</span></a>                       
                    </td>
                    <td>
                      8
                    </td>
                    {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                    <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">&nbsp;80Kg</span>
                    </td>
                    <td>
                      Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(Prime)</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      4
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Lucka</span><span style="color: rgb(19, 197, 108)">&nbsp;(Ram)</span></a>                      
                    </td>
                    <td>
                      <a href="{{route('breed_info')}}"> <span style="color: black">Merino</span></a>                       
                    </td>
                    <td>
                      8
                    </td>
                    {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                    <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">&nbsp;50Kg</span>
                    </td>
                    <td>
                      Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(Prime)</span>
                    </td>
                  </tr>
                    <td>
                      5
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Avril</span><span style="color: rgb(19, 197, 108)">&nbsp;(F-Rabit)</span></a>                      
                    </td>
                    <td>
                      <a href="{{route('breed_info')}}"> <span style="color: black">Belgian Hare</span></a>                       
                    </td>
                    <td>
                      3
                    </td>
                    {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                    <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">&nbsp;30kg</span>
                    </td>
                    <td>
                      Healthy
                    </td>
                  </tr>
                  <tr>
                    <td>
                      6
                    </td>
                    <td>
                      <a href={{route('animal_show')}}> <span style="color: black">Mary</span><span style="color: rgb(19, 197, 108)">&nbsp;(F-Pig)</span></a>                      
                    </td>
                    <td>
                      <a href="{{route('breed_info')}}"> <span style="color: black">Large White</span></a>                       
                    </td>
                    <td>
                      5
                    </td>
                    {{-- The colur of this column sill change acording to the current status of the cow or bull --}}
                    <td class="text-primary">
                      <span style="color: rgb(19, 197, 108)">&nbsp;340Kg</span>
                    </td>
                    <td>
                      Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(PG)</span>
                    </td>
                  </tr>
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