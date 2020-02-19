<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">User Details</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    
    <div class="modal-body">

        <fieldset class="the-fieldset">
            <legend class="the-legend">account details</legend>
            <div class="input-group ">
                <div class="form-group col-md-6">
                    <label for="topup-id">First Name</label>
                    <input type="text" value="{{$users->fname}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="topup-id">Last Name</label>
                    <input type="text" value="{{$users->lname}}" class="form-control " readonly>
                </div>
    
                
                
                
            </div>
        </fieldset>
        

        <fieldset class="the-fieldset">
            <legend class="the-legend">Contact Details</legend>
            {{-- <div class="input-group">

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" value="{{$users->email}}" class="form-control" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" value="{{$users->phone}}" class="form-control" readonly>
                </div>

            </div> --}}

            <div class="input-group">
                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <input type="text" value="{{$users->state}}" class="form-control" readonly>

                </div>

                <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" value="{{$users->country}}" class="form-control" readonly>
                </div>
            </div>

        </fieldset>

        <fieldset class="the-fieldset">
            <legend class="the-legend">Wallet details</legend>
            <div class="input-group">
                <div class="form-group col-md-12">
                    <label for="wallet_key">Wallet Key</label>
                    <input type="text" value="{{$users->wallet_key}}" class="form-control" readonly>
                </div>

            </div>
            <div class="form-group col-md-6">
                <label for="wallet_balance">Wallet Balance</label>
                <input type="text" value="{{$users->wallet_balance}}" class="form-control" readonly>

            </div>

        </fieldset>
        
        

    </div>

</div>
