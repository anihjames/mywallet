$(document).ready(function(){
    $('#loanpid').on('change',function(){
        var value = $(this).val();
        if(value == ''){
            $('#loandetails').css('display','none');
        }else{
            $('#loandetails').css('display','block');
            $.ajax({
                url: `/user/getloandetails/${value}`,
                type: 'GET',
                success(res){ 
                    $('#loan_expiration').val(res.expire);
                    //res.expire
                    var loandata = JSON.stringify(res.loandata) 
                    $('#loan_amount').val(res.loandata.loan_amount)
                    $('#repayment_amount').val(res.loandata.repayment_amount)
                    $('#loan_tenure').val(res.loandata.loan_length)

                }
            })
        }

       
    })
})