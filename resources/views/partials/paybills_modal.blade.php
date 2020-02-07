
      <!-- Modal-->
      <div id="billsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">Cable Sub</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <p>Make your cable subscriptions.</p>
              <form>
                <div class="form-group">
                  <label>Cable Name</label>
                  <select name="cable_id" id="cable" class="form-control">
                    <option value="" selected>Select...</option>
                    @foreach ($bills as $bill)
                      <option value="{{$bill->id}}">{{$bill->bill_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">       
                  <label>Package</label>
                  <select name="package" class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                  </select>                </div>
                <div class="form-group">       
                  <input type="submit" value="Signin" class="btn btn-primary">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      @push('scripts')
          <script>
              $(document).ready(function() {
                  $('#cable').change(function() {
                    var cableValue = $(this).val();
                    
                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });

                    $.ajax({
                      url: '',
                      type: 'GET'
                      data: cableValue,
                      success(res) {
                        
                      },
                      error(err) {
                        
                      }

                    })

                  })
              })
          </script>
      @endpush
    