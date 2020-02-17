@extends('layouts.main')

@section('title')
    Login
@endsection

@section('content')
<div class="page login-page">
    <div class="container">
      <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">

            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul style="list-style: none;">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif

            

            @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
            @endif
            @if (session('warning'))
              <div class="alert alert-info">
                {{ session('warning') }}, <a href="{{route('resend')}}">Click to resend to email</a>  

              </div>
          @endif
          @if (session('danger'))
              <div class="alert alert-danger">
                {{ session('danger') }}  

              </div>
          @endif
          <div class="logo text-uppercase"><span>my</span><strong class="text-primary">Wallet</strong></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
          <form class="text-left form-validate" action="{{route('sigin')}}" method="POST">
            <div class="form-group-material {{ $errors->has('email') ? ' is-invalid ' : '' }}">
              <input id="login-username" type="text" name="email" required data-msg="Please enter your email" class="input-material" value="{{old('email')}}">
              <label for="login-username" class="label-material">Email</label>
                @if ($errors->has('email'))
                      <span class="is-invalid">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                @endif
            </div>
            @csrf
            <div class="form-group-material {{ $errors->has('password')? 'is-invalid': ''}}">
              <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
              <label for="login-password" class="label-material">Password</label>
                @if ($errors->has('password'))
                    <span class="is-invalid">
                        <strong>{{ $errors->first('password')}}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Login" class="btn btn-primary">
                {{-- <a id="login" href="index.html" class="btn btn-primary">Login</a> --}}
            </div>
          </form><a href="{{route('reset')}}" class="forgot-pass">Forgot Password?</a><small>Do not have an account? </small><a href="{{route('register')}}" class="signup">Signup</a>
        </div>
        <div class="copyrights text-center">
          <p>Design by <a href="#" class="external">Loyalty Solutions Limited</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection