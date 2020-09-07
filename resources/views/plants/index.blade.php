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