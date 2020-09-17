@extends('layouts.auth', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material
Dashboard')])

@section('content')
<div class="container" style="height: auto;">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-8 col-sm-8 ml-auto mr-auto">
            <div class="card card-register card-hidden mb-3" style="    padding: 30px;">

                <form method="POST" action="{{ route('supplier.register') }}" aria-label="{{ __('Register') }}">
                    {{-- <form class="form" method="POST" action="{{ route('register') }}"> --}}
                    @csrf


        <div class="first-column" style='width:45%; float: left;'>
            <div class="form-group">
                <label for="name">Full <span class='text-primary'>business</span> name </label>
                <input type="text" class="form-control" name='name' id="name" aria-describedby="name"
                    placeholder="enter business name" required>
                <small id="type" class="form-text text-muted">Name of business.</small>


                @if ($errors->has('name'))
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="size">Email</label>
                <input type="email" name='email' class="form-control" id="email" aria-describedby="mail"
                    placeholder="abc@xyz.com">
                <small id="mail" class="form-text text-muted">Enter Email</small>

                @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
                @endif
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
                    aria-describedby="idnumber" placeholder="XXX-XXX" required>
                <small id="idnnumber" class="form-text text-muted">Enter Phone number</small>
            </div>
        </div>

        <div class="second-column" style='width:45%; float: right;'>

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                <label class="custom-file-label" for="validatedCustomFile">Upload <span class="text-danger">KRA</span>
                    Cert</label>
                <div class="invalid-feedback">Invalid File</div>
            </div>

            <fieldset>
                <label>Specialty:</label><br>
                {{--  must check on e of these--}}
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="hardware" value="hardware"
                            name="hardware">
                        <label class="custom-control-label" for="hardware"> Hardware</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="agrovet" value="agrovet" name="agrovet">
                        <label class="custom-control-label" for="agrovet"> Agrovet</label>
                    </div>
                </div>

            </fieldset>

            {{-- file uploader --}}


            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="transport" class="custom-control-input" id="transport" value="true">
                    <input type="checkbox" class="custom-control-input" id="transport">
                    <label class="custom-control-label" for="transport">Can You Provide <span
                            class="text-warning">Transport</span> ? </label>
                </div>
            </div>


            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <input type="checkbox" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree"> Agree to <a href="#" class="text-primary">terms and
                            conditions</a> </label>
                </div>
            </div>
        </div>

    </div>
    <input type="hidden" id="reg_type" name="reg_type" value="suplier">
    <div class="modal-footer">
        <button type="submit" class="btn btn-info" value="Submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    </div>
    </form>
</div>
</div>
</div>
</div>
@endsection
