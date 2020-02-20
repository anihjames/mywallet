@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
          <div class="container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Home</li>
            </ul>
          </div>
        </div>
    {{-- <section class="dashboard-counts section-padding">
        <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                  <div class="icon"><i class="icon-user"></i></div>
                  <div class="name"><strong class="text-uppercase">New Clients</strong><span>Last 7 days</span>
                    <div class="count-number">25</div>
                  </div>
                </div>
              </div>
            
        </div>
            
        </div>

    </section> --}}

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

          {{-- <div class="col-lg-4">
            <!-- acquired-->
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              <div class="number" >{{$aquired_loan}}</div><strong class="text-primary">Acquired Loans</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div> --}}

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
              
              {{-- <div class="progress">
                <div role="progressbar" style="width:{{$transactions}}%"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
              </div> --}}
              
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
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="tran-datatable">
                    <thead>
                      <tr>
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

                $('#tran-datatable').DataTable( {
                  processing: true,
                  serverside:true,
                  ajax: "/datatable/trans",
                  columns: [
                      // {data: 'id', name:'Id', 'visiable': false},
                      {data: 'trans_type', name:'Transaction Type'},
                      {data: 'trans_name', name:'Name'},
                      {data: 'trans_amount', name:'Amount'},
                      {data: 'balance', name: 'Balance'},
                      {data:'created_at', name:'Date/Time'},
                      {data:'action', name:'Action',orderable: false, searchable: false}
                  ],
                  order: [[1 , 'desc']],
                  
              })
</script>
    
@endpush
