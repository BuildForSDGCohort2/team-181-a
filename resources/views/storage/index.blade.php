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
            <a class="nav-link active" style="background-color: blueviolet" href="#">User Requests</a>
          </li>
        </ul>
        @else
        <ul class="nav nav-pills">


          <li class="nav-item">
            <a class="nav-link " href="{{route('issues')}}">Issues</a>
          </li>

          @if (auth()->user()->hasRole('farmer'))
           <li class="nav-item">
              <a class="nav-link active" style="background-color: blueviolet" href="#">Store</a>
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
            <h4 class="card-title ">Resources in the Store</h4>
            <p class="card-category">Sell or Take Farm Produce</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" ">
                  <th>
                    ID
                  </th>
                  <th>
                    Contents
                  </th>
                  <th>
                    Status
                  </th>

                  <th>
                    Actions
                  </th>
                </thead>
                <tbody>

                @forelse ($user_items as $item)
                <tr>
                    <td>
                      {{$item->id}}
                    </td>

                    <td>
                     {{ucfirst($item->plantation->species.'('.$item->plantation->plant_fact_sheet->type.')'.$item->sacks.'Scks')}}
                    </td>

                    <td>
                        Stored
                    - <span class="text-primary"> {{$item->sales->amount?? 0}} put on sale</span>

                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          ...
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sell"  @click="open_edit({{ $item }})"> Sell</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#take" @click="open_edit({{ $item }})">Take</a>
                        </div>
                      </div>
                    </td>
                </tr>
                <div id="sell" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Sell</h4>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('sell_from_storage',$item)}}" method="post">
                        @csrf

                          <div class="first-column" style='width:45%; float: left;'>
                            <div class="form-group">
                              <label for="sacks_for_sale">Number of Sacks</label>
                            <input type="number" class="form-control" v-model='form.sacks_for_sale'id="sacks_for_sale" aria-describedby="sacks_for_sale" placeholder="{{$item->sacks}} is the max" min='1' max="{{$item->sacks}}">
                              <small id="sacks_for_sale" class="form-text text-muted">{{$item->sacks}} Sacks Remaining.</small>
                            </div>
                            <div class="form-group">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="sell_all" v-model="form.sell_all"  >
                                <label class="custom-control-label" for="sell_all"><span class="text-success"> Sell <span class="text-warning">All</span> </span>?</label>
                              </div>
                            </div>



                            {{-- incremental... will depend on the remaining size of farm --}}


                          </div>
                          <div class="second-column" style='width:45%; float: right;'>


                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="number" class="form-control" v-model='form.price'id="price" aria-describedby="price" placeholder="Enter the sack price">
                              <small id="price" class="form-text text-muted">The price Per sack.</small>
                            </div>
                            <div class="form-group">
                              <label for="species" ><small>Recommendations</small> </label>
                              <textarea class="form-control" id="recomendations" rows="3"  readonly>
                              </textarea>
                            </div>


                          </div>



                      </div>
                      <div class="modal-footer">
                        <button @click="save_item('/sell/' + edit_form.id  + '/product')" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                    </div>

                  </div>
                </div>
                <div id="take" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Take From Store</h4>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('take_from_storage',$item)}}" method="post">
                        @csrf

                          <div class="first-column" >
                            <div class="form-group">
                              <label for="sacks_for_sale">Number of Sacks</label>
                            <input type="number" class="form-control" name='sacks_for_sale'id="sacks_for_sale" aria-describedby="sacks_for_sale" placeholder="{{$item->sacks}} is the max" min='1' max="{{$item->sacks}}">
                              <small id="sacks_for_sale" class="form-text text-muted">{{$item->sacks}} Sacks Remaining.</small>
                            </div>
                            <div class="form-group">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="all" name="all"  >
                                <label class="custom-control-label" for="all"><span class="text-success"> Take <span class="text-warning">All</span> </span>?</label>
                              </div>
                            </div>
                            {{-- incremental... will depend on the remaining size of farm --}}
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button  @click="save_item('/take/' + edit_form.id  + '/product')" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                    </div>

                  </div>
                </div>
                @empty
                <tr>
                  <td>
                    <span class="text-primary"> No items in Storage.</span>
                  </td>
                  <td>
                    <span class="text-primary"> No items in Storage.</span>
                  </td>
                  <td>
                    <span class="text-primary"> No items in Storage.</span>
                  </td>
                  <td>
                    <span class="text-primary"> No items in Storage.</span>
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
        <form action="{{route('profesionals_enrole')}}" method="POST">
          @csrf
            <div class="first-column" style='width:45%; float: left;'>
              <div class="form-group">
                <label for="type">Full Names</label>
                <input type="text" class="form-control" name='name'id="name" aria-describedby="name" placeholder="Enter Your Full names" required>
                <small id="type" class="form-text text-muted">As they appear on the id.</small>
              </div>

               <div class="form-group">
                <label for="strain">Id number</label>
                <input type="text" name ='id_number'class="form-control" id="id_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
              </div>
              <div class="form-group">
                <label for="strain">Phone number</label>
                <input type="text" name ='phone_number'class="form-control" id="phone_number" aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                <small id="phonenumber" class="form-text text-muted">Enter Id number</small>
              </div>
              <fieldset>
                <label>Specialty:</label><br>
                <input type = "radio"
                       name = "specialty"
                       id = "vet"
                       value = "vet" />
                <label for = "vet">Vet</label>

                <input type = "radio"
                       name = "specialty"
                       id = "feo"
                       value = "feo" />
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
              <input type="text" name ='location'class="form-control" id="location" aria-describedby="loc" placeholder="eg. Nakuru.." required>
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

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="agre" name="agre"  required>
                  <label class="custom-control-label" for="agre"> Agree to <a href="#" class="text-primary">terms and conditions</a> </label>
                </div>
              </div>

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
