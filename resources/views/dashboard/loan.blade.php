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
                <li class="breadcrumb-item active">Loans</li>
              </ul>
            </div>
          </div>

          <section>
             <div class="container-fluid">
                <header class="container"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#takeloan">Apply for a Loan</button>
                  </header>

                  <div class="row d-flex">
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Recents Loans</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="loan-datatable">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>#</th> --}}
                                                        <th>Loan Amount</th>
                                                        <th>Loan tenure</th>
                                                        <th>Date Applied</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        <th>Date</th>
                                                        
                                                    </tr>
                                                </thead>
                                                

                                            </table>

                                        </div>

                                        @include('partials.takeloan_modal')

                                    </div>

                                </div>
                              </div>

                        </div>
                  </div>
            </div> 

          </section>

    </div>
@endsection