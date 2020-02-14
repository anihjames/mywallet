@extends('layouts.main')

@section('title')
    setting
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
              {{-- <li class="breadcrumb-item ">{{ request()->segment(2)}}</li> --}}
            </ul>
          </div>
        </div>

          <section>
              <div class="container-fluid">
                <header class="container">
                    
                </header>

                <div class="row d-flex">
                  <div class="container">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header">
                              <h4>User Profile</h4>
                          </div>

                          <div class="card-body ">
                            <div class="form-group">
                              <fieldset class="the-fieldset">
                                  <legend class="the-legend">User Details</legend>
                                  <div class="input-group">
                                    <div class="col-sm-6">
                                      <label for="first_name">First name</label>
                                      <input type="text" value="{{$user->fname}}" class="form-control" name="first_name" required>
                                    </div>

                                    <div class="col-sm-6">
                                      <label for="last_name">Last name</label>
                                      <input type="text" value="{{$user->lname}}" class="form-control" name="last_name" required>
                                    </div>

                                  </div>
                              </fieldset>

                              <fieldset class="the-fieldset">
                                <legend class="the-legend">Contact Details</legend>
                                <div class="input-group">
                                  <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{$user->email}}" class="form-control" name="email" required>
                                  </div>

                                  <div class="col-sm-6">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" value="0{{$user->phone}}" class="form-control" name="mobile_number" required>
                                  </div>

                                </div>
                              </fieldset>

                              <fieldset class="the-fieldset">
                                  <legend class="the-legend">Location Details</legend>
                                  <div>
                                    
                                  </div>
                              </fieldset>
                          </div>

                          </div>

                        </div>

                      </div>

                  </div>

                </div>

               
              </div>
          </section>
    </div>
@endsection
@push('styles')
  .the-legend {
    border-style: none;
    border-width: 0;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 0;
    width: auto;
    padding: 0 10px;
    border: 1px solid #e0e0e0;
  }
  .the-fieldset {
    border: 1px solid #e0e0e0;
    padding: 10px;
    margin-bottom:20px;
  }
@endpush