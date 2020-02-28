@extends('layouts.main')

@section('title')
    Loans Statement
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        <header class="header">
            <nav class="navbar"> 
              <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                  <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                      <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Dashboard</strong></div></a></div>
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Notifications dropdown-->
                    <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                      @if (count($user_notify) != 0)
                      <i class="fa fa-bell"></i><span class="badge badge-warning" id="notifications">{{count($user_notify)}}</span></a>
                      <ul aria-labelledby="notifications" class="dropdown-menu" id="notificationsMenu">
                       
                        @foreach ($user_notify as $item)
                        <li><a rel="nofollow" href="{{$item->id}}" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>{{$item->message}}</strong></a></li>
                        @endforeach
                      </ul>
    
                      @else 
                      <i class="fa fa-bell"></i><span class="badge badge-warning" id="notifications"></span></a>
    
                      @endif
                      
                    </li>
                   
                    
                    <!-- Log out-->
                    <li class="nav-item"><a href="{{route('logout')}}" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
                  </ul>
                </div>
              </div>
            </nav>
          </header> 

        <div class="breadcrumb-holder">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">view statement</li>
                </ul>

            </div>

        </div>

        <section>
            <div class="container-fluid">
                <header>
                    <h1 class="h3 display">Loans Statemnt</h1>
                </header>

                <div class="row d-flex">
                    <div class="container">

                        <div class="col-lg-12">
                            <div class="card">
                                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="h5 display">Loan Statement</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="loan-datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Amount</th>
                                                    <th>Tenure</th>
                                                    <th>Repayment Amount</th>
                                                    <th>Loan Status</th>
                                                    <th>Amount paid</th>
                                                    <th>Amount left</th>
                                                    <th>Expiration Date</th>
                                                    <th>Payment Status</th>
                                                    <th>Date</th>
                                                    {{-- <th>Action</th> --}}
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
<script src="{{asset('js/loanstatement.js')}}"></script>
    
@endpush