@extends('layouts.main')

@section('title')
    Admin -- home
@endsection

@section('content')
    @include('partials.admin_nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Home</li>
              </ul>
            </div>
          </div>

          <section class="statistics">
              <div class="container-fluid">
                  <header class="">

                  </header>

                  <div class="row">
                      {{-- total number of users --}}
                      <div class="col-lg-4">
                          <div class="card user-activity">
                            <h2 class="display h4">User Activity</h2>
                            <div class="number">210</div>
                            <h3 class="h4 display">Total Users</h3>
                            <div class="progress">
                              <div role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                            </div>
                            
                          </div>
                          

                      </div>

                  </div>

              </div>

          </section>
    </div>
    
@endsection