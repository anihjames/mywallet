@extends('layouts.main')

@section('title')
    setting --change password
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Settings >> {{ request()->segment(2)}}</li>
                
              </ul>
            </div>


          </div>

          <section>
              <div class="container-fluid">
                  <header class="container">

                  </header>

                  <div class="row d-flex">
                      <div class="container">
                          <div class="col-lg-6">
                              <div class="card">
                                  <div class="card-header">
                                        <h4>Change Password</h4>
                                  </div>

                                  <form action="{{route('passwordchange')}}" method="post">
                                      <div class="card-body">
                                            @if (session('status'))
                                            <div class="alert alert-success col-sm-6">
                                            {{ session('status') }}
                                            </div>
                                            @endif

                                            @if ($errors->any())
                                                <div class="alert alert-danger ">
                                                    <ul style="list-style: none;">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                
                                                <div class="col-sm-6">
                                                    <label for="old_password">Old Password</label>
                                                    <input type="password" class="form-control" name="old_password" required>
                                                </div>
                                                    @csrf
                                                <div class="col-sm-6">
                                                    <label for="new_password">Enter Password</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <input type="password" class="form-control" name="password_confirmation" required>

                                                </div>

                                            </div>

                                      </div>

                                      <div class="card-body">
                                          <div class="form-group">
                                            <input type="submit" value="Change Password" class="btn btn-primary">
                                          </div>

                                      </div>
                                  </form>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>
          </section>

    </div>
@endsection