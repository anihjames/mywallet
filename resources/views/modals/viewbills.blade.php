<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Bill Details</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    
    <div class="modal-body">

        <fieldset class="the-fieldset">
            <legend class="the-legend">Bill Details</legend>
            <div class="input-group ">
                <div class="form-group col-md-3">
                    <label for="topup-id">Bill ID</label>
                    <input type="text" value="{{$bills->payment_pid}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-5">
                    <label for="topup-id">Bill Type</label>
                    <input type="text" value="{{$bills->bills_type}}" class="form-control " readonly>
                </div>
    
                
                <div class="form-group col-md-4">
                    <label for="dataplan">Bill Amount</label>
                    <input type="text" value="{{$bills->bills_amount}}" class="form-control" readonly>
                </div>
                
            </div>
        </fieldset>
        

        <fieldset class="the-fieldset">
            <legend class="the-legend">Customer Details</legend>
            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="fullname">First Name</label>
                    <input type="text" value="{{$bills->fname}}" class="form-control" readonly>
                </div>
                <div class="form col-md-6">
                    <label for="lastname">Last Name</label>
                    <input type="text" value="{{$bills->lname}}" class="form-control" readonly>

                </div>

                
            </div>

            <div class="form-group col-md-12">
                <label for="wallet_key">Wallet Key</label>
                <input type="text" value="{{$bills->wallet_key}}" class="form-control" readonly>
            </div>

            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="phone">Card/Meter Number</label>
                    <input type="text" value="0{{$bills->type_code}}" class="form-control" readonly>

                </div>

                <div class="form-group col-md-6">
                    <label for="balance">Balance after transaction</label>
                    <input type="text" value="{{$bills->balance}}" class="form-control" readonly>
    
                </div>

            </div>
            
           


        </fieldset>
        
        

    </div>

</div>
