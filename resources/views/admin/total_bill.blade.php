@extends('layouts.main')

@section('title')
    Admin -- Bills
@endsection

@section('content')
    @include('partials.admin_nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Bills</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                  <header>
                      <h1 class="h3 display">Bill Transactions</h1>
                  </header>
                  <div class="row d-flex">
                      <div class="container">

                        <div class="col-lg-12">
                            <div class="card">
                                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="h5 display">Bills Payment</h4>

                                     
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="bills">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Fullname</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Card/Meter Number</th>
                                                    <th>Date/Time</th>
                                                    <th>Status</th> 
                                                </tr>
                                            </thead>

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
@push('scripts')
    <script src="{{asset('js/total_bill.js')}}"></script>
    
@endpush