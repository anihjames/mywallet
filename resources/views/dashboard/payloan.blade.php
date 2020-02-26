@extends('layouts.main')
@section('title')
    Pay Loan
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pay Laon</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                  <div class="row d-flex">
                      <div class="container">
                          <div class="col-lg-8">
                              <div class="card">
                                  <div class="card-header">
                                        Pay Loan
                                  </div>

                                  <form action="{{route('payloan')}}" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                {{-- <div class="col-sm-6">
                                                    <label for="loan_pid">Enter Loan ID</label>
                                                    <input type="text" name="orderID" class="form-control">
                                                </div> --}}
                                                <input type="hidden" value="pay loan" name="tran_type">
                                                <div class="input-group">
                                                  <div class="form-group col-md-6">
                                                    <label>Loan ID</label>
                                                    <select name="orderID" id="loanpid" class="form-control"required>
                                                      <option value="" selected>Select...</option>
                                                      @foreach ($loans as $loan)
                                                        <option value="{{$loan->loan_pid}}">{{$loan->loan_pid}}</option>
                                                      @endforeach
                                                    </select>
                                                   
                                                  </div>
                                                  
                                                <div class="form-group col-md-6">
                                                  <label for="amount">Amount</label>
                                                      <input type="text" name="amount" class="form-control" required>
                                                </div>
                                                </div>
                                                
                                                <div id="loandetails" style="display:none;">
                                                    <div class="input-group">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Loan amount</label><br>
                                                        
                                                        <input type="text" value="" id="loan_amount" class="form-control" readonly>
                                                      </div>
    
                                                      <div class="form-group col-md-6" >
                                                        <label for="">Repayment amount</label>
                                                      
                                                        <input type="text" value="" id="repayment_amount" class="form-control" readonly>
    
                                                      </div>
    
                                                    </div>
                                                    
                                                    <div class="input-group">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Tenure</label>
                                                        <input type="text" value="" id="loan_tenure" class="form-control" readonly >
      
                                                      </div>

                                                      <div class="form-group col-md-6">
                                                        <label for="">Expiration date</label>
                                                        <input type="text" value="" class="form-control" id="loan_expiration" readonly >
      
                                                      </div>
                                                    </div>
                                                   
                                                </div>
                                               

                                                @csrf

                                                <input type="hidden" name="email" value="{{Auth::user()->email}}">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
                                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> 

                                            </div>

                                        </div>

                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-primary" type="submit" value="Pay Now!">
                                                <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                                </button>

                                        </div>
                                    </form>

                              </div>

                          </div>

                      </div>

                  </div>

                  {{-- <div class="row d-flex">
                    <div class="container">
                      <header>
          
                      </header>
          
                      <div class="col-lg-12">
                        <div class="card">
                          <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="h5 display">Recent Payments</h4>
                        </div>
          
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table" id="tran-datatable">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Inital amount</th>
                                  <th>Amount Paid</th>
                                  <th>Amount Left</th>
                                  <th>wallet Balance</th>
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
                    
          
                  </div> --}}

              </div>
          </section>

    </div>
@endsection

@push('scripts')
<script src="{{asset('js/handlepayloans.js')}}"></script>

    <script>
    $('#tran-datatable').DataTable( {
                  processing: true,
                  serverside:true,
                  ajax: "/datatable/getrecentloanpayment",
                  columns: [
                      // {data: 'id', name:'Id', 'visiable': false},
                      {data: 'loan_pid', name:'Transaction Type'},
                      {data: 'loan_amount', name:'Name'},
                      {data: 'amount_paid', name:'Amount Pid'},
                      {data: 'amount_left', name: 'Balance'},
                      {data:'wallet_balance', name:'Wallet Balance'},
                      {data:'created_at', name:'Date/Time'},
                      {data:'action', name:'Action',orderable: false, searchable: false}
                  ],
                  order: [[1 , 'desc']],
                  
              })
        
    </script>
@endpush