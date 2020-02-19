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
              <div class="number">NGN{{$total_credit}}</div><strong class="text-primary">Total Credits</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div>

          <div class="col-lg-4">
            <!-- Income-->
            <div class="card income text-center">
              <div class="icon"><i class="icon-line-chart"></i></div>
              <div class="number">NGN{{$total_debit}}</div><strong class="text-primary">Total Debits</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do.</p>
            </div>
          </div>
          {{-- <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div>
                  <h4 class="card-title">Total Credit</h4>

                </div>

              </div>

            </div>


          </div> --}}

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
</script>
    
@endpush