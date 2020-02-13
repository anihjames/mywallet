<div class="modal-content">
    <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Edit Loan</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <form action="{{route('updateloan')}}" method="post" id="editloan">
        <div class="modal-body">
            <div class="alert alert-danger loan-error-msg" style="display:none;">
                <ul class="errormsg"></ul>
              </div>
              <p class="alert alert-success" id="loanMsg" style="display:none;">
            <div class="form-group">
                <label for="loan_amount">Loan Amount</label>
                <input type="number"class="form-control col-sm-12"  name="loan_amount" value="{{$loan->loan_amount}}" placeholder="100000" required>        
            </div>
            @csrf

            <div class="form-group">
                <label for="loan_tenure">Loan tenure</label>
                <input type="text" name="loan_tenure" class="form-control col-sm-12" value="{{$loan->loan_length}}" placeholder="6months" required>
            </div>


        </div>

        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary close">Close</button>
            <button type="submit"  class="btn btn-primary" id="update">Update</button>
        </div>

    </form>

</div>

