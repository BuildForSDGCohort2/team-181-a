@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add User') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Phone Number') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="input-name" type="text" placeholder="{{ __('Phone number') }}" value="{{ old('phone_number') }}" required="true" aria-required="true"/>
                      @if ($errors->has('phone_number'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('phone_number') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __(' Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm Password') }}" value="" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="role">{{ __('Role') }}</label>
                  <div class="col-6">
                    <div class="form-group">
                      <input type="radio" id="admin" name="role" value="admin">
                        <label for="male">Admin</label> &nbsp;
                        <input type="radio" id="farmer" name="role" value="farmer">
                        <label for="female">Farmer</label>&nbsp;
                        <input type="radio" id="feo" name="role" value="feo">
                        <label for="other">FEO</label>&nbsp;
                        <input type="radio" id="vet" name="vet" value="tower">
                        <label for="other">Vetrinary Officer</label>&nbsp;
                        <input type="radio" id="supplier" name="role" value="supplier">
                        <label for="other">Supplier</label>&nbsp;
                        <input type="radio" id="customer" name="role" value="customer">
                        <label for="other">Customer</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="location">{{ __('Location') }}</label>
                  <div class="col-6">
                      <div class="form-group">
                        <select name="location" id="location" style="opacity: 0.5" required>
                        <option value=""> Select location</option>
                        <option value="Admin"> Admin</option>
                       @foreach ($locations as $location)
                       <option value="{{ $location}}">{{$location}}</option>
                       @endforeach
                    </select>
                  </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto text-center" >
                      <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
                    </div>
                  </div>
              </div>


            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
