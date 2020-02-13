@extends('layouts.main')

@section('title')
    setting
@show

@section('content')
    @inlude('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Loans</li>
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

                        </div>

                    </div>

                </div>
              </div>
          </section>
    </div>
@endsection