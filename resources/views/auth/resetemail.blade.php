@extends('layouts.main')

@section('title')
 password reset   
@endsection

@section('content')
<div class="page login-page">
    <div class="container">
      <div class="form-outer text-center d-flex align-items-center">
        <div class="form-inner">
          <div class="logo text-uppercase"><span>Reset</span><strong class="text-primary">Password</strong></div>
          <form method="post" action="{{route('resetlink')}}" class="text-left form-validate">
            <div class="form-group-material">
              <input id="login-username" type="text" name="email" required data-msg="Please enter your Email" class="input-material">
              <label for="login-username" class="label-material">Email</label>
            </div>
            @csrf
            <div class="form-group text-center">
                <input type="submit" value="Send" class="btn btn-primary" id="login">
                {{-- <a id="login" href="index.html" class="btn btn-primary">Login</a> --}}
              <!-- This should be submit button but I replaced it with <a> for demo purposes-->
            </div>
          </form><small>Go back Login </small><a href="{{route('login')}}" class="signup">Login</a>
        </div>
        <div class="copyrights text-center">
          <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Bootstrapious</a></p>
          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </div>
      </div>
    </div>
  </div>
@endsection