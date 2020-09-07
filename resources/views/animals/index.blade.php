@extends('layouts.app', ['activePage' => 'animals-table', 'titlePage' => __('Plants List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Animals List</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
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
@endsection