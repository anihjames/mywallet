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
                @if (count($trans) > == 5)
                    <div class="row">
                        <div class="container">
                            <a href="" style="text-decoration:none;">view more...</a>
                        </div>
                    </div>
                @endif
               

            </div>
         

           </div>

       </div>
    </div>

</div>

