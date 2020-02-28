$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      var table = $('#transaction').DataTable({
          processing: true,
          serverside: true,
          ajax: {
            url:'/admin/gettransactions',
            data: function(d) {
              d.sort = $('#sort').val();
              
            }
          },
          columns: [
              {data: 'trans_pid', name: 'transaction pid'},
              {data: 'trans_type', name: 'transaction type'},
              {data: 'trans_name', name: 'transaction type'},
              {data: 'trans_amount', name: 'transaction name'},
              {data: 'balance', name:'Balance'},
              {data: 'status', name: 'Status'},
              {data:'created_at',  name:'Date/time'}
          ],
         
          // searching:false,
          ordering:false,
      })

      $('#sort').on('change',function(){
        table.ajax.reload();
      })

    
})
