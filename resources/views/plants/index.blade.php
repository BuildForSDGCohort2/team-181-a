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
                        <input type="text" class="form-control" name='species'id="species" aria-describedby="species" placeholder="Enter plant type">
                        <small id="species" class="form-text text-muted">Select the Appropriate plant or Enter name.</small>
                      </div>
                                             
                       <div class="form-group">
                        <label for="type_id">Number / Strain</label>
                        <input type="text" name ='type_id'class="form-control" id="type_id" aria-describedby="type_id" placeholder="Select Strain">
                        <small id="type_id" class="form-text text-muted">Select the type..</small>
                      </div>

                      {{-- incremental... will depend on the remaining size of farm --}}
                   


                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                      <div class="form-group">
                        <label for="size">Size OF Allocation</label>
                        <input type="text" name ='size'class="form-control" id="size" aria-describedby="size" placeholder="Enter Total Size">
                        <small id="size" class="form-text text-muted">Enter size of the allocation</small>
                      </div> 
                      <label>Calibration in:</label><br>            
                      <input type = "radio"
                             name = "callibration"
                             id = "meters"
                             value = "meters" />
                      <label for = "meters">Meters &sup2; </label>
                    
                      <input type = "radio"
                             name = "callibration"
                             id = "acres"
                             value = "acres" />
                      <label for = "acres">Acres</label>
                    
                      <input type = "radio"
                             name = "callibration"
                             id = "hactares"
                             value = "hactares" />
                      <label for = "hactares">Hactares</label>
                  </fieldset> 

                      <div class="form-group">
                        <label for="planting_date">Date Of Planting</label>
                        <input type="date" class="form-control" name='planting_date' id="planting_date" aria-describedby="planting_date" placeholder="Enter Date of planting">
                        <small id="planting_date" class="form-text text-muted">Select date time Defaut date is today.</small>
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
                  @foreach ($plantations as $plantation)
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
                        {{-- calculate the day to harvest --}}
                      @php
                        $age= now()->diff(date_create($plantation->planting_date));
                        $yrs = ($plantation->plant_fact_sheet->months_to_maturity)/12 -($age->y);
                        $mnths = ($plantation->plant_fact_sheet->months_to_maturity) -($age->m);
                        $dys = ($plantation->plant_fact_sheet->months_to_maturity) -($age->d);
                         
                      @endphp

                      @if ($yrs > 0 || $mnths>0 || $dys> -7)                      
                        {{$yrs <1 ?'':$yrs.'yrs'}}
                        {{$mnths <1 ?'':$mnths.'mnths'}} 
                        {{$dys.'days'}} 
                      @elseif( $dys > -7)
                        
                        <button type="button" class="btn btn-outline-warning btn-sm"><span style="color:black;">Ready For</span> harvest
                      @else
                          <span class="text-danger">Overdue!</span>
                      @endif   
                    </td>
                    <td class="text-success">
                      @if ($yrs > 0 || $mnths>0 || $dys> -7)
                        {{($plantation->plant_fact_sheet->production_rate * $plantation->size_of_plantation)}} Sacks
                      @else
                      <span class="text-danger">Spoiling In the Farm </span> 
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
@endsection