@extends('layouts.main')

@section('title')
    Transaction
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Transaction</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                <header class="container"> 
                    <h1 class="h3 display">Transactions Made</h1>
                  </header>

                <div class="row d-flex">
                    <div class="container">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4></h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="tran-datatable">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Id</th> --}}
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                    {{-- <th>Status</th> --}}
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

{{-- @push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush --}}

@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/tran.js')}}"></script>
@endpush


