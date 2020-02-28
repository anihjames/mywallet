@extends('layouts.main')

@section('title')
    Dashboard
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
              <li class="breadcrumb-item active">Home</li>
            </ul>
          </div>
        </div>

        
  

    <section class="statistics">
      <div class="container-fluid">
        <header class="container">
         
        </header>
        <div class="row d-flex">
          <div class="col-lg-4">
            <!-- Income-->
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              <div class="number">NGN{{$total_credit}}</div><strong class="text-primary">total credits</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div>

          <div class="col-lg-4">
            <!-- Income-->
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              <div class="number" style="color:red;">-{{$total_debit}}</div><strong class="text-primary">total debits</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div>

         

          <div class="col-lg-4">
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              {{-- <h2 class="display h4">Loan Activities</h2> --}}
              <div class="input-group">
                <div class="form-group col-md-6">
                  <div class="number">{{$loans}}</div>
                  <h6 class="h6 display"> <strong class="text-primary">total loans</strong></h6>
                </div>
                <div class="form-group">
                  <div class="number">NGN{{$aquired_loan}}</div>
                  <h6 class="h6 display"><strong class="text-primary">total amount</strong></h6>
                </div>  
              </div>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
              
              
              
            </div>
            

        </div>
          
        </div>

        <div class="row d-flex">
          <div class="container">
            <header>

            </header>

            <div class="col-lg-12">
              <div class="card">
                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h5 display">Transactions</h4>
                    {{-- <div class="right-column">
                      <select name="sort" id="sort" class="form-control">
                        <option value="" selected>All Transactions</option>
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                      </select>
                    </div> --}}
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="tran-datatable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Balance</th>
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

      <div class="modal fade" id="payloan_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"  id="payloan_modal_body">
         
        </div>
    </div>

    </section>
        
    </div>
@endsection

@push('scripts')
<script>

  // $('#admin_notify').on('click', function(){

  // })


  $("#loan-datatable").on("click", "a.editloan", function () {
                
                $("#loan_modal_body").load("/user/editloan/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                    {
                         $("#loan_modal").modal({
                                        backdrop: 'static',
                                        keyboard: true
                                    }, "show");
                                   // bindForm(this);
                    });
                return false;
                });
 
                var table = $('#tran-datatable').DataTable( {
                  processing: true,
                  serverside:true,
                  ajax: {
                    url: "/datatable/trans",
                    data: function(d) {
                      d.sort = $('#sort').val();
                    } 
                  },
                  columns: [
                      {data: 'trans_pid', name:'Id', 'visiable': false},
                      {data: 'trans_type', name:'Transaction Type'},
                      {data: 'trans_name', name:'Name'},
                      {data: 'trans_amount', name:'Amount'},
                      {data: 'balance', name: 'Balance'},
                      {data:'created_at', name:'Date/Time'},
                      {data:'action', name:'Action',orderable: false, searchable: false}
                  ],
                  // searching: false,
                  ordering:false,
                  
              })

              $('#sort').on('change',function(){
                 table.ajax.reload();
              })
</script>
    
@endpush
