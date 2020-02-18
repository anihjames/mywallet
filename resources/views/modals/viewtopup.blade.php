<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Top Details</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    
    <div class="modal-body">

        <fieldset class="the-fieldset">
            <legend class="the-legend">Top-up Details</legend>
            <div class="input-group ">
                <div class="form-group col-md-3">
                    <label for="topup-id">Topup ID</label>
                    <input type="text" value="{{$topups->mobile_pid}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-5">
                    <label for="topup-id">Topup Type</label>
                    <input type="text" value="{{$topups->toptype}}" class="form-control " readonly>
                </div>
    
                @if ($topups->toptype == "Data Top up")
                <div class="form-group col-md-4">
                    <label for="dataplan">Data Plan</label>
                    <input type="text" value="{{$topups->dataplan}}" class="form-control" readonly>
                </div>
                @endif
            </div>
        </fieldset>
        

        <fieldset class="the-fieldset">
            <legend class="the-legend">Customer Details</legend>
            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="fullname">First Name</label>
                    <input type="text" value="{{$topups->fname}}" class="form-control" readonly>
                </div>
                <div class="form col-md-6">
                    <label for="lastname">Last Name</label>
                    <input type="text" value="{{$topups->lname}}" class="form-control" readonly>

                </div>

                
            </div>

            <div class="form-group col-md-12">
                <label for="wallet_key">Wallet Key</label>
                <input type="text" value="{{$topups->wallet_key}}" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="balance">Balance after transaction</label>
                <input type="text" value="{{$topups->balance}}" class="form-control" readonly>

            </div>
           


        </fieldset>
        
        

    </div>

</div>
