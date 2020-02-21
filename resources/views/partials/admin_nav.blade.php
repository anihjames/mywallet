<nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center">
         
          <h2 class="h5">
            Hi {{Auth::user()->fname}}
          </h2>
            
          <div class="row">
              <div class="container">
                
              </div>
          </div>
          <div class="row">
            <div class="container">
              
            </div>
          </div>
           
           
            
          
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>M</strong><strong class="text-primary">W</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
        <h5 class="sidenav-heading">Main</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">                  
          <li class="{{ request()->segment(2) == 'home' ? 'active': ''}}"><a href="{{route('admin.index')}}"> <i class="icon-home"></i>Home</a></li>
          <li class="{{ request()->segment(2) == 'users' ? 'active': ''}}"><a href="{{route('total.users')}}"> <i class="icon-user"></i>Users</a></li>
          <li class=" {{ request()->segment(2) == 'bills' ? 'active': ''}}"> <a href="{{route('total.bills')}}"> <i class="icon-form"></i>Bills</a></li>
          <li class="{{ request()->segment(2) == 'topups' ? 'active': ''}}"> <a href="{{route('total.topups')}}"> <i class="fa fa-mobile" aria-hidden="true" style="font-size:20px;"></i>Top-up</a></li>
          <li class="{{ request()->segment(2) == 'loans' ? 'active' : ''}}"><a href="{{route('total.loans')}}"> <i class="fa fa-money"></i>Loans</a></li>
          
          {{-- <li > <a href="{{route('setting')}}"> <i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li> --}}
          <li class="{{ request()->segment(1) == 'setting' ? 'active': ''}}"><a href="#settingdropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
            <ul id="settingdropdown" class="collapse list-unstyled ">
              <li class=""><a href="{{route('profile')}}">Edit Profile</a></li>
              <li><a href="{{route('changepassword')}}">Change password</a></li>
              {{-- <li><a href="{{route('deleteAccount')}}">Delete Account</a></li> --}}
            </ul>
          </li>
        </ul>
      </div>
      
    </div>
  </nav>