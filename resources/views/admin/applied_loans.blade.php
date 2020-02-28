@extends('layouts.main')

@section('title')
    Admin -- Loans
@endsection

@section('content')
    @include('partials.admin_nav')
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
                  {{-- <i class="fa fa-bell"></i><span class="badge badge-warning" id="notifications">{{count($admin_notify)}}</span></a> --}}
                  @if (count($admin_notify) != 0)
                  <i class="fa fa-bell"></i><span class="badge badge-warning" id="notifications">{{count($admin_notify)}}</span></a>
                  
                  <ul aria-labelledby="notifications" class="dropdown-menu" id="notificationsMenu">
                    @foreach ($admin_notify as $item)
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
                <li class="breadcrumb-item active">Loans</li>
              </ul>
            </div>
          </div>

          <section>
              <div class="container-fluid">
                  {{-- <header>
                       Loans 
                  </header> --}}

                  <div class="row d-flex">
                      <div class="container">
                          <div class="col-lg-12">
                              <div class="card">
                                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="h5 display">Loans</h2>
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
                                                    <th>ID</th>
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
