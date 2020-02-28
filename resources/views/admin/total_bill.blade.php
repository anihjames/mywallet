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
                                        <div class="right-column">
                                            <select name="sort" id="sort" class="form-control">
                                              <option value="" selected>All Bills</option>
                                              <option value="2">completed</option>
                                              <option value="0">failed</option>
                                            </select>
                                          </div>
                                     
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="bills">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
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

              <div class="modal fade" id="bill_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"  id="bill_modal_body">
                 
                </div>
            </div>
          </section>

         

    </div>
    
@endsection
@push('scripts')
    <script src="{{asset('js/total_bill.js')}}"></script>
@endpush

@push('styles')
  .the-legend {
    border-style: none;
    border-width: 0;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 0;
    width: auto;
    padding: 0 10px;
    border: 1px solid #e0e0e0;
  }
  .the-fieldset {
    border: 1px solid #e0e0e0;
    padding: 10px;
    margin-bottom:20px;
  }
@endpush