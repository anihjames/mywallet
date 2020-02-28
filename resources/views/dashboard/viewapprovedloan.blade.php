@extends('layouts.main')

@section('title')
    view notification
@endsection

@section('content')
    @if (Auth::user()->role == 'admin')
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
    @else
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
    @endif
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">view Notification</li>
          </ul>
        </div>
      </div>

      <section>
          <div class="container-fluid">

            <div class="row d-flex">
                <div class="container">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                notification details
                            </div>
                            
                            <div class="card-body">
                              <div class="input-group">
                                <div class="form-group col-md-6">
                                  <label for="">wallet key</label>
                                  <input type="text" value="{{$trans->wallet_key}}" class="form-control" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                  <label for="">Transaction ID</label>
                                  <input type="text" value="{{$trans->trans_pid}}" class="form-control" readonly>
                                </div>
                              </div>
                              
                              <div class="input-group">
                                <div class="form-group col-md-6">
                                  <label for="">Transaction Type</label>
                                  <input type="text" value="{{$trans->trans_type}}" class="form-control" readonly>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="">Transaction Name</label>
                                  <input type="text" value="{{$trans->trans_name}}" class="form-control" readonly>
                              </div>
                              </div>
                                
                              <div class="input-group">
                                <div class="form-group col-md-6">
                                  <label for="">Transaction Amount</label>
                                  <input type="text" value="{{$trans->trans_amount}}" class="form-control" readonly>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="">Status</label>
                                @if ($trans->trans_status == 2)
                                <input type="text" value="successfull" class="form-control" readonly>
                                @elseif($trans->trans_status == 1)
                                <input type="text" value="pending" class="form-control" readonly>
                                @elseif($trans->trans_status == 0)
                                <input type="text" value="failed" class="form-control" readonly>
                                @endif

                              </div>
                              </div>
                               

                            </div>

                        </div>

                    </div>

                </div>

            </div>

          </div>
      </section>

    
@endsection