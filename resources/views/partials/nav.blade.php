<nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center">
          {{-- <img src="" alt="person" class="img-fluid rounded-circle"> --}}
          <h2 class="h5">
            {{-- @if (Auth::check())
            {{Auth::user()->fname}}
            @endif --}}
            MyWallet
            
          </h2>
        </div>
        <!-- Small Brand information, appears on minimized sidebar-->
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>M</strong><strong class="text-primary">W</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
        <h5 class="sidenav-heading">Main</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">                  
          <li class="{{ request()->segment(1) == 'home' ? 'active': ''}}"><a href="{{route('home')}}"> <i class="icon-home"></i>Home</a></li>
          <li class=" {{ request()->segment(2) == 'paybills' ? 'active': ''}}"> <a href="{{route('paybills')}}"> <i class="icon-form"></i>Pay Bills</a></li>
          <li class="{{ request()->segment(2) == 'mobiletopup' ? 'active': ''}}"> <a href="{{route('getmobile_topup')}}"> <i class="fa fa-mobile" aria-hidden="true" style="font-size:20px;"></i>Mobile Top-up</a></li>
          <li><a href=""> <i class="fa fa-money"></i>Take Loans</a></li>
          <li><a href=""> <i class="icon-grid"></i>Transactions</a></li>
          <li> <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
        </ul>
      </div>
      
    </div>
  </nav>