$(document).ready(function() {
    $('#dataplan').hide();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $('#topup_type').change(function() {
        var type = $(this).val();
        if(type == 'data_topup'){
            $('#amount').hide();
            $('#dataplan').show();
        }else {
            $('#dataplan').hide();
            $('#amount').show();
        }        
    })

    $('#mobile-topup').on('submit', function(e) {
        e.preventDefault()
        var values = $('#mobile-topup').serialize();
        var action = $('#mobile-topup').attr('action');
        
        $.ajax({
            url:action,
            type:'POST',
            data: values,
            success(res) {
                //console.log(res)
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','none');
                    
                $('#succMsg').css('display', 'block');
                $('#succMsg').html(res.message);
                $('#mobile-topup')[0].reset();  
                $('#topup-datatable').DataTable().ajax.reload();
                //location.reload()
            },
            error(err) {
                if(err.status === 422 ){
                    var errors = err.responseJSON.errors
                    printErrorMsg(errors);
                   
                }
            }
        })

    })

    $('.close').on('click', function() {
        $('#mobile-topup')[0].reset();
        $('#succMsg').css('display', 'none');
        $('#succMsg').html('');
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','none');
      })

      $('#topup-datatable').DataTable({
          processing: true,
          serverside: true,
          ajax:{
              url: "/datatable/recentTopups",
              type: 'GET',
          },
          columns: [
            {data: 'mobile_pid', name: 'id'},
            {data: 'toptype', name:'type type'},
              {data: 'mobile_number', name:'mobile number'},
              
              {data: 'network_provider', name:'Network'},
              {data:'amount',name: 'Amount'},
              {data: 'action', name:'Status'},
            //   {data: 'edit', name: 'Edit'},
            //   {data: 'delete', name:'Delete'},
              {data: 'created_at', name:'Date'}
              
          ],
          order: [[0, 'desc']]
      })

      function printErrorMsg (msg) {
        
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }


})