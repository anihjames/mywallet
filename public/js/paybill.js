$(document).ready(function() {
    $('#starTime').hide();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#cable').change(function() {
      var cableValue = $(this).val();
      var output = '<option value>'+ 'Select Package... '  +'</option>';

        if (cableValue == 2) {
            $('#pack').show()
            $('#starTime').hide()
            $('#label').html('WHAT YOUR IUC NUMBER')
            $('#code').attr('placeholder', 'IUC NUMBER')
        } else if(cableValue == 3) {
            $('#pack').hide()
            $('#starTime').show()
        } else {
            $('#pack').show()
            $('#starTime').hide()
            $('#label').html('WHAT YOUR SMART CARD NUMBER')
            $('#code').attr('placeholder', 'SMART CARD NUMBER')
        } 


      if( cableValue != ''){
        
    
          $.ajax({
            url: `/user/billtype/${cableValue}`,
            type: 'GET',
            success(res) {
              $('#package').html(res)
            },
            error(err) {
    
            }
    
          })
      }
      
    })

    $('#payform').on('submit', function(e){
      
        e.preventDefault();
        var values = $('#payform').serialize();
        var action = $('#payform').attr('action');
        //console.log(values)

        if(values != '') {
            
        
              $.ajax({
                url: action,
                type: 'POST',
                data: values,
                success(res) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','none');
                    
                    $('#succMsg').css('display', 'block');
                    $('#succMsg').html(res.message);
                    $('#payform')[0].reset();
                    $('#billpay').DataTable().ajax.reload();
                    //location.reload();
                },
                error(err) {
                    if(err.status === 422 ){
                         var errors = err.responseJSON.errors
                         printErrorMsg(errors);
                        
                     }
                }
        
              })
              //$('#paybill').attr('disabled', false);
        }else {

            //$('#paybill').attr('disabled', true);
        }

    })


    function printErrorMsg (msg) {
        
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    $('.close').on('click', function() {
      $('#payform')[0].reset();
      $('#eedcPay')[0].reset();
      $('#succMsg').css('display', 'none');
      $('#succMsg').html('');
      $('#succMsg2').css('display', 'none');
      $('#succMsg2').html('');
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','none');
    })

    $('#eedcPay').on('submit', function(e) {
        e.preventDefault();
        var values = $('#eedcPay').serialize();
        var action = $('#eedcPay').attr('action');

        

          $.ajax({
            url: action,
            type: 'POST',
            data: values,
            success(res) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','none');
              
              $('#succMsg2').css('display', 'block');
              $('#succMsg2').html(res.message);
              $('#eedcPay')[0].reset();
              $('#billpay').DataTable().ajax.reload();
            },
            error(err) {
                if(err.status === 422 ){
                    var errors = err.responseJSON.errors
                    printErrorMsg(errors);
                   
                }
            }
    
          })
    });

    $('#billpay').DataTable({
      processing: true,
      serverside:true,
      ajax: "/datatable/bills",
      columns: [
          // {data:'id', name:'Id'},
          {data:'payment_pid', name:'Payment ID'},
          {data: 'bills_type', name: 'Bill Type'},
          {data: 'bills_amount', name:'Amount'},
          {data:'type_code', name:'Code'},
          {data:'created_at', name: 'Date/Time'},
          {data:'action', name: 'Status', orderable: false,}
      ],
      order: [[1,'desc']],
  })
})