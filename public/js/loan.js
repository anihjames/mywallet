var loan_amount, loan_tenure, id, income, phone, 
address, employement_status, rate, levelamount,leveltenure, repay;
$(document).ready(function(){
     leveltenure = $('#loantenure').val();
     levelamount = $('#levelamount').val();
     
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $('#next1').click(function(){
        loan_amount = $('#loan_amount').val();
        loan_tenure = $('#loan_tenure').val();
        if(loan_amount == '' || loan_tenure == ''){
            $('.alert-danger').html('Fill input');
            $('.alert-danger').css('display', 'block');
        }else if(loan_amount.length > levelamount.length){
            $('.alert-danger').html('max amount '+ levelamount);
            $('.alert-danger').css('display', 'block');
        }else{
            $('#nav-tab a[href="#step-1"]').attr('data-toggle', 'tab');
            $('#nav-tab a[href="#step-2"]').attr('data-toggle', 'tab');
            $('#nav-tab a[href="#step-2"]').removeClass('disabled');
            $('#nav-tab a[href="#step-2"]').tab('show');
            $('.alert-danger').html('');
            $('.alert-danger').css('display', 'none');
        }
       
    })

    $('#next2').click(function(){
         id = $('#national_id').val();
        income = $('#income').val();
        phone = $('#phone').val();
        address = $('#address').val();
        rate = $('#rate').val();
        
        if(id == '' || income == '' || phone == '' || address == '' ) {
            $('.alert-danger').html('Fill input');
            $('.alert-danger').css('display', 'block');
        }else if(id.length > 11) {
            $('.alert-danger').html('Invalid ID number');
            $('.alert-danger').css('display', 'block');
        }else{
            $('#nav-tab a[href="#step-2"]').attr('data-toggle', 'tab');
            $('#nav-tab a[href="#step-3"]').attr('data-toggle', 'tab');
            $('#nav-tab a[href="#step-3"]').removeClass('disabled');
            $('#nav-tab a[href="#step-3"]').tab('show');
            $('.alert-danger').html('');
            $('.alert-danger').css('display', 'none');
            $('#amount').html('&#8358;'+ loan_amount);
            $('#tenure').html(loan_tenure+ ' months');
            repay = repaymentamount(loan_amount, rate);
            $('#payment_amount').html('&#8358;' + repay);
        }
    })

    $('#prev1').click(function() {
        $('#nav-tab a[href="#step-1"]').tab('show');
    })

    $('#prev2').click(function() {
        $('#nav-tab a[href="#step-2"]').tab('show');
    })

    $('#loan_amount').on('keyup', function(){
        var value = $(this).val();
        $('#amount').html('&#8358;'+ value);
        repay = repaymentamount(value, rate);
        $('#payment_amount').html('&#8358;' + repay);
    })

    $('#loan_tenure').on('keyup', function(){
        var value = $(this).val();
        $('#tenure').html(value+ ' months');
    })

    $('#loan_tenure').on('keyup', function(){
        var value = $(this).val();
       
        if(value > tenure){
            $('.alert-danger').html('Loan tenure max '+ tenure +' months');
            $('.alert-danger').css('display', 'block');
            $('#next1').attr('disabled', true);
        }else{
            $('.alert-danger').html();
            $('.alert-danger').css('display', 'none');
            $('#next1').attr('disabled', false);
        }
    })

    $('#apply').on('click', function(){
       var data = {loan_amount:loan_amount,
                        loan_tenure:loan_tenure,
                        nationid:id,
                        userincome:income,
                        userphone:phone,
                        useraddress:address,
                        userstatus:employement_status,
                        repayment_amount:repay
            }
        $.ajax({
            url: '/user/applyforloan',
            type: "POST",
            data: data,
            success(res){
                if(res.status == 200) {
                    $('#succMsg').css('display','block')
                    $('#succMsg').removeClass('alert-danger')
                    $('#succMsg').addClass('alert-success')
                    $('#succMsg').html('Loan Application successfull, we get back to you soon!')
                }else{
                    $('#succMsg').css('display','block')
                    $('#succMsg').removeClass('alert-success')
                    $('#succMsg').addClass('alert-danger')
                    $('#succMsg').html('Loan Application successfull, we get back to you soon!')
                }
            },
            error(err){

            }
            
        })
    })


    
})

function repaymentamount(amount, rate) {
    var interest = (rate/100) * amount;
    var repayment = parseInt(amount) + parseInt(interest); 

    return repayment;
    
}