var data, action;
$(document).ready(function(){
   
      
     var table =  $('#bills').DataTable({
        processing: true,
        serverside: true,
        ajax: {
          url: '/admin/getbills',
          data: function(d) {
            d.sort = $('#sort').val();
          }
          
        },
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

        searching: false,
        ordering:false,
    });

    $('#sort').on('change',function(){
      table.ajax.reload();
    })


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