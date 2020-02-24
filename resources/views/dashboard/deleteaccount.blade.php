@extends('layouts.main')

@section('title')
    setting --Delete Account
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
                          <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Enter the following details to delete account</h4>
                                </div>

                                <form action="{{route('destory')}}" method="post">
                                    <div class="card-body">
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
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                            @csrf

                                            {{-- <div class="col-sm-8">
                                                <label for="wallet_key">Wallet Key</label>
                                                <input type="text" class="form-control" name="wallet_key" required>
                                            </div> --}}

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="form-group">
                                            <input type="submit" value="Delete Account" class="btn btn-danger">

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