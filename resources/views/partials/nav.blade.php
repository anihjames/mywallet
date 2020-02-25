<nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <!-- User Info-->
        <div class="sidenav-header-inner text-center">
          {{-- <img src="" alt="person" class="img-fluid rounded-circle"> --}}
          <h2 class="h5">
            Hi {{Auth::user()->fname}}
          </h2>
            
          @if (Auth::user()->role != 'admin')
          <div class="row">
              <div class="container">
                @if (Session::has('balance'))
                <h6> <small>Balance: &#8358;{{ Session::get('balance') }}.00</small></h6>
                @endif
              </div>
          </div>
          <div class="row">
            <div class="container">
             
              <a href="{{route('wallet_topup')}}" class="btn btn-primary"> Wallet top-up</a>
              
             
              {{-- @if (Session::has('owing'))
                
                @if (Session::get('owing') == 0)
               
                @else
                <a href="{{route('get_payloan')}}" class="btn btn-primary"> Pay Loan</a>
                @endif
                  
              @endif --}}
            
            </div>
          </div>
          @endif
           
           
            
          
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
          {{-- <li class="{{ request()->segment(2) == 'takeloan' ? 'active' : ''}}"><a href="{{route('takeloan')}}"> <i class="fa fa-money"></i>Take Loans</a></li> --}}

          <li class="{{ request()->segment(2) == 'takeloan' ? 'active': ''}}"><a href="#loandropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-money" aria-hidden="true"></i>Loans</a>
            <ul id="loandropdown" class="collapse list-unstyled">
              <li><a href="{{route('takeloan')}}">Take Loan</a></li>
              <li><a href="">Pay Loans</a></li>
              <li><a href="">Statement</a></li>
            </ul>

          </li>
          @if (Auth::user()->role == 'user')
          {{-- <li class="{{ request()->segment(2) == 'transactions' ? 'active': ''}}"><a href="{{route('transaction')}}"> <i class="icon-grid"></i>Transactions</a></li> --}}
          @endif
          
         
          <li class="{{ request()->segment(1) == 'setting' ? 'active': ''}}"><a href="#settingdropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
            <ul id="settingdropdown" class="collapse list-unstyled ">
              <li class=""><a href="{{route('profile')}}">Edit Profile</a></li>
              <li><a href="{{route('changepassword')}}">Change password</a></li>
              <li><a href="{{route('deleteAccount')}}">Delete Account</a></li>
              <li> <a href="{{route('wallet_topup')}}">Wallet Topup</a></li>
            </ul>
          </li>
        </ul>
      </div>
      
    </div>
  </nav>