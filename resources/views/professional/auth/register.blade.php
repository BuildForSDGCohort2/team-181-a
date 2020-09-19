@extends('layouts.auth', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material
Dashboard')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('professional.register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="first-column" style='width:45%; float: left;'>
                            <div class="form-group">
                                <label for="type">Full Names</label>
                                <input type="text" class="form-control" name='name' id="name" aria-describedby="name"
                                    placeholder="Enter Your Full names" required>
                                <small id="type" class="form-text text-muted">As they appear on the id.</small>

                                @if ($errors->has('name'))
                                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="strain">Id number</label>
                                <input type="text" name='id_number' class="form-control" id="id_number"
                                    aria-describedby="idnumber" placeholder="XXX-XXX" required>
                                <small id="idnnumber" class="form-text text-muted">Enter Id number</small>

                                @if ($errors->has('id_number'))
                                <div id="id_number-error" class="error text-danger pl-3" for="id_number"
                                    style="display: block;">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="strain">Phone number</label>
                                <input type="text" name='phone_number' class="form-control" id="phone_number"
                                    aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                                <small id="phonenumber" class="form-text text-muted">Enter phone number</small>
                                @if ($errors->has('phone_number'))
                                <div id="phone_number-error" class="error text-danger pl-3" for="phone_number"
                                    style="display: block;">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </div>
                                @endif
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
                                <label for="size">If Other Please Specify</label>
                                <input type="text" name='size' class="form-control" id="size" aria-describedby="size"
                                    placeholder="Enter The Specialty">
                                <small id="size" class="form-text text-muted">Please Specify </small>
                                @if ($errors->has('size'))
                                <div id="size-error" class="error text-danger pl-3" for="size" style="display: block;">
                                    <strong>{{ $errors->first('size') }}</strong>
                                </div>
                                @endif
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
                                @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger pl-3" for="email"
                                    style="display: block;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="exp">Years Of Expirience</label>
                                <input type="text" class="form-control" name='exp' id="exp"
                                    aria-describedby="expirience" placeholder="0">
                                <small id="expirience" class="form-text text-muted">Please indicate the Number of years
                                    of
                                    Experience .</small>
                                @if ($errors->has('exp'))
                                <div id="exp-error" class="error text-danger pl-3" for="exp" style="display: block;">
                                    <strong>{{ $errors->first('exp') }}</strong>
                                </div>
                                @endif
                            </div>

                            {{-- file uploader --}}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                <label class="custom-file-label" for="validatedCustomFile">Upload CV</label>
                                <div class="invalid-feedback">Invalid File</div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="agree" name="agree"
                                        required>
                                    <label class="custom-control-label" for="customCheck1"> Agree to <a href="#"
                                            class="text-primary">terms and conditions</a> </label>
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
</div>
</div>
@endsection
