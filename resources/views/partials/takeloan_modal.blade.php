<div id="takeloan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('applyforloan')}}" method="POST" id="loanpay">
            
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Take Loan</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger loan-error-msg" style="display:none;">
                <ul></ul>
              </div>
              <p class="alert alert-success" id="loanMsg" style="display:none;">
            <div class="form-group ">
                <label for="" id="label">Loan amount</label>
                <input type="number" name="loan_amount" class="form-control col-sm-9" placeholder="270 000" >
            </div>

            {{-- <div class="form-group">
                <label for="">Loan tenure</label>
                <input type="type" name="loan_tenure" class="form-control" placeholder="7 months">
            </div> --}}
            <div class="form-group">
                <label for="Mobile_number">Loan</label>
                <div class="input-group">
                    <input type="number"class="form-control col-sm-6"  name="loan_tenure" placeholder="7">
                    <input type="text"  class="col-sm-3 form-control" placeholder="months" name="months">
                    
                </div>
                
              </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary close">Close</button>
          <button type="submit" class="btn btn-primary">Apply for loan</button>
        </div>
      </form>
      </div>
    </div>
  </div>
@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/takeloan.js')}}"></script>
@endpush