@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('issues')])

@section('content')


<div class="content">

  <div class="container-fluid">
    <nav >
      @if (auth()->user()->hasRole('admin'))
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link active" style="background-color: blueviolet" href="#">Proffesionals</a>
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
          <a class="nav-link "  href="{{route('issues')}}">User Requests</a>
        </li>
      </ul>
      @else
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link "  href="{{route('issues')}}">Issues</a>
        </li>
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
                    Name
                  </th>
                  <th>
                    Specialty
                  </th>
                  <th>
                    Location
                  </th>
                  <th>
                    Actions
                  </th>
                </thead>
                <tbody>

                @forelse ($pending_profesionals as $prof)
                <tr>
                    <td>
                     {{$prof->id}}
                    </td>
                    <td>
                     {{ucfirst($prof->name)}}
                    </td>
                    <td>
                    @if ($prof->specialty == 'vet')
                        <span class="text-primary"> Vet </span>
                    @else
                        <span class="text-success"> F.E.O </span>
                    @endif
                    </td>
                    <td>
                      {{$prof->location}}
                    </td>
                    <td>
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#professional_modal">View info</button>

                    </td>
                </tr>
                @empty
                <tr>
                  <td>
                    <span class="text-primary"> No Enrolement Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Enrolement Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Enrolement Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Enrolement Requests</span>
                  </td>
                  <td>
                    <span class="text-primary"> No Enrolement Requests</span>
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
<div id="professional_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: black"> Register as a <span style="color: rgb(255, 179, 0)">proffessional</span></h4>
          <small  class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small>
        </div>
        <div class="modal-body">
          {{-- proffesional_account_decision,$prof  is the route to follow... pa --}}
        <form action="" method="POST">
          @csrf
            <div class="first-column" style='width:45%; float: left;'>
              <div class="form-group">
                <label for="type">Full Names</label>
                <input type="text" class="form-control" name='name'id="name" aria-describedby="name" value ="" required>
                <small id="type" class="form-text text-muted">As they appear on the id.</small>
              </div>
               <div class="form-group">
                <label for="strain">Id number</label>
                <input type="text" name ='id_number'class="form-control" id="id_number" aria-describedby="idnumber" value ="" required>
                <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
              </div>
              <div class="form-group">
                <label for="strain">Phone number</label>
                <input type="text" name ='phone_number'class="form-control" id="phone_number" aria-describedby="phonenumber" value ="" required>
                <small id="phonenumber" class="form-text text-muted">Enter Id number</small>
              </div>
              <fieldset>
                <label>Specialty:</label><br>
                <input type = "radio"
                       name = "specialty"
                       id = "vet"
                       value = "vet" 
                      />
                <label for = "vet">Vet</label>
                <input type = "radio"
                       name = "specialty"
                       id = "feo"
                       value = "feo" 
                      />
                <label for = "feo">Feild Extension Officer</label>
                <input type = "radio"
                       name = "specialty"
                       id = "other"
                       value = "other" />
                <label for = "other">Other</label>
            </fieldset>
            <div class="form-group">
              <label for="other">If Other Please Specify</label>
              <input type="text" name ='other'class="form-control" id="other" aria-describedby="other" placeholder="Enter The Specialty">
              <small id="other" class="form-text text-muted">Please Specify </small>
            </div>
            <div class="form-group">
              <label for="location">Location</label>
            <input type="text" name ='location'class="form-control" id="location" aria-describedby="loc" value="" required>
              <small id="loc" class="form-text text-muted">Enter Location</small>
            </div>


            </div>

            <div class="second-column" style='width:45%; float: right;'>

            {{-- this input shoulf be inactive if the specialty selected is not other --}}

              <div class="form-group">
                <label for="strain">Id number</label>
                <input type="text" name ='id_number'class="form-control" id="id_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
              </div>
              <div class="form-group">
                <label for="size">Email</label>
                <input type="email" name ='email'class="form-control" id="email" aria-describedby="mail" placeholder="abc@xyz.com" required>
                <small id="mail" class="form-text text-muted">Enter Email</small>
              </div>


              <div class="form-group">
                <label for="exp">Years Of Expirience</label>
                <input type="text" class="form-control" name='exp' id="exp" aria-describedby="expirience" placeholder="0">
                <small id="expirience" class="form-text text-muted">Please indicate the Number of years of Experience .</small>
              </div>
              {{-- file uploader --}}
              <div class="custom-file">
                <input type="file" class="custom-file-input"  name="file" id="file" required>
                <label class="custom-file-label" for="file">Upload <span class="text-danger">CV</span> </label>
                <div class="invalid-feedback">Invalid File</div>
              </div>

              <label>Decision:</label><br>
              <input type = "radio"
                     name = "status"
                     id = "accept"
                     value = "accept" />
              <label for = "accept">Approve Request</label>
              <input type = "radio"
                     name = "status"
                     id = "decline"
                     value = "decline" />
              <label for = "decline">Decline Request</label>

            </div>



        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" value="Submit">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        <input type="hidden" id="reg_type" name="reg_type" value="proffessional">

      </form>
      </div>

    </div>
  </div>
@endsection
