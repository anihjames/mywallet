@extends('layouts.main')

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
                <header class="container">


                </header>
                <div class="row d-flex">
                    <div class="container">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                      Pay Loan
                                </div>

                                <form action="{{route('topup')}}" method="post">
                                      <div class="card-body">
                                          <div class="form-group">
                                              {{-- <div class="col-sm-6">
                                                  <label for="loan_pid">Enter Loan ID</label>
                                                  <input type="text" name="orderID" class="form-control">
                                              </div> --}}
                                              {{-- <div class="form-group col-md-6">
                                                  <label>Loan ID</label>
                                                  <select name="orderID" id="cable" class="form-control">
                                                    <option value="" selected>Select...</option>
                                                    @foreach ($loans as $loan)
                                                      <option value="{{$loan->loan_pid}}">{{$loan->loan_pid}}</option>
                                                    @endforeach
                                                  </select>
                                                 
                                                </div> --}}
                                                <input type="hidden" value="top-up" name="tran_type">
                                                <input type="hidden" name="tran_type" value="wallet topup">
                                                <div class="form-group col-md-6">
                                                    <label for="top-up_amount">Enter Amount</label>

                                                </div>
                                              <div class="form-group">
                                                  <div class="col-sm-6">
                                                      <label for="amount">Amount</label>
                                                      <input type="number" name="amount" class="form-control">

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

            </div>
        </section>

    </div>
@endsection