@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('The Famers
Assistant.')])

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
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="container" style="background: rgb(28, 22, 22) !important,height: auto;">
    <div class="row c">
        <div class="col-lg-7 col-md-8 text-center">
            <h1 class="text-white text-center">{{ __("The Farmer's Assistant.") }}</h1>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-12 text-center "
                style="border:1px solid white; border-radius: 25px; margin:0.1px; ">
                <h3>Agricultural Services</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="material-icons" style="font-size:42px;    margin-left: 10px;">biotech</i>
                <a href="/professionals">
                    <button class="btn btn-outline"
                        style="border: 1px solid white; color: white; white-space: normal; "><i class="fa fa-search"
                            aria-hidden="true"></i> Hire A <span style="color: rgb(255, 179, 0)">proffessional</span>
                    </button>
                </a>
                <p style="padding-top: 20%">
                    Farmers Can now seek Veterinary services and slso field extention services on this platform.
                    A Group of Readily available Professionals are readily available.
                </p>
                <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal; "
                    data-toggle="modal" data-target="#professional_modal" style="float: right;"> <i
                        class="material-icons">person_add</i> Register as A <span
                        style="color: rgb(255, 179, 0)">proffessional</span> </button>
                {{-- <a href="{{ route('register') }}">
                <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal; "> <i
                        class="material-icons">person_add</i> Register as A <span
                        style="color: rgb(255, 179, 0)">proffessional</span> </button>
                </a> --}}
            </div>

            {{-- this is the supplier registration modal --}}



            <div class="col-lg-3 col-md-12 text-center "
                style="border:1px solid white; border-radius: 25px; margin:0.1px;">
                <h3>Agricultural Products</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="fa fa-envira" style="font-size: 48px" aria-hidden="true"></i>
                <a href="{{ route('on_sale') }}">
                    <button class="btn btn-outline"
                        style="border: 1px solid white; color: white;white-space: normal; "><i
                            class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp; Browse and buy <span
                            style="color: greenyellow">farmer's Produce</span> </button>
                </a>
                <p style="padding-top: 20%">
                    The Farmer of couse is the center of our Sysytem.
                    When The produce is ready the farmer will get a Notification from the system alerting him/her to
                    this very fact.
                    If comfortable the farmer will confirm the notification, and the system will automatically post the
                    product for sale.
                </p>
                <button class="btn btn-outline"
                    style="border: 1px solid white; color: white; white-space: normal;margin-bottom:20px; "
                    data-toggle="modal" data-target="#farmers_modal" style="float: right;"> <i
                        class="material-icons">person_add</i> Register as A <span
                        style="color: greenyellow">Farmer</span> </button>

            </div>
            <div class="col-lg-3 col-md-12 text-center "
                style="border:1px solid white; border-radius: 25px;margin:0.1px; ">
                <h3>Agricultural Supplies</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="fa fa-truck" style="font-size:42px;" aria-hidden="true"></i>
                <a href="/suppliers">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; ">
                        <i class="material-icons">sync</i> Browse for <span
                            style="color: rgb(243, 162, 12)">Suppliers</span> </button>
                    <p style="padding-top: 20%">
                </a>

                Suppliers Too can enroll in this system. The system will coodinate the Buying of thr various farm inputs
                needed. the farmer will only worry about the farm, all the logistics wil be handled by his 'Assistant'.
                </p>
                <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal; "
                    data-toggle="modal" data-target="#supplier_modal" style="float: right;"> <i
                        class="material-icons">person_add</i> Register as A <span
                        style="color: rgb(255, 179, 0)">supplier</span> </button>

            </div>

        </div>
    </div>
</div>
{{-- supplier --}}
<div id="supplier_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black"> Register as a <span
                        style="color: rgb(255, 179, 0)">supplier</span></h4>
                <small class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small>

            </div>
            <div class="modal-body">
                <form action="{{route('suppliers_enrole')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="first-column" style='width:45%; float: left;'>
                        <div class="form-group">
                            <label for="name">Full <span class='text-primary'>business</span> name </label>
                            <input type="text" class="form-control" name='name' id="name" aria-describedby="name"
                                placeholder="enter business name" required>
                            <small id="type" class="form-text text-muted">Name of business.</small>
                        </div>

                        <div class="form-group">
                            <label for="size">Email</label>
                            <input type="email" name='email' class="form-control" id="email" aria-describedby="mail"
                                placeholder="abc@xyz.com" required>
                            <small id="mail" class="form-text text-muted">Enter Email</small>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name='location' class="form-control" id="location" aria-describedby="loc"
                                placeholder="eg. Nakuru.." required>
                            <small id="loc" class="form-text text-muted">Enter Location</small>
                        </div>

                        <div class="form-group">
                            <label for="strain">Phone number</label>
                            <input type="text" name='phone_number' class="form-control" id="phone_number"
                                aria-describedby="pnumber" placeholder="XXX-XXX" required>
                            <small id="pnumber" class="form-text text-muted">Enter Phone number</small>
                        </div>
                    </div>

                    <div class="second-column" style='width:45%; float: right;'>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="kra" name='kra' required>
                            <label class="custom-file-label" for="kra">Upload <span class="text-danger">KRA</span>
                                Cert</label>
                            <div class="invalid-feedback">Invalid File</div>
                        </div>

                        <fieldset>
                            <label>Specialty:</label><br>
                            {{--  must check on e of these--}}
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="hardware" name="hardware">
                                    <label class="custom-control-label" for="hardware"> Hardware</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="agrovet" name="agrovet">
                                    <label class="custom-control-label" for="agrovet"> Agrovet</label>
                                </div>
                            </div>

                        </fieldset>

                        {{-- file uploader --}}

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="transport" id="transport">
                                <label class="custom-control-label" for="transport">Can You Provide <span
                                        class="text-warning">Transport</span> ? </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree" name='agree'
                                    required>
                                <input type="checkbox" class="custom-control-input" id="agree" name='agree'>
                                <label class="custom-control-label" for="agree"> Agree to <a href="#"
                                        class="text-primary">terms and conditions</a> </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="reg_type" name="reg_type" value="suplier">
                    <div class="modal-footer" style='width:55%; float: right;'>
                        <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

{{--proffesional  --}}
<div id="professional_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black"> Register as a <span
                        style="color: rgb(255, 179, 0)">proffessional</span></h4>
                <small class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small>

            </div>
            <div class="modal-body">
                <form action="{{route('profesionals_enrole')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="first-column" style='width:45%; float: left;'>
                        <div class="form-group">
                            <label for="type">Full Names</label>
                            <input type="text" class="form-control" name='name' id="name" aria-describedby="name"
                                placeholder="Enter Your Full names" required>
                            <small id="type" class="form-text text-muted">As they appear on the id.</small>
                        </div>

                        <div class="form-group">
                            <label for="strain">Id number</label>
                            <input type="text" name='id_number' class="form-control" id="id_number"
                                aria-describedby="idnumber" placeholder="XXX-XXX" required>
                            <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                        </div>
                        <div class="form-group">
                            <label for="strain">Phone number</label>
                            <input type="text" name='phone_number' class="form-control" id="phone_number"
                                aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                            <small id="phonenumber" class="form-text text-muted">Enter Id number</small>
                        </div>
                        <fieldset>
                            <label>Specialty:</label><br>
                            <input type="radio" name="specialty" id="vet" value="vet" />
                            <label for="vet">Vet</label>

                            <input type="radio" name="specialty" id="feo" value="feo" />
                            <label for="feo">Feild Extension Officer</label>

                            <input type="radio" name="specialty" id="other" value="other" />
                            <label for="other">Other</label>
                        </fieldset>
                        <div class="form-group">
                            <label for="other">If Other Please Specify</label>
                            <input type="text" name='other' class="form-control" id="other" aria-describedby="other"
                                placeholder="Enter The Specialty">
                            <small id="other" class="form-text text-muted">Please Specify </small>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name='location' class="form-control" id="location" aria-describedby="loc"
                                placeholder="eg. Nakuru.." required>
                            <small id="loc" class="form-text text-muted">Enter Location</small>
                        </div>


                    </div>

                    <div class="second-column" style='width:45%; float: right;'>

                        {{-- this input shoulf be inactive if the specialty selected is not other --}}

                        <div class="form-group">
                            <label for="strain">Id number</label>
                            <input type="text" name='id_number' class="form-control" id="id_number"
                                aria-describedby="idnumber" placeholder="XXX-XXX" required>
                            <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                        </div>

                        <div class="form-group">
                            <label for="size">Email</label>
                            <input type="email" name='email' class="form-control" id="email" aria-describedby="mail"
                                placeholder="abc@xyz.com" required>
                            <small id="mail" class="form-text text-muted">Enter Email</small>
                        </div>


                        <div class="form-group">
                            <label for="exp">Years Of Expirience</label>
                            <input type="text" class="form-control" name='exp' id="exp" aria-describedby="expirience"
                                placeholder="0">
                            <small id="expirience" class="form-text text-muted">Please indicate the Number of years of
                                Experience .</small>
                        </div>

                        {{-- file uploader --}}
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file" required>
                            <label class="custom-file-label" for="file">Upload <span class="text-danger">CV</span>
                            </label>
                            <div class="invalid-feedback">Invalid File</div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agre" name="agre" required>
                                <label class="custom-control-label" for="agre"> Agree to <a href="#"
                                        class="text-primary">terms and conditions</a> </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style='width:55%; float: right;'>
                        <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <input type="hidden" id="reg_type" name="reg_type" value="proffessional">

                </form>
            </div>
        </div>

    </div>
</div>
{{--  farmers Modal  --}}

<div id="farmers_modal" class="modal fade " role="dialog" style="margin-top: 10%; ">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black"> Register as a <span style="color: green">Farmer</span>
                </h4>
                <strong class="form-text text-muted">Welcome To the Platform that is all about <span
                        class="text-success">You..</span> ..</strong>

            </div>
            <div class="modal-body">
                <form action="{{route('farmers_enrole')}}" method="POST">
                    @csrf
                    <div class="first-column" style='width:32%; float: left;margin-right:1%'>
                        <div class="form-group">
                            <label for="type">Full Names</label>
                            <input type="text" class="form-control" name='name' id="name" aria-describedby="name"
                                placeholder="Enter Your Full names" required>
                            <small id="type" class="form-text text-muted">As they appear on the id.</small>
                        </div>

                        <div class="form-group">
                            <label for="strain">Id number</label>
                            <input type="text" name='id_number' class="form-control" id="id_number"
                                aria-describedby="idnumber" placeholder="XXX-XXX" required>
                            <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                        </div>
                        <div class="form-group">
                            <label for="strain">Phone number</label>
                            <input type="text" name='phone_number' class="form-control" id="phone_number"
                                aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                            <small id="phonenumber" class="form-text text-muted">Enter Phone number</small>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name='location' class="form-control" id="location" aria-describedby="loc"
                                placeholder="eg. Nakuru.." required>
                            <small id="loc" class="form-text text-muted">Enter Location</small>
                        </div>


                    </div>

                    <div class="second-column" style='width:32%; float: left;margin-right:1%'>
                        {{-- this input shoulf be inactive if the specialty selected is not other --}}
                        <div class="form-group">
                            <label for="size"> Farm size..</label>
                            <input type="text" name='size' class="form-control" id="size" aria-describedby="size"
                                placeholder="optional">
                            <small id="size" class="form-text text-muted">Farm Size..</small>
                        </div>
                        <label>Calibration in:</label><br>
                        <input type="radio" name="callibration" id="meters" value="meters" />
                        <label for="meters">M &sup2; </label>

                        <input type="radio" name="callibration" id="acres" value="acres" />
                        <label for="acres">Acr</label>

                        <input type="radio" name="callibration" id="hactares" value="hactares" />
                        <label for="hactares">Ha</label>
                        <label>Check Where Appropriate:</label><br>
                        {{--  must check on e of these--}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="animals" name="fields[animal]">
                                <label class="custom-control-label" for="animals"> Animals</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="crops" name="fields[crops]">
                                <label class="custom-control-label" for="crops">Crops</label>
                            </div>
                        </div>


                        {{-- file uploader --}}


                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="poultry" name="fields[poultry]">
                                <label class="custom-control-label" for="poultry">Poultry Broods</label>
                            </div>
                        </div>


                    </div>
                    <div class="third-column" style='width:32%; float: right;margin-right:1%'>
                        <div class="form-group">
                            <label for="size">Email</label>
                            <input type="email" name='email' class="form-control" id="email" aria-describedby="mail"
                                placeholder="abc@xyz.com" required>
                            <small id="mail" class="form-text text-muted">Enter Email</small>
                        </div>


                        <div class="form-group">
                            <label for="exp">Password..</label>
                            <input type="password" class="form-control" name='password' id="password"
                                aria-describedby="password" placeholder="password" required>
                            <small id="expirience" class="form-text text-muted">Password</small>
                        </div>

                        {{-- file uploader --}}
                        <div class="form-group">
                            <label for="password">Confirm Password..</label>
                            <input type="password" class="form-control" name='conf_password' id="conf_password"
                                aria-describedby="conf_password" placeholder="password" required>
                            <small id="password" class="form-text text-muted"> Confirm Password</small>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agr" name="agr" required>
                                <label class="custom-control-label" for="agr"> Agree to <a href="#"
                                        class="text-primary">terms and conditions</a> </label>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <input type="hidden" id="reg_type" name="reg_type" value="farmer">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
