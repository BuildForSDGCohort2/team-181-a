@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Table List')])

@section('content')


<div class="content">

  <div class="container-fluid">
    <nav >
        @if (auth()->user()->hasRole('admin'))
        <ul class="nav nav-pills">
          <li class="nav-item">
          <a class="nav-link " href="{{route('notifications')}}">Proffesionals</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('pending_suppliers')}}">Suppliers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('orders')}}">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('dispatch')}}">Dispatch</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="background-color: blueviolet" href="#">User Requests</a>
          </li>
        </ul>
        @else
        <ul class="nav nav-pills">


          <li class="nav-item">
            <a class="nav-link active" style="background-color: blueviolet" href="#">Issues</a>
          </li>

          @if (auth()->user()->hasRole('farmer'))
           <li class="nav-item">
              <a class="nav-link "  href="{{route('storage')}}">Store</a>
            </li>
         @endif

          <li class="nav-item">
            <a class="nav-link" href="{{route('orders')}}">Orders</a>
          </li>
        </ul>

        @endif

      </nav>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Pending Professional Requests</h4>
            <p class="card-category"> Approve or decline Professionals</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" ">
                  <th>
                    ID
                  </th>
                  <th>
                    Reason
                  </th>
                  <th>
                    Information
                  </th>

                  <th>
                    Actions
                  </th>
                </thead>
                <tbody>

                @forelse ($issues as $issue)
                <tr>
                  <td>
                    @if (in_array('PLT',explode('-',$issue->identifier)))
                      <i class="fa fa-pagelines "></i>
                    @elseif(in_array('ANML',explode('-',$issue->identifier)))
                      <i class="material-icons">pets</i>
                    @elseif(in_array('POLTR',explode('-',$issue->identifier)))
                      <i class="fa fa-bold" aria-hidden="true"></i>
                    @else
                      <i class="material-icons">api</i>
                    @endif
                    </td>

                    <td>
                     {{ucfirst($issue->reason)}}
                    </td>

                    <td>

                      {{$issue->information.(in_array('RMNDR',explode('-',$issue->identifier))?now()->diff(date_create($issue->due_date))->d.'days from now':null )}}
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#professional_modal" @click="open_issue({{ $issue->id }})">View info</button>
                    </td>
                </tr>
                @empty
                <tr>
                  <td>
                    <span class="text-primary"> No Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Requests</span>
                  </td>
                </tr>
                @endforelse
                </tbody>
              </table>

              {{ $issues->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="professional_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: black"> Issue <span style="color: rgb(255, 179, 0)">@{{ issues_show.identifier }}</span></h4>
          {{-- <small  class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small> --}}

        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item"><b>Reason:</b> <span style="margin-left: 30px">@{{ issues_show.reason }}</span></li>
                <li class="list-group-item"><b>Information:</b> <span style="margin-left: 30px">@{{ issues_show.information }}</span></li>
              </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-info" @click="save_item('mark_as_read')">Mark as read</button>
      </div>

    </div>
  </div>
</div>
@endsection
