$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      $('#topups').DataTable({
          processing: true,
          serverside: true,
          ajax: '/admin/gettopups',
          columns: [
            //   {data: 'mobile_pid', name:'Payment ID'},
              {data:'fullname', name:'Fullname'},
              {data:'toptype', name:'Top Type'},
              {data: 'mobile_number', name:'Mobile Number'},
              {data:'network_provider', name:'Network Provider'},
              {data:'amount', name:'Amount'},
              {data:'created_at', name:'Date'},
              {data:'action', name:'Status'}
          ],
          order: [[1, 'desc']]
      })


      $('#topups').on('click', 'a.viewtopup', function() {
        
        $('#topup_modal_body').load('/admin/viewtopup/' + $(this).data("edit-id"), function(responseTxt, statusTxt, xh) {
            $('#topup_modal').modal({
                backdrop: 'static',
                keyboard: true
            }, "show");
        } );
        return false;
       
      })

     

})