var data, action;
$(document).ready(function(){
   
      
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

    $('#bills').on('click', 'a.viewbill', function() {

      $('#bill_modal_body').load('/admin/viewbills/' + $(this).data("edit-id"), function(responseTxt, statusTxt, xh) {
        $('#bill_modal').modal({
           backdrop: 'static',
           keyboard: true
        }, "show");
      });
      return false;
    })
   
})