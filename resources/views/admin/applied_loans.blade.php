@extends('layouts.main')

@section('title')
    Admin -- Loans
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
                       Loans 
                  </header>

                  <div class="row d-flex">
                      <div class="container">
                          <div class="col-lg-12">
                              <div class="card">
                                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="h5 display">Mobile Top-up</h2>
                                    <div class="right-column">
                                      <select name="sort" id="sort" class="form-control">
                                        <option value="" selected>All Loans</option>
                                        <option value="1">pending</option>
                                        <option value="2">approved</option>
                                        <option value="0">rejected</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="loans">
                                            <thead>
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>Loan amount</th>
                                                    <th>Loan tenure</th>
                                                    <th>Date/Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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

              <div class="modal fade" id="loan_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"  id="loan_modal_body">
                 
                </div>
            </div>
          </section>

    </div>
    
@endsection
@push('scripts')
<script src="{{asset('js/appliedloans.js')}}"></script>
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
