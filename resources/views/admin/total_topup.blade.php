@extends('layouts.main')

@section('title')
    Admin -- Mobile Top-up
@endsection

@section('content')
    @include('partials.admin_nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Top-up</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                  <header>
                      Top-up Transactions
                  </header>

                  <div class="row d-flex">
                      <div class="container">

                        <div class="col-lg-12">
                            <div class="card">
                                <div id="feeds-box" class="card-header">
                                    <h2 class="h5 display">Mobile Top-up</h2>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="topups">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Transaction ID</th> --}}
                                                    <th>Fullname</th>
                                                    <th>Top-up Type</th>
                                                    <th>Mobile Number</th>
                                                    <th>Network Provider</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
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
              <div class="modal fade" id="topup_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"  id="topup_modal_body" style="">
                 
                </div>
            </div>
          </section>

    </div>
    
@endsection

@push('scripts')
    <script src="{{asset('js/total_topup.js')}}"></script>
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