@extends('layouts.main')

@section('title')
    Mobile Top-up
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Mobile Top-up</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                <header class="container"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#topup">Top-up</button>
                  </header>

                  {{-- //Top-up to --}}
                  <div class="row d-flex">
                        <div class="container">
                            
                              <div class="col-lg-12">
                                <div class="card">
                                    <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                        <h4>Recents Top-up</h4>

                                        {{-- <div class="right-column">
                                            <select name="sort" id="sort" class="form-control">
                                              <option value="" selected>Actions</option>
                                              <option value="2">successfull</option>
                                              <option value="0">failed</option>
                                             
                                            </select>
                                          </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="topup-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Topup ID</th>
                                                        <th>Top Type</th>
                                                        <th>Mobile Number</th>
                                                        <th>Network Provider</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        
                                                         
                                                    </tr>
                                                </thead>
                                                

                                            </table>

                                        </div>

                                        @include('partials.topup_modal')

                                    </div>

                                </div>
                              </div>
                        </div>
                  </div>
              </div>
          </section>
    </div>
@endsection

{{-- @push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush --}}
