@extends('layouts.main')

@section('title')
    Mobile Top-up
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
