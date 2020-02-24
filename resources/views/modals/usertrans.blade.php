<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Recent transaction details</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>

    <div class="modal-body">
       <div class="row">
           <div class="col-sm-12">

            <div class="table-responsive" id="trans">
                <table class="table">
                    @if (count($trans) > 0)
                    <thead>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Date/Time</th>
                    </thead>
                   
                    <tbody>
                        @foreach ($trans as $tran)
                        <tr>
                             <td>{{$tran->trans_type}}</td>
                             <td>{{$tran->trans_name}}</td>
                             <td>{{$tran->trans_amount}}</td>
                             <td>{{$tran->balance}}</td>
                             @if ($trans->status = '0')
                             <td>Failed</td>
                             @elseif($trans->status = '1')
                             <td>Pending</td>
                             @elseif($trans->status = '2')
                             <td>Successful</td>
                             @endif
                             <td>{{$tran->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                    @else 
                    <thead>
                        No record found
                    </thead>
                    @endif

                </table>
                @if (count($trans) > 0)
                    <div class="row">
                        <div class="container">
                            <a href="" style="text-decoration:none;">view more...</a>
                        </div>
                    </div>
                @endif
               

            </div>
            {{-- <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-loan" role="tab" aria-controls="nav-home" aria-selected="true">Loans</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-topups" role="tab" aria-controls="nav-profile" aria-selected="false">Mobile top-up</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-bills" role="tab" aria-controls="nav-contact" aria-selected="false">Bills Payment</a>
                    
                </div>

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-loan">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-topups">
                        Topups
                    </div>

                    <div class="tab-pane fade" id="nav-bills">
                        Bills                        
                    </div>
                </div>
            </nav> --}}

           </div>

       </div>
    </div>

</div>

