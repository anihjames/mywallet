
        
        <!-- Modal-->
        <div id="eedcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
          <div role="document" class="modal-dialog">
            <div class="modal-content">
              <form action="{{route('eedcpay')}}" method="POST" id="eedcPay">
              <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">EEDC Pay</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none;">
                  <ul></ul>
                </div>
                <p class="alert alert-success" id="succMsg2" style="display:none;">
                  <div class="form-group">
                    <label>State</label>
                    <select name="state" class="form-control">
                      <option value="lagos-eko">Lagos-Eko</option>
                      <option value="lagos-ikeja">Lagos-Ikeja</option>
                    </select>
                  </div>
                  <div class="form-group">       
                    <label>Meter Number</label>
                    <input type="number"  class="form-control" name="meter_number">
                  </div>
                  <div class="form-group">       
                    <label>How much electricty do you want to buy?</label>
                    <input type="number"  class="form-control" name="amount">
                  </div>
                  <input type="hidden" value="7" name="bill_type_id">
                  
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary close">Close</button>
                <button type="submit" class="btn btn-primary">Pay</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      