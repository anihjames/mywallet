@extends('layouts.main')

@section('title')
    Pay Loan
@endsection

@section('content')
    @include('partials.nav')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pay Loan</li>
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
                            <div class="">

                            </div>

                        </div>

                    </div>

                </div>
            </div>
          </div>
      </section>
@endsection