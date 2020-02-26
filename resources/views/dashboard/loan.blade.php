@extends('layouts.main')

@section('title')
    Take Loan
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Apply for Loan</li>
              </ul>
            </div>
          </div>

          <section>
             <div class="container-fluid">
                {{-- <header class="container"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#takeloan">Apply for a Loan</button>
                  </header> --}}

                  <div class="row d-flex">
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Application Process</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-success col-md-6" style="display:none;" id="succMsg">

                                        </div>
                                        
                                       
                                        
                                        {{-- <form action="" method=""> --}}
                                         <nav>
                                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="laon-step-1"  href="#step-1" role="tab" aria-controls="nav-home" aria-selected="true">Step 1</a>
                                                <a class="disabled nav-item nav-link" id="loan-step-2"  href="#step-2" role="tab" aria-controls="nav-profile" aria-selected="false">Step 2</a>   
                                                <a class="disabled nav-item nav-link" id="loan-step-3"   href="#step-3" role="tab"  aria-controls="nav-contact" aria-selected="false">Step 3</a>
                                                
                                            </div>
                                           
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="step-1">
                                                    
                                                   <p class="alert alert-danger col-md-4" style="display:none;">
                                                   </p>
                                                    <div class="form-group">
                                                        <label for="loan_amount"> Loan amount  
                                                            
                                                            @if($level == 'beginner')
                                                            <span style="font-size:10px;">max of 30,000</span>
                                                            @elseif($level == 'intermediate')
                                                            <span style="font-size:10px;">max of 100,000</span>
                                                            @elseif($level == 'advance')
                                                            <span style="font-size:10px;">max of 300,000</span>
                                                            @endif
                                                          
                                                        </label>
                                                        <input type="number" name="loan_amount" class="form-control col-sm-4" placeholder="270 000" id="loan_amount" required>
                                                        <input type="hidden" value="{{$rate->interest_rate}}" name="rate" id="rate">
                                                        <input type="hidden" value="{{$rate->tenure}}" name="tenure" id="loantenure">
                                                        <input type="hidden" value="{{$rate->loan_amount}}" name="levelamount" id="levelamount">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="loan_tenure">Loan tenure <span style="font-size:10px;">max of {{$rate->tenure}} months</span></label>
                                                        <input type="number" name="loan_tenure" class="form-control col-sm-4" placeholder="7 months" id="loan_tenure"  required>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-md btn-primary" id="next1">Next</button>

                                                    </div>
                                                    
                                                </div>

                                                <div class="tab-pane fade" id="step-2">
                                                    <p class="alert alert-danger col-md-4" style="display:none;"></p>
                                                        <div class="form-group">
                                                            <label for="state">National ID number</label>
                                                            <input type="text" name="national_id" id="national_id" class="form-control col-md-4" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="country">Monthly income</label>
                                                            <input type="text"  name="monthly_income" id="income" class="form-control col-md-4" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="employment_details">Employment Status</label>
                                                            <select name="employment_status" id="employment_status" class="form-control col-md-4">
                                                                <option value="employed">Employed</option>
                                                                <option value="unemployed">Unemployed</option>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Mobile number</label>
                                                            <input type="text" value="+234{{$user->phone}}" id="phone" name="phone" class="form-control col-md-4">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <textarea name="address" id="address" cols="5" class="form-control col-md-4">{{$user->address}}</textarea>
                                                           
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-md btn-primary" id="prev1">Previous</button>
                                                            <button class="btn btn-md btn-primary" id="next2">Next</button>

                                                        </div>
                                                    </div>
                                                    
                                               

                                                <div class="tab-pane fade" id="step-3">
                                                    
                                                    <div class="form-group">
                                                        <label for="loan_amount">Loan Amount:</label>
                                                        <span id="amount"> </span>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="loan_tenure">Loan Tenure:</label>
                                                        <span id="tenure"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="rate">Interest Rate:</label>
                                                        <span id="rate">{{$rate->interest_rate}}%</span>
                                                    </div>

                                                   <div class="form-group">
                                                       <label for="rate">Payment Amount:</label>
                                                       <span id="payment_amount"></span>
                                                   </div>

                                                   <div class="form-group">
                                                       <button class="btn btn-sm btn-primary" id="prev2">Previous</button>
                                                       <button class="btn btn-sm btn-primary" id="apply">Apply</button>

                                                   </div>

                                                   

                                                </div>
                                            </div>
                                        </nav> 
                                    {{-- </form> --}}

                                        

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
<script src="{{asset('js/loan.js')}}"></script>
@endpush
