@extends('layouts.main')

@section('title')
    sign up
@endsection

@section('content')
<div class="page login-page">
    <div class="container">
      <div class="form-outer text-center d-flex align-items-center">
        <div class="form-inner">
          <div class="logo text-uppercase"><span>my</span><strong class="text-primary">wallet</strong></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
          <form class="text-left form-validate" method="POST" action="{{route('signup')}}">
            @csrf
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
          </div>
            <div class="form-group-material {{ $errors->has('first_name') ? ' is-invalid ' : '' }}">
              <input id="register-username" type="text" name="first_name" required data-msg="Please enter your First name" value="{{ old('first_name') }}" class="input-material">
              <label for="register-username" class="label-material">First name</label>
                @if ($errors->has('first_name'))
                    <span class="is-invalid">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif
            </div>
            

            <div class="form-group-material {{ $errors->has('last_name') ? ' is-invalid ' : ''}}">
                <input  type="text" name="last_name" required data-msg="Please enter your Last name" class="input-material" value="{{ old('last_name') }}">
                <label for="register-username" class="label-material">Last name</label>
                  @if ($errors->has('last_name'))
                      <span class="is-invalid">
                        <strong>{{ $errors->first('last_name')}}</strong>
                      </span>
                  @endif
            </div>


            <div class="form-group-material {{ $errors->has('email') ? ' is-invalid ' : ''}}">
              <input  type="email" name="email" required data-msg="Please enter a valid email address" class="input-material" value=" {{ old('email')}} ">
              <label for="register-email" class="label-material">Email Address </label>
                @if ($errors->has('email'))
                  <span class="is-invalid">
                    <strong>{{ $errors->first('email')}}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group-material {{ $errors->has('mobile_number' ? ' is-invalid ': '')}}">
                <input  type="number" name="mobile_number" required data-msg="Please enter a valid mobile number" class="input-material" value="{{old('mobile_number')}}">
                <label for="register-email" class="label-material">Mobile number </label>
                  @if ($errors->has('mobile_number'))
                      <span class="is-invalid ">
                        <strong>{{ $errors->first('mobile_number')}}</strong>
                      </span>
                  @endif
            </div>
            
            <div class="form-group-material {{ $errors->has('password' ? ' is-invalid ': '')}}">
              <input id="register-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
              
              <label for="register-password" class="label-material">Password </label>
                @if ($errors->has('password'))
                    <span class="is-invalid">
                        <strong>{{ $errors->first('password')}}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group-material {{ $errors->has('password_confirmation' ? ' is-invalid ': '')}}">
              <input id="confirmregister_password" type="password" name="password_confirmation" required data-msg="Please password does not match" class="input-material">
              <label for="register-password" class="label-material">Confirm Password </label>
                @if ($errors->has('password_confirmation'))
                    <span class="is-invalid">
                        <strong>{{ $errors->first('password_confirmation')}}</strong>
                    </span>
                @endif
            </div>

            {{-- <div class="form-group terms-conditions text-center">
              <input  name="agree" type="checkbox" required value="1" data-msg="Your agreement is required" class="form-control-custom" >
              <label for="register-agree">I agree with the terms and policy</label>
            </div> --}}
            <div class="form-group text-center">
              <input id="register" type="submit" value="Register" class="btn btn-primary">
            </div>
          </form><small>Already have an account? </small><a href="{{route('login')}}" class="signup">Login</a>
        </div>
        <div class="copyrights text-center">
          <p>Design by <a href="#" class="external">Loyalty Solutions Limited</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection