@extends('layouts.main')

@section('title')
    Take Loan
@endsection

@section('content')
    @include('partials.nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Apply for Loan</li>
              </ul>
            </div>
          </div>

          <section>
             <div class="container-fluid">
                {{-- <header class="container"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#takeloan">Apply for a Loan</button>
                  </header> --}}

                  <div class="row d-flex">
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Recents Loans</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="loan-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Loan ID</th>
                                                        <th>Loan Amount</th>
                                                        <th>Loan tenure</th>
                                                        <th>Date Applied</th>
                                                    
                                                        {{-- <th>#</th> --}}
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                       
                                                        
                                                    </tr>
                                                </thead>
                                                

                                            </table>

                                        </div>

                                        @include('partials.takeloan_modal')

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
    <script>
       $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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

            $("#loan-datatable").on("click", "a.viewloan", function () {
                
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
    


            $('#loan-datatable').on('click', 'a.deleteloan', function() {

                var id = $(this).data('edit-id');
               
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'/datatable/deleteloan',
                            type: 'POST',
                            data: {data:id},
                            success(res) {
                                if(res.message == 'success') {
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                              )
                              $('#loans-datatable').DataTable().ajax.reload();
                                }
                                
                            },
                            error(err) {
                                
                            }
                        })
                        
                    }
                    })
            })

            
           

       })
    </script>
@endpush