<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Loan Details</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    
    <div class="modal-body">

        <fieldset class="the-fieldset">
            <legend class="the-legend">Loan Details</legend>
            <div class="input-group ">
                <div class="form-group col-md-3">
                    <label for="topup-id">Loan ID</label>
                    <input type="text" value="{{$loans->loan_pid}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-5">
                    <label for="topup-id">Loan Amount</label>
                    <input type="text" value="{{$loans->loan_amount}}" class="form-control " readonly>
                </div>
    
                
                <div class="form-group col-md-4">
                    <label for="dataplan">Loan Tenure</label>
                    <input type="text" value="{{$loans->loan_length}}" class="form-control" readonly>
                </div>
                
            </div>
        </fieldset>
        

        <fieldset class="the-fieldset">
            <legend class="the-legend">Customer Details</legend>
            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="fullname">First Name</label>
                    <input type="text" value="{{$loans->fname}}" class="form-control" readonly>
                </div>
                <div class="form col-md-6">
                    <label for="lastname">Last Name</label>
                    <input type="text" value="{{$loans->lname}}" class="form-control" readonly>

                </div>

                
            </div>

            <div class="form-group col-md-12">
                <label for="wallet_key">Wallet Key</label>
                <input type="text" value="{{$loans->wallet_key}}" class="form-control" readonly>
            </div>

            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="phone">Mobile number</label>
                    <input type="text" value="0{{$loans->phone}}" class="form-control" readonly>

                </div>

                <div class="form-group col-md-6">
                    <label for="balance">Balance</label>
                    <input type="text" value="{{$loans->balance}}" class="form-control" readonly>
    
                </div>

            </div>
            
           


        </fieldset>
        
        

    </div>

</div>
