@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('partials.nav')
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
    {{-- <section class="dashboard-counts section-padding">
        <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                  <div class="icon"><i class="icon-user"></i></div>
                  <div class="name"><strong class="text-uppercase">New Clients</strong><span>Last 7 days</span>
                    <div class="count-number">25</div>
                  </div>
                </div>
              </div>
            
        </div>
            
        </div>

    </section> --}}

    <section class="statistics">
      <div class="container-fluid">
        <header class="container">

        </header>
        <div class="row d-flex">
          <div class="col-lg-4">
            <!-- Income-->
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              <div class="number">126,418</div><strong class="text-primary">Total Credits</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div>
          {{-- <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div>
                  <h4 class="card-title">Total Credit</h4>

                </div>

              </div>

            </div>


          </div> --}}

        </div>

      </div>

    </section>
        
    </div>
@endsection