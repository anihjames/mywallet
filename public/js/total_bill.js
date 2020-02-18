var data, action;
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      $('#bills').DataTable({
        processing: true,
        serverside: true,
        ajax: '/admin/getbills',
        columns: [
            {data:'payment_pid', name:'Payment ID'},
            {data:'fullname', name: 'fullname'},
            {data: 'email', name: 'Email'},
            {data: 'bills_type', name: 'Bills Type'},
            {data: 'bills_amount', name:'Bills amount'},
            {data:'type_code', name:'Type code'},
            {data:'created_at', name: 'created_at'},
            {data:'action', name: 'status', orderable: false,}
        ],
        order: [[1, 'desc']],
    });
   
})