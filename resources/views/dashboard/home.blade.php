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
    <section class="dashboard-counts section-padding">
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

    </section>
        
    </div>
@endsection