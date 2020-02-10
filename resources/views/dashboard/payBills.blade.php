@extends('layouts.main')

@section('title')
    Pay Bills
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pay Bills</li>
              </ul>
            </div>
          </div>
        <section>
            <div class="container-fluid">
                <header> 
                    <h1 class="h3 display">Pay Bills</h1>
                  </header>
                    <div class="row d-flex">
                        <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#billsModal" style="text-decoration:none;">
                                            <div>
                                                <h4 class="card-title">Cable Sub</h4>
                                                <p class="card-text">Dstv, Gotv, Startime</p>
                                            </div>
                                        </a>
                                        @include('partials.paybills_modal')
                                    </div>
                            </div>
                        </div>

                       

                        <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#eedcModal" style="text-decoration:none;">
                                            <div>
                                                <h4 class="card-title">EEDC</h4>
                                                <p class="card-text">Prepaid Recharge </p>
                                            </div>
                                        </a>

                                        @include('partials.eedcpay_modal')
                                    </div>
                                
                            </div>
                        </div>


                        {{-- <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#TravelModal" style="text-decoration:none;">
                                            <div>
                                                <h4 class="card-title">Travel</h4>
                                                <p class="card-text">Travels and Tours </p>
                                            </div>
                                        </a>

                                        @include('partials.travel_modal')
                                    </div>
                               
                            </div>
                        </div> --}}


                    </div>

                    <div class="row d-flex">
                        <div class="container">
                            <header> 
                                <h1 class="h3 display">Recents Bills</h1>
                              </header>

                              <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                      <th scope="row">1</th>
                                                      <td>Mark</td>
                                                      <td>Otto</td>
                                                      <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">2</th>
                                                      <td>Jacob</td>
                                                      <td>Thornton</td>
                                                      <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">3</th>
                                                      <td>Larry</td>
                                                      <td>the Bird</td>
                                                      <td>@twitter</td>
                                                    </tr>
                                                  </tbody>

                                            </table>

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