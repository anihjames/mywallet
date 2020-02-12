$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#loanpay').on('submit', function(e) {
        e.preventDefault();
        var values = $(this).serialize();
        var action = $(this).attr('action');

        $.ajax({
            url:action,
            type: 'POST',
            data: values,
            success(res) {
                $(".loan-error-msg").find("ul").html('');
                $(".loan-error-msg").css('display','none');
                
                $('#loanMsg').css('display', 'block');
                $('#loanMsg').html(res.message);
                $('#loanpay')[0].reset();
                $('#loan-datatable').DataTable().ajax.reload();
            },
            error(err) {
                if(err.status === 422) {
                    var errors = err.responseJSON.errors
                    printErrorMsg(errors);
                }
            }
        })
      })


      $('#loan-datatable').DataTable({
          processing: true,
          serverside: true,
          ajax: '/datatable/loantaken',
          columns: [
            //   {data: 'id', name: 'id', 'visiable': false},
              {data: 'loan_amount', name:'Loan Amount'},
              {data: 'loan_length', name:'Loan Tenure'},
              {data:'loan_app_date',name: 'Date Applied'},
              {data: 'edit', name:'Edit'},
              {data: 'delete', name:'Deleted'},
              {data: 'action', name:'Status'},
              
              
          ],
          order: [[0, 'desc']]
      })


      $('.close').on('click', function() {
          $('#loanpay')[0].reset();
          $('.loan-error-msg').find('ul').html('');
          $('.loan-error-msg').css('display', 'none');
          $('#loanMsg').css('display', 'none');
          $('#loanMsg').html('');
      })

      function printErrorMsg (msg) {
        
        $(".loan-error-msg").find("ul").html('');
        $(".loan-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".loan-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

})