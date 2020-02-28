<header class="header">
    <nav class="navbar"> 
      <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
          <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
              <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Dashboard</strong></div></a></div>
          <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
            <!-- Notifications dropdown-->
            @if (Auth::user()->role == 'admin')
            <li class="nav-item dropdown"> <a id="admin_notify" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
              <i class="fa fa-bell"></i>
              @if (Session::has('admin_notify'))
                @if (Session::get('admin_notify') != 0)
                <span class="badge badge-warning" id="notifications">{{Session::get('admin_notify')}}</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu" id="notificationsMenu">
                  <li><a rel="nofollow" href="" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view notification</strong></a></li>
                </ul>
                @endif
              </li>
              @endif
              
            @else 

            <li class="nav-item dropdown"> <a id="user_notify" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
              <i class="fa fa-bell"></i>
              @if (Session::has('usernotify'))
                @if (Session::get('usernotify') != 0)
                <span class="badge badge-warning" id="notifications">{{Session::get('usernotify')}}</span></a>
                <ul aria-labelledby="notifications" class="dropdown-menu" id="notificationsMenu">
                  <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications</strong></a></li>
                </ul>
                @endif
              @endif
              
              
            </li>

            @endif
           
           
            <!-- Languages dropdown    -->
            
            <!-- Log out-->
            <li class="nav-item"><a href="{{route('logout')}}" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  