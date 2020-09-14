@extends('layouts.app', ['activePage' => 'plants-table', 'titlePage' => __('Plants List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Plantations On Farm..</h4>
            <p class="card-category"> Showing six (6) Plantations</p>
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
                        <label for="type">Type Of Plant</label>
                        <input type="text" class="form-control" name='type'id="type" aria-describedby="type" placeholder="Enter plant type">
                        <small id="type" class="form-text text-muted">Select the Appropriate plant or Enter name.</small>
                      </div>
                                             
                       <div class="form-group">
                        <label for="strain">Number / Strain</label>
                        <input type="text" name ='strain'class="form-control" id="strain" aria-describedby="strain" placeholder="Select Strain">
                        <small id="strain" class="form-text text-muted">Select the Strain</small>
                      </div>

                      {{-- incremental... will depend on the remaining size of farm --}}
                   


                    </div>
                    <div class="second-column" style='width:45%; float: right;'>
                      <div class="form-group">
                        <label for="size">Size OF Allocation</label>
                        <input type="text" name ='size'class="form-control" id="size" aria-describedby="size" placeholder="Enter Total Size">
                        <small id="size" class="form-text text-muted">Enter size of the allocation</small>
                      </div>  

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
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                     Maize <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(Katumani)</span></a>                    
                    </td>
                    <td>                      
                      10 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      1 Month 3 Days
                    </td>
                    <td class="text-success">
                      100 Sacks
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                     Wheat <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(EinKorn)</span></a>                   
                    </td>
                    <td>                      
                      10 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      1 Month 3 Days
                    </td>
                    <td class="text-success">
                      100 Sacks
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                     Beans <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(Rose Coco)</span></a>                     
                    </td>
                    <td>                      
                      14 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      <span style="color: red"> Past Due!</span>
                    </td>
                    <td class="text-success">
                      15 Sacks
                    </td>
                  </tr>
                  <tr>
                    <td>
                      4
                    </td>
                    <td>
                     Tea <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(Purple Tea)</span></a>                     
                    </td>
                    <td>                      
                      14 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      0 Months 3 Days
                    </td>
                    <td class="text-success">
                      15 Tonnes
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                     Beans <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(Rose Coco)</span></a>                     
                    </td>
                    <td>                      
                      14 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      <span style="color: rgb(19, 197, 108)">Ready!</span>
                    </td>
                    <td class="text-success">
                      15 Sacks
                    </td>
                  </tr>
                  <tr>
                    <td>
                      6
                    </td>
                    <td>
                     Grapes <a href="{{route('plant_info')}}"><span style="color: rgb(19, 197, 108)">(Green Grapes)</span></a>                     
                    </td>
                    <td>                      
                      14 Acres
                    </td>
                    <td>
                      {{-- will be calclted from thr fact sheet --}}
                      0 Months 3 Days
                    </td>
                    <td class="text-success">
                      15 Sacks
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
@endsection