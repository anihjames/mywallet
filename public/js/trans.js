$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#transaction').DataTable({
          processing: true,
          serverside: true,
          ajax: '/admin/gettransactions',
          columns: [
              {data: 'trans_pid', name: 'transaction pid'},
              {data: 'trans_type', name: 'transaction type'},
              {data: 'trans_type', name: 'transaction type'},
              {data: 'trans_name', name: 'transaction name'},
              {data: 'balance', name:'Balance'},
              {data: 'status', name: 'Status'},
              {data:'created_at',  name:'Date/time'}
          ]
      })
})