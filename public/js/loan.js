var loan_amount, loan_tenure, id, income, phone, address, employement_status;
$(document).ready(function(){

    $('#next1').click(function(){
        loan_amount = $('#loan_amount').val();
         loan_tenure = $('#loan_tenure').val();
        if(loan_amount == '' || loan_tenure == ''){
            $('.alert-danger').html('Fill input');
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
        console.log(id.length)
        
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
        }
    })

    $('#prev1').click(function() {
        $('#nav-tab a[href="#step-1"]').tab('show');
    })

    $('#prev2').click(function() {
        $('#nav-tab a[href="#step-2"]').tab('show');
    })

    
})