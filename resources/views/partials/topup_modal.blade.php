
        
        <!-- Modal-->
        <div id="topup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 id="exampleModalLabel" class="modal-title">Mobile Top-Up </h5>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <form action="{{route('topup')}}" method="POST" id="mobile-topup">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none;">
                        <ul></ul>
                      </div>
                      <p class="alert alert-success" id="succMsg" style="display:none;">
        
                    <div class="form-group">
                        <label for="Mobile_number">Mobile Number</label>
                        <div class="input-group">
                            <input type="text" readonly class="col-sm-2 form-control" value="+234" name="country_code">
                            <input type="text"class="form-control col-sm-12" id="staticEmail" name="mobile_number" placeholder="8132989348">
                        </div>
                        
                      </div>

                      <div class="form-group" >
                        <select name="top_up_type" class="form-control" id="topup_type">
                            <option value="airtime_topup">Buy Airtime</option>
                            <option value="data_topup">Buy Data</option>
                        </select>  
                      </div>

                      <div class="form-group">
                          <label for="network_provider">Select Network Provider</label>
                            <select name="network_provider" class="form-control" id="network_provider">
                                <option value="MTN">MTN Nigeria</option>
                                <option value="GLO">GLO Nigeria</option>
                                <option value="9MOBILE">9mobile</option>
                            </select>
                      </div>


                      
                    <div class="form-group" id="amount">       
                      <label>Amount</label>
                      <input type="number" placeholder="Amount" name="amount" class="form-control">
                    </div>

                    <div class="form-group" id="dataplan">
                        <label for="">Choose a plan...</label>
                        <select name="dataplan" class="form-control">
                            <option value="">Choose Plan</option>
                            <option value="30-1.5GB-1000">30days 1.5G N1000</option>
                            <option value="30-2GB-1200">30days 2GB N1200</option>
                            <option value="30-3GB-1500">30days 3GB N1500</option>
                        </select>

                    </div>
                    
                  
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary close">Close</button>
                  <button type="submit" class="btn btn-primary">Buy</button>
                </div>
            </form>
              </div>
            </div>
          </div>

          @push('scripts')
            <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
              <script src="{{asset('js/topup.js')}}"></script>
          @endpush
        