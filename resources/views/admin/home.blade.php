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

                  <div class="row d-flex">
                      {{-- total number of users --}}
                      <div class="col-lg-4">
                          <div class="card user-activity">
                            <h2 class="display h4">User Activity</h2>
                            <div class="number">{{$users}}</div>
                            <h3 class="h4 display">Total Users</h3>
                            <div class="progress">
                              <div role="progressbar" style="width:{{$users}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                            </div>
                            
                          </div>
                          

                      </div>

                      <div class="col-lg-4">
                        <div class="card user-activity">
                          <h2 class="display h4">Transaction Activities</h2>
                         
                          <div class="input-group">
                            <div class="form-group col-md-6">
                              <div class="number">{{$loans}}</div>
                              <h3 class="h4 display">Loans</h3>
                            </div>
                            <div class="form-group">
                              <div class="number">{{$topup}}</div>
                              <h5 class="h5 display">Top-ups</h5>
                            </div>  
                          </div>
                          
                          <div class="progress">
                            <div role="progressbar" style="width:{{$total}} %"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                          </div>
                          
                        </div>
                        

                    </div>

                    

                  </div>


                  <div class="row d-flex">
                    <div class="container">
                      <header>

                      </header>

                      <div class="col-lg-12">
                        <div class="card">
                          <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="h5 display">Transactions</h4>

                              <div class="right-column">
                                <select name="sort" id="sort" class="form-control">
                                  <option value="" selected>All Transactions</option>
                                  <option value="credit">Credit</option>
                                  <option value="debit">Debit</option>
                                </select>
                              </div>
                        </div>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table" id="transaction">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Transaction Type</th>
                                  <th>Transaction Name</th>
                                  <th>Transaction Amount</th>
                                  <th>Balance</th>
                                  <th>Status</th>
                                  <th>Date/time</th>
                                </tr>
                                
                              </thead>
                              
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
<script src="{{asset('js/trans.js')}}"></script>
    
@endpush