
      <!-- Modal-->
      <div id="billsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">Cable Sub</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <form action="{{route('paybills')}}" method="POST" id="payform">
            <div class="modal-body">
              <div class="alert alert-danger print-error-msg" style="display:none;">
                <ul></ul>
              </div>
              <p class="alert alert-success" id="succMsg" style="display:none;">

              </p>
                <div class="form-group">
                  <label>WHAT'S YOUR OPERATOR</label>
                  <select name="operator" id="cable" class="form-control">
                    <option value="" selected>Select...</option>
                    @foreach ($bills as $bill)
                      <option value="{{$bill->id}}">{{$bill->bill_name}}</option>
                    @endforeach
                  </select>
                 
                </div>
                @csrf
                <div class="form-group ">
                  <label for="" id="label">WHAT YOUR SMART CARD NUMBER?</label>
                  <input type="number" name="card_number" class="form-control" placeholder="SMART CARD NUMBER" id="code">
                 
                </div>
                <div class="form-group " id="pack">       
                  <label>WHICH PACKAGE DO YOU WANT?</label>
                  <select name="package" id="package" class="form-control">
                    <option selected>Select a Package...</option>
                  </select>  
                             
                </div>

                <div class="form-group" id="starTime">
                  <label>HOW MUCH DO WANT TO TOP-UP?</label>
                  <input type="number" class="form-control" placeholder="Top-up amount" name="startime_topup">
                </div>
                
              
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-secondary close">Close</button>
              <button type="submit"  class="btn btn-primary" id="paybill">Pay</button>
            </div>
          </form>
          </div>
        </div>
      </div>

      {{-- @push('scripts')
          <script src="{{asset('js/paybill.js')}}"></script>
      @endpush --}}
    