@extends('layouts.main')

@section('title')
    Pay Bills
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
                        <li><a rel="nofollow" href="/admin/notify/{{$item->notify_id}}" class="dropdown-item"> 
                          <div class="notification d-flex justify-content-between">
                            <div class="notification-content"><i class="fa fa-envelope"></i>{{$item->message}} </div>
                            <div class="notification-time"><small>{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </small></div>
                          </div></a></li>
                        
                        {{-- <li><a rel="nofollow" href="" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i> </strong></a></li> --}}
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
                <li class="breadcrumb-item active">Pay Bills</li>
              </ul>
            </div>
          </div>
        <section>
            <div class="container-fluid">
                <header> 
                    <h1 class="h3 display">Pay Bills</h1>
                  </header>
                    <div class="row d-flex">
                        <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#billsModal" style="text-decoration:none;">
                                            <div>
                                                <h4 class="card-title">Cable Sub</h4>
                                                <p class="card-text">Dstv, Gotv, Startime</p>
                                            </div>
                                        </a>
                                        @include('partials.paybills_modal')
                                    </div>
                            </div>
                        </div>
  
                       

                        <div class="col-lg-3">
                            <div class="card">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#eedcModal" style="text-decoration:none;">
                                            <div>
                                                <h4 class="card-title">EEDC</h4>
                                                <p class="card-text">Prepaid Recharge </p>
                                            </div>
                                        </a>

                                        @include('partials.eedcpay_modal')
                                    </div>
                                
                            </div>
                        </div>


         


                    </div>

                    <div class="row d-flex">
                        <div class="container">
                            <header> 
                                <h1 class="h3 display">Recents Bills</h1>
                              </header>

                              <div class="col-lg-12">
                                <div class="card">
                                    <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                        <h4>All Transactions</h4>
                                
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table"  id="billpay">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>Payment Id</th> --}}
                                                        <th>Transaction ID</th>
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
        </section>
        
        
        
    </div>
    
@endsection



@push('scripts')
<script src="{{asset('js/paybill.js')}}"></script>
@endpush